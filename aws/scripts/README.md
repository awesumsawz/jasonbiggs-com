# AWS Deployment Scripts for jason-biggs-com

This directory contains scripts for deploying the Laravel application to AWS ECS in both production and development environments.

## Configuration

Before using these scripts, you need to configure the environment variables in `config.sh`:

1. Set your AWS account details:
   ```bash
   export AWS_REGION="your-region"
   export AWS_ACCOUNT_ID="your-account-id"
   ```

2. Configure your ECR repository:
   ```bash
   export ECR_REPOSITORY_NAME="jason-biggs-com"
   ```

3. Set up your ECS configuration:
   ```bash
   export ECS_CLUSTER_NAME="jason-biggs"
   export ECS_SERVICE_NAME="jason-biggs-service"
   export ECS_TASK_FAMILY="jason-biggs-com"
   ```

4. Configure your container settings:
   ```bash
   export CONTAINER_NAME="jason-biggs-com"
   export CONTAINER_PORT=80
   ```

5. Set your load balancer target group:
   ```bash
   export TARGET_GROUP_ARN="your-target-group-arn"
   ```

## Usage

### Production Deployment

To deploy to production:

1. Build the production Docker image:
   ```bash
   ./aws/scripts/runtask prod build
   ```

2. Push the image to ECR:
   ```bash
   ./aws/scripts/runtask prod push
   ```

3. Deploy to ECS:
   ```bash
   ./aws/scripts/runtask prod deploy
   ```

Or run all steps in sequence:
```bash
./aws/scripts/runtask prod all
```

### Development Deployment

To deploy to development:

1. Build the development Docker image:
   ```bash
   ./aws/scripts/runtask dev build
   ```

2. Push the image to ECR:
   ```bash
   ./aws/scripts/runtask dev push
   ```

3. Deploy to ECS:
   ```bash
   ./aws/scripts/runtask dev deploy
   ```

Or run all steps in sequence:
```bash
./aws/scripts/runtask dev all
```

## Laravel-specific Considerations

### Environment Variables

Ensure that you have a `.env` file that's properly configured for your environment.
**IMPORTANT**: Never commit sensitive information like API keys, database credentials, or other secrets to Git. These should be managed through AWS Secrets Manager or parameter store and injected at container runtime.

### Database Migrations

Database migrations should be handled separately from the deployment process. You can set up a separate task definition for running migrations.

### Asset Compilation

The Laravel build process includes compiling assets. Make sure your Dockerfile properly handles this step.

## Monitoring Deployments

You can monitor the status of your deployments using the AWS CLI:

```bash
aws ecs describe-services --cluster jason-biggs --services jason-biggs-service --region us-east-2
```

## Troubleshooting

1. If the build fails, check:
   - Docker is running
   - You have the correct Dockerfile with Laravel dependencies
   - You're in the project root directory

2. If the push fails, check:
   - You're logged into ECR (`aws ecr get-login-password`)
   - Your AWS credentials are correct
   - The ECR repository exists

3. If the deployment fails, check:
   - ECS service exists
   - Task definition is valid
   - IAM roles and permissions are correct
   - VPC and security group settings 

## Architecture Compatibility

When building Docker images on Apple Silicon (ARM64) machines for deployment to AWS ECS (which uses x86_64/AMD64), you must specify the target platform during the build process.

The `build.sh` script includes the `--platform linux/amd64` flag to ensure compatibility. 