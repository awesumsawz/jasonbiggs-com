# AWS Resources and Commands Reference

## Common AWS CLI Commands

### ECS

```bash
# List clusters
aws ecs list-clusters

# List services in a cluster
aws ecs list-services --cluster think-bigg

# Describe a service
aws ecs describe-services --cluster think-bigg --services thinkbigg-service

# List tasks in a service
aws ecs list-tasks --cluster think-bigg --service-name thinkbigg-service

# Describe a task
aws ecs describe-tasks --cluster think-bigg --tasks TASK_ARN

# Describe task definition
aws ecs describe-task-definition --task-definition thinkbigg-nextjs:17

# Register a new task definition
aws ecs register-task-definition --cli-input-json file://aws/task-def-with-secrets.json

# Create a new service
aws ecs create-service --cluster think-bigg --service-name thinkbigg-service-new --task-definition thinkbigg-nextjs:17 --desired-count 1 --launch-type FARGATE --platform-version 1.4.0 --network-configuration "awsvpcConfiguration={subnets=[subnet-0e8808f0b56d88269,subnet-05cf191ffbfada0b2],securityGroups=[sg-0a1861d4a4553eded],assignPublicIp=ENABLED}" --load-balancer "targetGroupArn=arn:aws:elasticloadbalancing:us-east-2:195275673733:targetgroup/thinkbigg-tg/e56081a920cf8716,containerName=thinkbigg-nextjs,containerPort=3000"

# Update a service
aws ecs update-service --cluster think-bigg --service thinkbigg-service --task-definition thinkbigg-nextjs:17

# Update service desired count
aws ecs update-service --cluster think-bigg --service thinkbigg-service-new --desired-count 1

# Execute command on a task (requires Session Manager Plugin)
aws ecs execute-command --cluster think-bigg --task TASK_ARN --container thinkbigg-nextjs --command "/bin/sh" --interactive

# Get subnet information for a VPC
aws ec2 describe-subnets --filters "Name=vpc-id,Values=vpc-0ff6a05d3735d7fbb" --query "Subnets[*].[SubnetId,AvailabilityZone]" --output table
```

### CloudWatch Logs

```bash
# List log groups
aws logs describe-log-groups

# List log streams in a log group
aws logs describe-log-streams --log-group-name "/ecs/thinkbigg-nextjs" --order-by LastEventTime --descending

# Get log events
aws logs get-log-events --log-group-name "/ecs/thinkbigg-nextjs" --log-stream-name "STREAM_NAME"
```

### Load Balancer

```bash
# Describe load balancers
aws elbv2 describe-load-balancers

# Describe target groups
aws elbv2 describe-target-groups

# Describe listeners
aws elbv2 describe-listeners --load-balancer-arn LOAD_BALANCER_ARN

# Describe target health
aws elbv2 describe-target-health --target-group-arn TARGET_GROUP_ARN
```

### Secrets Manager

```bash
# List secrets
aws secretsmanager list-secrets

# Get secret value (without showing in terminal)
aws secretsmanager get-secret-value --secret-id thinkbigg/env-vars --query SecretString --output text > secret.json

# Update secret value
aws secretsmanager update-secret --secret-id thinkbigg/env-vars --secret-string file://new-secret.json
```

### Certificate Manager

```bash
# List certificates
aws acm list-certificates

# Describe certificate
aws acm describe-certificate --certificate-arn CERTIFICATE_ARN
```

### Route 53

```bash
# List hosted zones
aws route53 list-hosted-zones

# List resource record sets in a hosted zone
aws route53 list-resource-record-sets --hosted-zone-id HOSTED_ZONE_ID
```
