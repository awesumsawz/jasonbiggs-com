# AWS Troubleshooting Guide

## Common Issues and Solutions

### Application Not Accessible

1. **Check ECS Service Status**:
   ```bash
   aws ecs describe-services --cluster think-bigg --services thinkbigg-service --query "services[0].events[0:5]"
   ```

2. **Check Target Group Health**:
   ```bash
   aws elbv2 describe-target-health --target-group-arn arn:aws:elasticloadbalancing:us-east-2:195275673733:targetgroup/thinkbigg-tg/e56081a920cf8716
   ```

3. **Check Application Logs**:
   ```bash
   aws logs describe-log-streams --log-group-name "/ecs/thinkbigg-nextjs" --order-by LastEventTime --descending --limit 1
   aws logs get-log-events --log-group-name "/ecs/thinkbigg-nextjs" --log-stream-name "STREAM_NAME"
   ```

### Container Failing to Start

1. **Check Task Status**:
   ```bash
   aws ecs describe-tasks --cluster think-bigg --tasks TASK_ARN
   ```

2. **Check Container Logs**:
   ```bash
   aws logs get-log-events --log-group-name "/ecs/thinkbigg-nextjs" --log-stream-name "STREAM_NAME"
   ```

3. **Common Container Issues**:
   - Port conflicts (trying to use port 80 instead of 3000)
   - Missing environment variables
   - Memory or CPU constraints

### SSL Certificate Issues

1. **Check Certificate Status**:
   ```bash
   aws acm describe-certificate --certificate-arn arn:aws:acm:us-east-2:195275673733:certificate/8bf3e906-3ef7-4d07-98e5-bbb299c4fd67 --query "Certificate.Status"
   ```

2. **Verify DNS Validation Records**:
   ```bash
   aws route53 list-resource-record-sets --hosted-zone-id Z06755183VB5CRWOKJGE5 | grep -A 5 "CNAME"
   ```

### Environment Variable Issues

1. **Check Secrets Manager Access**:
   - Verify the task execution role has permission to access the secret
   - Check the secret ARN in the task definition

2. **Verify Secret Values**:
   ```bash
   aws secretsmanager get-secret-value --secret-id thinkbigg/env-vars --query "SecretString" --output text > /tmp/secret.json
   cat /tmp/secret.json | jq .
   rm /tmp/secret.json  # Remove the file after checking
   ```

### Load Balancer Issues

1. **Check Listener Configuration**:
   ```bash
   aws elbv2 describe-listeners --load-balancer-arn arn:aws:elasticloadbalancing:us-east-2:195275673733:loadbalancer/app/thinkbigg-alb/a076cd6b5c5d9fdb
   ```

2. **Check Security Group Rules**:
   ```bash
   aws ec2 describe-security-groups --group-ids sg-0cf46d1848520fea1
   ```

## Debugging Tools

### ECS Execute Command

To connect to a running container (requires Session Manager Plugin):

```bash
aws ecs execute-command --cluster think-bigg --task TASK_ARN --container thinkbigg-nextjs --command "/bin/sh" --interactive
```

Once connected, you can:
- Check environment variables: `env | sort`
- Check running processes: `ps aux`
- Check network connectivity: `nc -zv thinkbigg.dev 443`

### CloudWatch Logs Insights

Use CloudWatch Logs Insights to query logs:

```
fields @timestamp, @message
| sort @timestamp desc
| limit 100
| filter @message like "error"
```

### AWS X-Ray (if enabled)

If AWS X-Ray is enabled, you can trace requests through your application to identify bottlenecks or errors.
