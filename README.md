# ios-iap-php

iOS支付验证

## install
```bash
composer require sn01615/apple-iap-php
```

## use
```php

use sn01615\iap\ios\Verify;

include "../vendor/autoload.php";

$cc = new Verify();

$receipt = ".."; // 凭据

$cc->endpoint(true);// 可选切，换到沙盒环境

$cc->setPassword('123');// 可选，如果是连续订阅需要密码

$vv = $cc->query($receipt);

// 打印结果
var_dump($vv);


/**
// 返回示例
object(stdClass)#648 (3) {
  ["receipt"]=>
  object(stdClass)#666 (18) {
    ["receipt_type"]=>
    string(10) "Production"
    ["adam_id"]=>
    int(902861234)
    ["app_item_id"]=>
    int(902861234)
    ["bundle_id"]=>
    string(17) "com.xx.xxx"
    ["application_version"]=>
    string(3) "722"
    ["download_id"]=>
    int(75072419401234)
    ["version_external_identifier"]=>
    int(836721234)
    ["receipt_creation_date"]=>
    string(27) "2020-07-22 02:26:01 Etc/GMT"
    ["receipt_creation_date_ms"]=>
    string(13) "1595384761000"
    ["receipt_creation_date_pst"]=>
    string(39) "2020-07-21 19:26:01 America/Los_Angeles"
    ["request_date"]=>
    string(27) "2020-07-22 03:31:59 Etc/GMT"
    ["request_date_ms"]=>
    string(13) "1595388719760"
    ["request_date_pst"]=>
    string(39) "2020-07-21 20:31:59 America/Los_Angeles"
    ["original_purchase_date"]=>
    string(27) "2020-07-21 13:18:24 Etc/GMT"
    ["original_purchase_date_ms"]=>
    string(13) "1595337504000"
    ["original_purchase_date_pst"]=>
    string(39) "2020-07-21 06:18:24 America/Los_Angeles"
    ["original_application_version"]=>
    string(3) "722"
    ["in_app"]=>
    array(1) {
      [0]=>
      object(stdClass)#647 (11) {
        ["quantity"]=>
        string(1) "1"
        ["product_id"]=>
        string(24) "com.xx.xx.xx.xx"
        ["transaction_id"]=>
        string(15) "350000687123456"
        ["original_transaction_id"]=>
        string(15) "350000687123456"
        ["purchase_date"]=>
        string(27) "2020-07-22 02:25:25 Etc/GMT"
        ["purchase_date_ms"]=>
        string(13) "1595384725000"
        ["purchase_date_pst"]=>
        string(39) "2020-07-21 19:25:25 America/Los_Angeles"
        ["original_purchase_date"]=>
        string(27) "2020-07-22 02:25:25 Etc/GMT"
        ["original_purchase_date_ms"]=>
        string(13) "1595384725000"
        ["original_purchase_date_pst"]=>
        string(39) "2020-07-21 19:25:25 America/Los_Angeles"
        ["is_trial_period"]=>
        string(5) "false"
      }
    }
  }
  ["status"]=>
  int(0)
  ["environment"]=>
  string(10) "Production"
}

**/

```

## 参考链接

订阅
https://developer.apple.com/library/archive/documentation/NetworkingInternet/Conceptual/StoreKitGuide/Chapters/Subscriptions.html

收据
https://developer.apple.com/library/archive/releasenotes/General/ValidateAppStoreReceipt/Chapters/ReceiptFields.html#//apple_ref/doc/uid/TP40010573-CH106
