# AWS Deployment Guide

This guide outlines the steps to deploy a new service to the AWS ECS cluster.

## Prerequisites

- AWS CLI installed and configured with appropriate credentials
- Docker installed (if building a new image)
- Access to the AWS account with appropriate permissions

## Deployment Steps

### 1. Build and Push Docker Image (if needed)

If you need to update the application code:

```bash
# Build the Docker image
docker build -t thinkbigg-nextjs .

# Tag the image
docker tag thinkbigg-nextjs:latest 195275673733.dkr.ecr.us-east-2.amazonaws.com/thinkbigg-nextjs:latest

# Login to ECR
aws ecr get-login-password --region us-east-2 | docker login --username AWS --password-stdin 195275673733.dkr.ecr.us-east-2.amazonaws.com

# Push the image to ECR
docker push 195275673733.dkr.ecr.us-east-2.amazonaws.com/thinkbigg-nextjs:latest
```

### 2. Register a New Task Definition

Use the existing task definition template with any necessary updates:

```bash
# Register a new task definition
aws ecs register-task-definition --cli-input-json file://aws/task-def-with-secrets.json
```

This will create a new revision of the task definition. Note the new revision number in the output.

### 3. Create a New Service

```bash
# Create a new service
aws ecs create-service \
  --cluster think-bigg \
  --service-name thinkbigg-service-new \
  --task-definition thinkbigg-nextjs:17 \
  --desired-count 1 \
  --launch-type FARGATE \
  --platform-version 1.4.0 \
  --network-configuration "awsvpcConfiguration={subnets=[subnet-05cf191ffbfada0b2,subnet-0e8808f0b56d88269],securityGroups=[sg-0a1861d4a4553eded],assignPublicIp=ENABLED}" \
  --load-balancer "targetGroupArn=arn:aws:elasticloadbalancing:us-east-2:195275673733:targetgroup/thinkbigg-tg/e56081a920cf8716,containerName=thinkbigg-nextjs,containerPort=3000"
```

Replace the task definition revision number with the one from step 2.

### 4. Verify Service Deployment

```bash
# Check service status
aws ecs describe-services --cluster think-bigg --services thinkbigg-service-new

# List tasks
aws ecs list-tasks --cluster think-bigg --service-name thinkbigg-service-new

# Describe a specific task
aws ecs describe-tasks --cluster think-bigg --tasks TASK_ARN
```

**Note:** If the service is showing 0 running tasks but the events show that tasks have been started, there may be an issue with the task configuration or networking. Check the service events and CloudWatch logs for more information.

### 5. Update Service (if needed)

If you need to update the service configuration:

```bash
# Update service
aws ecs update-service \
  --cluster think-bigg \
  --service thinkbigg-service-new \
  --task-definition thinkbigg-nextjs:NEW_REVISION \
  --desired-count 1
```

### 6. Monitor Logs

```bash
# Get log streams
aws logs describe-log-streams --log-group-name "/ecs/thinkbigg-nextjs" --order-by LastEventTime --descending

# Get log events
aws logs get-log-events --log-group-name "/ecs/thinkbigg-nextjs" --log-stream-name "STREAM_NAME"
```

## Troubleshooting

If the service fails to start:

1. Check the service events:
   ```bash
   aws ecs describe-services --cluster think-bigg --services thinkbigg-service-new --query "services[0].events"
   ```

2. Check the task status:
   ```bash
   aws ecs describe-tasks --cluster think-bigg --tasks TASK_ARN
   ```

3. Check the logs:
   ```bash
   aws logs get-log-events --log-group-name "/ecs/thinkbigg-nextjs" --log-stream-name "STREAM_NAME"
   ```

4. Verify network configuration:
   - Ensure the subnets and security groups are correct
   - Verify that the security group allows traffic on port 3000 from the ALB security group

5. Verify load balancer configuration:
   - Check target group health:
     ```bash
     aws elbv2 describe-target-health --target-group-arn arn:aws:elasticloadbalancing:us-east-2:195275673733:targetgroup/thinkbigg-tg/e56081a920cf8716
     ```

6. Common issues:
   - **Task starts but stops immediately**: Check CloudWatch logs for application errors
   - **Task fails to start**: Check IAM permissions, network configuration, and ECR image availability
   - **Task starts but health check fails**: Verify the application is running on the correct port and responding to health checks
   - **Multiple tasks starting and stopping**: This may indicate a configuration issue or resource constraints