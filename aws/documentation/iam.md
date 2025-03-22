# AWS IAM Configuration

## Roles

### ECS Task Role

- **Name**: ecsTaskRole
- **ARN**: arn:aws:iam::195275673733:role/ecsTaskRole
- **Description**: Role used by ECS tasks to access AWS services
- **Trust Relationship**: Allows ecs-tasks.amazonaws.com to assume this role
- **Policies**:
  - ExecuteCommandPolicy: Allows ECS Execute Command functionality

### ECS Task Execution Role

- **Name**: ecsTaskExecutionRole
- **ARN**: arn:aws:iam::195275673733:role/ecsTaskExecutionRole
- **Description**: Role used by ECS to pull images and publish logs
- **Policies**:
  - AmazonECSTaskExecutionRolePolicy (AWS managed policy)
  - SecretsManagerAccess: Allows access to Secrets Manager secrets

## Policies

### ExecuteCommandPolicy

```json
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Action": [
        "ssmmessages:CreateControlChannel",
        "ssmmessages:CreateDataChannel",
        "ssmmessages:OpenControlChannel",
        "ssmmessages:OpenDataChannel"
      ],
      "Resource": "*"
    }
  ]
}
```

### SecretsManagerAccess

```json
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Action": [
        "secretsmanager:GetSecretValue"
      ],
      "Resource": [
        "arn:aws:secretsmanager:us-east-2:195275673733:secret:thinkbigg/env-vars-Jtt440"
      ]
    }
  ]
}
```
