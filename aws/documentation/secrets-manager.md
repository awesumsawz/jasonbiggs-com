# AWS Secrets Manager Configuration

## Secret

- **Name**: thinkbigg/env-vars
- **ARN**: arn:aws:secretsmanager:us-east-2:195275673733:secret:thinkbigg/env-vars-Jtt440
- **Description**: Environment variables for ThinkBigg application

## Secret Values

The secret contains the following environment variables:

- EMAIL_USER
- EMAIL_PASS
- EMAIL_HOST
- EMAIL_PORT
- EMAIL_SECURE
- DEFAULT_FROM
- TEST_EMAIL_API_KEY

## IAM Permissions

The following IAM role has permission to access this secret:

- **Role**: ecsTaskExecutionRole
- **Policy**: SecretsManagerAccess
- **Actions**: secretsmanager:GetSecretValue
- **Resource**: arn:aws:secretsmanager:us-east-2:195275673733:secret:thinkbigg/env-vars-Jtt440
