# AWS Infrastructure Overview

## Architecture

The ThinkBigg application is deployed using the following AWS services:

1. **Amazon ECS (Elastic Container Service)** - Runs the containerized Next.js application
2. **Amazon ECR (Elastic Container Registry)** - Stores the Docker images
3. **Application Load Balancer** - Routes traffic to the ECS service
4. **Amazon Route 53** - DNS management for thinkbigg.dev domain
5. **AWS Certificate Manager** - Manages SSL/TLS certificate
6. **AWS Secrets Manager** - Securely stores environment variables
7. **Amazon CloudWatch** - Logs and monitoring
8. **IAM** - Identity and access management

## Services

The application is deployed using two ECS services:

1. **thinkbigg-service** - Main service with 2 tasks running the latest task definition
2. **thinkbigg-service-new** - New service with 1 task running the latest task definition (added July 10, 2023)

Both services use the same task definition family (thinkbigg-nextjs) and are connected to the same Application Load Balancer.

## Network Flow

1. User requests https://thinkbigg.dev
2. Route 53 resolves to the Application Load Balancer
3. ALB terminates SSL and forwards traffic to ECS tasks on port 3000
4. ECS tasks process the request and return the response

## Security

- HTTPS is enforced with automatic HTTP to HTTPS redirection
- Sensitive environment variables are stored in AWS Secrets Manager
- Security groups restrict traffic flow
- IAM roles follow the principle of least privilege

## Deployment

The application is deployed as a Docker container to ECS Fargate with the following workflow:

1. Build Docker image
2. Push to ECR
3. Update ECS task definition (current revision: 17)
4. Deploy to ECS service

## Network Configuration

The ECS services are deployed in a VPC with the following subnets:
- us-east-2a: subnet-05cf191ffbfada0b2
- us-east-2b: subnet-0e8808f0b56d88269
- us-east-2c: subnet-04b3b76b5a48d3e15

See `network-config.md` for detailed network configuration.

## Environment Variables

Environment variables are securely stored in AWS Secrets Manager and injected into the container at runtime.

## Monitoring

Application logs are sent to CloudWatch Logs for monitoring and troubleshooting.
