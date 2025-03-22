# AWS CloudWatch Configuration

## Log Groups

### /ecs/thinkbigg-nextjs

- **ARN**: arn:aws:logs:us-east-2:195275673733:log-group:/ecs/thinkbigg-nextjs
- **Creation Time**: 1741813296150 (Unix timestamp)
- **Retention**: Default (Never expire)

### /ecs/thinkbigg-nextjs-taskdefinition

- **ARN**: arn:aws:logs:us-east-2:195275673733:log-group:/ecs/thinkbigg-nextjs-taskdefinition
- **Creation Time**: 1741751951632 (Unix timestamp)
- **Retention**: Default (Never expire)

## Log Streams

Log streams are created for each ECS task with the naming pattern:

```
ecs/thinkbigg-nextjs/{task-id}
```

For example:
- ecs/thinkbigg-nextjs/eb7b195e5cba488c877864786c38eefa
- ecs/thinkbigg-nextjs/8008f851973845e0894ea9c9f411f359
