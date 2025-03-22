# AWS ECR Configuration

## Repository

- **Name**: thinkbigg-nextjs
- **URI**: 195275673733.dkr.ecr.us-east-2.amazonaws.com/thinkbigg-nextjs
- **Latest Image Tag**: latest
- **Latest Image Digest**: sha256:94d56c340515b59895bd3ded1d20ef1e4b1dfc6387ff1bd8c1833f7eb7db26b8

## Push Commands

```bash
# Login to ECR
aws ecr get-login-password --region us-east-2 | docker login --username AWS --password-stdin 195275673733.dkr.ecr.us-east-2.amazonaws.com

# Tag the image
docker tag thinkbigg-nextjs:latest 195275673733.dkr.ecr.us-east-2.amazonaws.com/thinkbigg-nextjs:latest

# Push the image
docker push 195275673733.dkr.ecr.us-east-2.amazonaws.com/thinkbigg-nextjs:latest
```
