# AWS Route 53 Configuration

## Hosted Zone

- **ID**: Z06755183VB5CRWOKJGE5
- **Name**: thinkbigg.dev
- **Type**: Public

## DNS Records

### A Records

#### thinkbigg.dev
- **Type**: A (Alias)
- **Value**: thinkbigg-alb-1836457108.us-east-2.elb.amazonaws.com
- **Alias Target Hosted Zone ID**: Z3AADJGX6KTTL2

#### www.thinkbigg.dev
- **Type**: A (Alias)
- **Value**: thinkbigg-alb-1836457108.us-east-2.elb.amazonaws.com
- **Alias Target Hosted Zone ID**: Z3AADJGX6KTTL2

### CNAME Records (Certificate Validation)

#### _6c778e0aba8e69ba8b8c5eaf44932a62.thinkbigg.dev
- **Type**: CNAME
- **Value**: _3a0d8ce9895d8a54abcc66c3cfe1f078.xlfgrmvvlj.acm-validations.aws

#### _3fa163a81dd5d40154b6e64cb1c503ce.www.thinkbigg.dev
- **Type**: CNAME
- **Value**: _9c9f29e0680bf33bf1da3c11026eea6d.xlfgrmvvlj.acm-validations.aws

## Name Servers

- ns-1843.awsdns-38.co.uk
- ns-18.awsdns-02.com
- ns-1409.awsdns-48.org
- ns-969.awsdns-57.net
