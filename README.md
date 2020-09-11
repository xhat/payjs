<p align="center">
    <img src="https://payjs.cn/static/images/logo.png" width=80 />
</p>
<h2 align="center">PAYJS Wechat Payment Composer Package</h2>
<p align="center">
  
   <a href="https://packagist.org/packages/xhat/payjs">
      <img src="https://poser.pugx.org/xhat/payjs/v/stable.png" alt="Latest Stable Version">
  </a> 
  
  <a href="https://packagist.org/packages/xhat/payjs">
      <img src="https://poser.pugx.org/xhat/payjs/downloads.png" alt="Total Downloads">
  </a> 
  
  <a href="https://packagist.org/packages/xhat/payjs">
    <img src="https://poser.pugx.org/xhat/payjs/license.png" alt="License">
  </a>
</p>

## 简介
本项目是基于 PAYJS 的 API 开发的 Composer Package，可直接用于生产环境

PAYJS 针对个人主体提供微信支付接入能力，是经过检验的正规、安全、可靠的微信支付个人开发接口

其它版本: [PAYJS Laravel 开发包](https://github.com/xhat/payjs-laravel)

## 安装

通过 Composer 安装

```bash
$ composer require xhat/payjs
```

## 使用方法

首先在业务中引入

```php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Xhat\Payjs\Payjs;

// 配置通信参数
$config = [
    'mchid' => '12323412323',   // 配置商户号
    'key'   => 'sadfsaddsaf',   // 配置通信密钥
];

// 初始化
$payjs = new Payjs($config);
```

其次开始使用

- 扫码支付

```php
// 构造订单基础信息
$data = [
    'body' => '订单测试',                        // 订单标题
    'total_fee' => 2,                           // 订单金额
    'out_trade_no' => time(),                   // 订单号
    'attach' => 'test_order_attach',            // 订单附加信息(可选参数)
    'notify_url' => 'https://www.baidu.com',    // 异步通知地址(可选参数)
];

$result = $payjs->native($data);
print_r($result);
```

- 收银台模式支付（直接在微信浏览器打开）

```php
// 构造订单基础信息
$data = [
    'body' => '订单测试',                         // 订单标题
    'total_fee' => 2,                            // 订单金额
    'out_trade_no' => time(),                    // 订单号
    'attach' => 'test_order_attach',             // 订单附加信息(可选参数)
    'notify_url' => 'https://www.baidu.com',     // 异步通知地址(可选参数)
    'callback_url' => 'https://www.baidu.com',   // 支付后前端跳转地址(可选参数)
];
$url = $payjs->cashier($data);
header('Location:'.$url);
exit;
```

- JSAPI模式支付

```php
// 构造订单基础信息
$data = [
    'body' => '订单测试',                         // 订单标题
    'total_fee' => 2,                            // 订单金额
    'out_trade_no' => time(),                    // 订单号
    'attach' => 'test_order_attach',             // 订单附加信息(可选参数)
    'notify_url' => 'https://www.baidu.com',     // 异步通知地址(可选参数)
    'openid' => 'xxxxxxxxxxxxx',                 // OPENID (必选参数)
];

$result = $payjs->jsapi($data);
print_r($result);
```
- H5 模式支付

```php
// 构造订单基础信息
$data = [
    'body'         => '订单测试',                 // 订单标题
    'total_fee'    => 2,                         // 订单金额
    'out_trade_no' => time(),                    // 订单号
    'attach'       => 'test_order_attach',       // 订单附加信息(可选参数)
    'notify_url'   => 'https://www.baidu.com',   // 异步通知地址(可选参数)
    'callback_url' => 'https://www.qq.com',      // 前端跳转url(可选参数)
];

$result = $payjs->mweb($data);
print_r($result);
```

- 查询订单

```php
// 根据订单号查询订单状态
$payjs_order_id = '********************';
$result = $payjs->check($payjs_order_id);
print_r($result);
```

- 关闭订单

```php
// 根据订单号关闭订单
$payjs_order_id = '********************';
$result = $payjs->close($payjs_order_id);
print_r($result);
```

- 退款

```php
// 根据订单号退款
$payjs_order_id = '*********************';
$result = $payjs->refund($payjs_order_id);
print_r($result);
```

- 投诉订单获取

```php
// 构造订单基础信息
$data = [
    'mchid'         => '123123',                 // 商户号
];

$result = $payjs->complaint($data);
print_r($result);
```

- 获取商户资料


```php
// 返回商户基础信息
$result = $payjs->info();
print_r($result);
```

- 获取用户资料

```php
// 根据订单信息中的 OPENID 查询用户资料
$openid = '*******************';
$result = $payjs->user($openid);
print_r($result);
```

- 查询银行名称

```php
// 根据订单信息中的银行编码查询银行中文名称
$bank = '*******************';
$result = $payjs->bank($bank);
print_r($result);
```

- 接收异步通知

```php
// 接收异步通知,无需关注验签动作,已自动处理
$notify_info = $payjs->notify();
// 接收信息后自行处理
```

## 更新日志
Version 1.5.0
增加投诉API
增加H5支付API

Version 1.4.3
主要去除了对 GuzzleHttp 包的依赖，同时去除了 Curl 60 的错误提示
修复jsapi的一处bug

## 安全相关
如果您在使用过程中发现各种 bug，请积极反馈，我会尽早修复

