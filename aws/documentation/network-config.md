# AWS Network Configuration

## VPC

- **ID**: vpc-0ff6a05d3735d7fbb
- **Region**: us-east-2 (Ohio)

## Subnets

| Subnet ID | Availability Zone | CIDR Block | Description |
|-----------|-------------------|------------|-------------|
| subnet-05cf191ffbfada0b2 | us-east-2a | 172.31.0.0/20 | Public subnet in us-east-2a |
| subnet-0e8808f0b56d88269 | us-east-2b | 172.31.16.0/20 | Public subnet in us-east-2b |
| subnet-04b3b76b5a48d3e15 | us-east-2c | 172.31.32.0/20 | Public subnet in us-east-2c |

## Network Configuration for ECS Services

When creating or updating ECS services, use the following network configuration:

```json
{
  "awsvpcConfiguration": {
    "subnets": [
      "subnet-05cf191ffbfada0b2",
      "subnet-0e8808f0b56d88269"
    ],
    "securityGroups": [
      "sg-0a1861d4a4553eded"
    ],
    "assignPublicIp": "ENABLED"
  }
}
```

## CLI Example

```bash
aws ecs create-service \
  --cluster think-bigg \
  --service-name my-service \
  --task-definition thinkbigg-nextjs:17 \
  --desired-count 1 \
  --launch-type FARGATE \
  --platform-version 1.4.0 \
  --network-configuration "awsvpcConfiguration={subnets=[subnet-05cf191ffbfada0b2,subnet-0e8808f0b56d88269],securityGroups=[sg-0a1861d4a4553eded],assignPublicIp=ENABLED}" \
  --load-balancer "targetGroupArn=arn:aws:elasticloadbalancing:us-east-2:195275673733:targetgroup/thinkbigg-tg/e56081a920cf8716,containerName=thinkbigg-nextjs,containerPort=3000"
``` 