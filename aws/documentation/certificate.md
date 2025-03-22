# AWS Certificate Manager (ACM) Configuration

## SSL/TLS Certificate

- **ARN**: arn:aws:acm:us-east-2:195275673733:certificate/8bf3e906-3ef7-4d07-98e5-bbb299c4fd67
- **Domain Name**: thinkbigg.dev
- **Subject Alternative Names**: www.thinkbigg.dev
- **Status**: ISSUED
- **Type**: AMAZON_ISSUED
- **Key Algorithm**: RSA-2048
- **Signature Algorithm**: SHA256WITHRSA

## DNS Validation Records

### thinkbigg.dev Validation
- **Name**: _6c778e0aba8e69ba8b8c5eaf44932a62.thinkbigg.dev
- **Type**: CNAME
- **Value**: _3a0d8ce9895d8a54abcc66c3cfe1f078.xlfgrmvvlj.acm-validations.aws

### www.thinkbigg.dev Validation
- **Name**: _3fa163a81dd5d40154b6e64cb1c503ce.www.thinkbigg.dev
- **Type**: CNAME
- **Value**: _9c9f29e0680bf33bf1da3c11026eea6d.xlfgrmvvlj.acm-validations.aws
