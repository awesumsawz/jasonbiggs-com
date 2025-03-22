# AWS Security Groups Configuration

## Load Balancer Security Group

- **Name**: thinkbigg-alb-sg
- **ID**: sg-0cf46d1848520fea1
- **Description**: Security group for ThinkBigg ALB
- **VPC**: vpc-0ff6a05d3735d7fbb

### Inbound Rules

| Type | Protocol | Port Range | Source      | Description |
|------|----------|------------|-------------|--------------|
| HTTP | TCP      | 80         | 0.0.0.0/0   | Allow HTTP from anywhere |
| HTTPS| TCP      | 443        | 0.0.0.0/0   | Allow HTTPS from anywhere |

## ECS Service Security Group

- **ID**: sg-0a1861d4a4553eded
- **Description**: Security group for ECS service
- **VPC**: vpc-0ff6a05d3735d7fbb

### Inbound Rules

| Type | Protocol | Port Range | Source      | Description |
|------|----------|------------|-------------|--------------|
| Custom TCP | TCP | 3000 | sg-0cf46d1848520fea1 | Allow traffic from ALB |
