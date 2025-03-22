#!/bin/bash

# Source configuration
source "$(dirname "$0")/config.sh" "$1"

# Validate environment variables
validate_env_vars

# Set the full image URL and cluster name based on environment
if [[ "$1" == "dev" ]]; then
    FULL_IMAGE_URL="${ECR_REGISTRY}/dev-${ECR_REPOSITORY_NAME}:latest"
    TASK_FAMILY="dev-${ECR_REPOSITORY_NAME}-migration"
else
    FULL_IMAGE_URL="${ECR_REGISTRY}/${ECR_REPOSITORY_NAME}:latest"
    TASK_FAMILY="${ECR_REPOSITORY_NAME}-migration"
fi

echo "Running database migrations for: ${FULL_IMAGE_URL}"

# Create a temporary task definition JSON file
TEMP_FILE=$(mktemp)

cat > "$TEMP_FILE" << EOL
{
  "family": "${TASK_FAMILY}",
  "executionRoleArn": "arn:aws:iam::${AWS_ACCOUNT_ID}:role/ecsTaskExecutionRole",
  "networkMode": "awsvpc",
  "containerDefinitions": [
    {
      "name": "${CONTAINER_NAME}-migration",
      "image": "${FULL_IMAGE_URL}",
      "essential": true,
      "command": ["php", "artisan", "migrate", "--force"],
      "environment": [
        {
          "name": "APP_ENV",
          "value": "${1:-prod}"
        }
      ],
      "secrets": [
        {
          "name": "APP_KEY",
          "valueFrom": "/${ECR_REPOSITORY_NAME}/APP_KEY"
        },
        {
          "name": "DB_HOST",
          "valueFrom": "/${ECR_REPOSITORY_NAME}/DB_HOST"
        },
        {
          "name": "DB_DATABASE",
          "valueFrom": "/${ECR_REPOSITORY_NAME}/DB_DATABASE"
        },
        {
          "name": "DB_USERNAME",
          "valueFrom": "/${ECR_REPOSITORY_NAME}/DB_USERNAME"
        },
        {
          "name": "DB_PASSWORD",
          "valueFrom": "/${ECR_REPOSITORY_NAME}/DB_PASSWORD"
        }
      ],
      "logConfiguration": {
        "logDriver": "awslogs",
        "options": {
          "awslogs-group": "/ecs/${ECR_REPOSITORY_NAME}",
          "awslogs-region": "${AWS_REGION}",
          "awslogs-stream-prefix": "migration"
        }
      }
    }
  ],
  "requiresCompatibilities": [
    "FARGATE"
  ],
  "cpu": "256",
  "memory": "512"
}
EOL

# Register the task definition
echo "Registering task definition for migrations..."
TASK_DEF=$(aws ecs register-task-definition \
  --cli-input-json "file://$TEMP_FILE" \
  --region "${AWS_REGION}")

TASK_REVISION=$(echo $TASK_DEF | jq -r '.taskDefinition.revision')
echo "Task definition registered: ${TASK_FAMILY}:${TASK_REVISION}"

# Clean up the temporary file
rm "$TEMP_FILE"

# Run the task
echo "Running migration task..."
NETWORK_CONFIG="awsvpcConfiguration={subnets=[subnet-12345678,subnet-87654321],securityGroups=[sg-12345678],assignPublicIp=ENABLED}"

# Replace with your actual subnet and security group IDs from your VPC
TASK=$(aws ecs run-task \
  --cluster "${ECS_CLUSTER_NAME}" \
  --task-definition "${TASK_FAMILY}:${TASK_REVISION}" \
  --launch-type FARGATE \
  --network-configuration "${NETWORK_CONFIG}" \
  --region "${AWS_REGION}")

TASK_ARN=$(echo $TASK | jq -r '.tasks[0].taskArn')
echo "Migration task started: ${TASK_ARN}"
echo "You can monitor the task with:"
echo "aws ecs describe-tasks --cluster ${ECS_CLUSTER_NAME} --tasks ${TASK_ARN} --region ${AWS_REGION}" 