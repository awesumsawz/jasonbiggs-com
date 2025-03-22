#!/bin/bash

# Source configuration
source "$(dirname "$0")/config.sh" "$1"

# Change to project root directory
cd "$PROJECT_ROOT" || exit 1

echo "Building Docker image for Laravel project..."

# Build the Docker image with the full ECR repository name
FULL_REPOSITORY_NAME="${ECR_REGISTRY}/${ECR_REPOSITORY_NAME}"

# Build directly with the full repository name, specifying platform as linux/amd64
docker build -t "${FULL_REPOSITORY_NAME}:latest" \
  --platform linux/amd64 \
  --build-arg APP_ENV=production \
  --no-cache \
  .

echo "Docker image built successfully!"