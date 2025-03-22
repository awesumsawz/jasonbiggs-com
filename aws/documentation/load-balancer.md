# AWS Load Balancer Configuration

## Application Load Balancer

- **Name**: thinkbigg-alb
- **ARN**: arn:aws:elasticloadbalancing:us-east-2:195275673733:loadbalancer/app/thinkbigg-alb/a076cd6b5c5d9fdb
- **DNS Name**: thinkbigg-alb-1836457108.us-east-2.elb.amazonaws.com
- **Security Group**: sg-0cf46d1848520fea1

## Listeners

### HTTP Listener (Port 80)
- **ARN**: arn:aws:elasticloadbalancing:us-east-2:195275673733:listener/app/thinkbigg-alb/a076cd6b5c5d9fdb/fe44fbb9bfdd4d5e
- **Action**: Redirect to HTTPS

### HTTPS Listener (Port 443)
- **ARN**: arn:aws:elasticloadbalancing:us-east-2:195275673733:listener/app/thinkbigg-alb/a076cd6b5c5d9fdb/1ee1dc2ea6e88066
- **Certificate ARN**: arn:aws:acm:us-east-2:195275673733:certificate/8bf3e906-3ef7-4d07-98e5-bbb299c4fd67
- **SSL Policy**: ELBSecurityPolicy-2016-08

## Target Group

- **Name**: thinkbigg-tg
- **ARN**: arn:aws:elasticloadbalancing:us-east-2:195275673733:targetgroup/thinkbigg-tg/e56081a920cf8716
- **Port**: 3000
- **Protocol**: HTTP
- **Target Type**: ip
- **Health Check Path**: /
