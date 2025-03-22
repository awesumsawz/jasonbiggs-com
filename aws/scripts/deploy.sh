#!/bin/bash

# Source configuration
source "$(dirname "$0")/config.sh" "$1"

# Validate environment variables
validate_env_vars

# Set the full image URL and cluster name based on environment
if [[ "$1" == "dev" ]]; then
    FULL_IMAGE_URL="${ECR_REGISTRY}/dev-${ECR_REPOSITORY_NAME}:latest"
else
    FULL_IMAGE_URL="${ECR_REGISTRY}/${ECR_REPOSITORY_NAME}:latest"
fi

echo "Deploying to cluster: ${ECS_CLUSTER_NAME}"

echo "Registering new task definition for ${ECS_TASK_FAMILY}..."

# Check if the task definition exists
TASK_DEF_EXISTS=$(aws ecs list-task-definitions --family-prefix "${ECS_TASK_FAMILY}" --region "${AWS_REGION}" --query 'length(taskDefinitionArns)' --output text)

if [ "$TASK_DEF_EXISTS" -gt 0 ]; then
    echo "Using existing task definition family: ${ECS_TASK_FAMILY}"
    # Get the latest task definition
    TASK_DEFINITION=$(aws ecs describe-task-definition --task-definition "${ECS_TASK_FAMILY}" --region "${AWS_REGION}" | \
        jq --arg IMAGE "${FULL_IMAGE_URL}" \
        --arg NAME "${CONTAINER_NAME}" \
        '.taskDefinition | .containerDefinitions[0].image = $IMAGE | .containerDefinitions[0].name = $NAME | del(.taskDefinitionArn, .revision, .status, .requiresAttributes, .compatibilities, .registeredAt, .registeredBy)')
else
    echo "Creating new task definition family: ${ECS_TASK_FAMILY}"
    # Get the current service's task definition to use as a template
    CURRENT_SERVICE=$(aws ecs describe-services --cluster "${ECS_CLUSTER_NAME}" --services "${ECS_SERVICE_NAME}" --region "${AWS_REGION}")
    CURRENT_TASK_DEF_ARN=$(echo "$CURRENT_SERVICE" | jq -r '.services[0].taskDefinition')
    
    if [ -z "$CURRENT_TASK_DEF_ARN" ] || [ "$CURRENT_TASK_DEF_ARN" == "null" ]; then
        echo "Failed to get current task definition from service"
        exit 1
    fi
    
    # Get the current task definition and modify it
    TASK_DEFINITION=$(aws ecs describe-task-definition --task-definition "$CURRENT_TASK_DEF_ARN" --region "${AWS_REGION}" | \
        jq --arg IMAGE "${FULL_IMAGE_URL}" \
        --arg NAME "${CONTAINER_NAME}" \
        --arg FAMILY "${ECS_TASK_FAMILY}" \
        '.taskDefinition | .containerDefinitions[0].image = $IMAGE | .containerDefinitions[0].name = $NAME | .family = $FAMILY | del(.taskDefinitionArn, .revision, .status, .requiresAttributes, .compatibilities, .registeredAt, .registeredBy)')
fi

if [ $? -ne 0 ]; then
    echo "Failed to get task definition"
    exit 1
fi

# Save the task definition to a temporary file
TEMP_FILE=$(mktemp)
echo "$TASK_DEFINITION" > "$TEMP_FILE"

# Register the new task definition using the file
NEW_TASK_DEF=$(aws ecs register-task-definition \
    --region "${AWS_REGION}" \
    --cli-input-json "file://$TEMP_FILE")

if [ $? -ne 0 ]; then
    echo "Failed to register new task definition"
    rm "$TEMP_FILE"
    exit 1
fi

# Clean up the temporary file
rm "$TEMP_FILE"

NEW_REVISION=$(echo "$NEW_TASK_DEF" | jq -r '.taskDefinition.revision')

echo "Updating ECS service..."
aws ecs update-service \
    --cluster "${ECS_CLUSTER_NAME}" \
    --service "${ECS_SERVICE_NAME}" \
    --task-definition "${ECS_TASK_FAMILY}:${NEW_REVISION}" \
    --region "${AWS_REGION}" \
    --force-new-deployment

if [ $? -ne 0 ]; then
    echo "Failed to update service"
    exit 1
fi

echo "Deployment initiated successfully. New task definition: ${ECS_TASK_FAMILY}:${NEW_REVISION}"
echo "Monitor deployment status with:"
echo "aws ecs describe-services --cluster ${ECS_CLUSTER_NAME} --services ${ECS_SERVICE_NAME} --region ${AWS_REGION}"

# Get the public IP if it's a development environment
if [[ "$1" == "dev" ]]; then
    echo "Waiting for new task to start..."
    sleep 30  # Give ECS some time to start the new task

    TASK_ARN=$(aws ecs list-tasks \
        --cluster "${ECS_CLUSTER_NAME}" \
        --service-name "${ECS_SERVICE_NAME}" \
        --region "${AWS_REGION}" \
        --query 'taskArns[0]' \
        --output text)

    if [ ! -z "$TASK_ARN" ]; then
        ENI_ID=$(aws ecs describe-tasks \
            --cluster "${ECS_CLUSTER_NAME}" \
            --tasks "$TASK_ARN" \
            --region "${AWS_REGION}" \
            --query 'tasks[0].attachments[0].details[?name==`networkInterfaceId`].value' \
            --output text)

        if [ ! -z "$ENI_ID" ]; then
            PUBLIC_IP=$(aws ec2 describe-network-interfaces \
                --network-interface-ids "$ENI_ID" \
                --region "${AWS_REGION}" \
                --query 'NetworkInterfaces[0].Association.PublicIp' \
                --output text)

            echo "Development environment is accessible at: http://${PUBLIC_IP}:${CONTAINER_PORT}"
        fi
    fi
fi