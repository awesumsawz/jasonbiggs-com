# AWS ECS Configuration

## Cluster

- **Name**: think-bigg
- **ARN**: arn:aws:ecs:us-east-2:195275673733:cluster/think-bigg

## Services

### Main Service

- **Name**: thinkbigg-service
- **ARN**: arn:aws:ecs:us-east-2:195275673733:service/think-bigg/thinkbigg-service
- **Launch Type**: FARGATE
- **Platform Version**: 1.4.0
- **Desired Count**: 2
- **Task Definition**: thinkbigg-nextjs:11
- **Enable Execute Command**: true

### New Service (Added on July 10, 2023)

- **Name**: thinkbigg-service-new
- **ARN**: arn:aws:ecs:us-east-2:195275673733:service/think-bigg/thinkbigg-service-new
- **Launch Type**: FARGATE
- **Platform Version**: 1.4.0
- **Desired Count**: 1
- **Task Definition**: thinkbigg-nextjs:17
- **Enable Execute Command**: false
- **Network Configuration**:
  - **Subnets**: subnet-0e8808f0b56d88269 (us-east-2b), subnet-05cf191ffbfada0b2 (us-east-2a)
  - **Security Groups**: sg-0a1861d4a4553eded
  - **Assign Public IP**: ENABLED

## Task Definition

- **Family**: thinkbigg-nextjs
- **Current Revision**: 17 (updated from 11)
- **ARN**: arn:aws:ecs:us-east-2:195275673733:task-definition/thinkbigg-nextjs:17
- **CPU**: 256
- **Memory**: 512
- **Network Mode**: awsvpc
- **Task Role**: arn:aws:iam::195275673733:role/ecsTaskRole
- **Execution Role**: arn:aws:iam::195275673733:role/ecsTaskExecutionRole

### Container Definition

- **Name**: thinkbigg-nextjs
- **Image**: 195275673733.dkr.ecr.us-east-2.amazonaws.com/thinkbigg-nextjs:latest
- **Port Mappings**: 3000:3000/tcp
- **Environment Variables**:
  - PORT=3000
  - NODE_ENV=production
- **Secrets**: Environment variables from AWS Secrets Manager
  - EMAIL_USER
  - EMAIL_PASS
  - EMAIL_HOST
  - EMAIL_PORT
  - EMAIL_SECURE
  - DEFAULT_FROM
  - TEST_EMAIL_API_KEY

## Security Groups

- **Service Security Group**: sg-0a1861d4a4553eded

## Subnets

- **us-east-2a**: subnet-05cf191ffbfada0b2
- **us-east-2b**: subnet-0e8808f0b56d88269
- **us-east-2c**: subnet-04b3b76b5a48d3e15
