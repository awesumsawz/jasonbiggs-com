#!/bin/bash

# Source configuration
source "$(dirname "$0")/config.sh" "$1"

# Validate environment variables
validate_env_vars

# Get the ECR repository name based on environment
if [[ "$1" == "dev" ]]; then
    REPOSITORY_NAME="dev-${ECR_REPOSITORY_NAME}"
else
    REPOSITORY_NAME="${ECR_REPOSITORY_NAME}"
fi

echo "Logging into Amazon ECR..."
aws ecr get-login-password --region "${AWS_REGION}" | docker login --username AWS --password-stdin "${ECR_REGISTRY}"

if [ $? -ne 0 ]; then
    echo "Failed to log into ECR"
    exit 1
fi

echo "Pushing to repository: ${REPOSITORY_NAME}"
# The image should already be tagged correctly during build
docker push "${ECR_REGISTRY}/${REPOSITORY_NAME}:latest"

if [ $? -ne 0 ]; then
    echo "Failed to push image to ECR"
    exit 1
fi

echo "Successfully pushed image to ECR"