# tmtpay

## 说明

集成微信和支付宝等多个支付渠道，实现tmtpost平台中的基本支付业务场景，包括创建订单，查询订单，删除订单，创建支付方式，修改支付方式，获取第三方支付渠道凭据

## 用法


```
composer require "papajo/tmtpay"
```

```php
$db  = new TmtPay\Storage\PayModel();
$pay = new TmtPay\Pay($db);
$pay->GenerateOrderId();
```

