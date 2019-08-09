<?php
require_once __DIR__ . '/vendor/autoload.php';
use Xhat\Payjs\Payjs;

// 配置通信参数
$config = [
    'mchid' => '***********',   // 配置商户号
    'key'   => '***********',   // 配置通信密钥
];

// 初始化
$payjs = new Payjs($config);

// 构造订单参数
$data = [
    'total_fee'    => 1,            // 金额，单位 分
    'body'         => '测试订单',    // 订单标题
    'out_trade_no' => time(),       // 商户订单号, 在用户侧请唯一
];

// 扫码支付
$rst = $payjs->native($data);
print_r($rst);
