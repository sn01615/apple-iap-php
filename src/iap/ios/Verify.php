<?php


namespace sn01615\iap\ios;


use Composer\CaBundle\CaBundle;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\RequestOptions;

class Verify
{

    private $url;
    private $password;
    private $exclude_old_transactions;

    public function __construct($sandbox = null)
    {
        $this->endpoint($sandbox);
    }

    public function endpoint($sandbox)
    {
        if ($sandbox) {
            $this->url = 'https://sandbox.itunes.apple.com/verifyReceipt'; // 测试验证地址
        } else {
            $this->url = 'https://buy.itunes.apple.com/verifyReceipt'; // 正式验证地址
        }
        return $this;
    }

    public function query($receipt)
    {
        $body = $this->buildRequestBody($receipt);
        $json = $this->doVerify($body);
        $json = json_decode($json);
        return $json;
    }

    private function buildRequestBody($receipt)
    {
        $jsonData = [
            'receipt-data' => $receipt,
        ];
        if ($this->password)
            $jsonData['password'] = $this->password;
        if ($this->password)
            $jsonData['exclude-old-transactions'] = $this->exclude_old_transactions ? true : false;
        return json_encode($jsonData);
    }

    private function doVerify($body)
    {
        return $this->doQuery('POST', $this->url, [
            'body' => $body,
        ]);
    }

    private function doQuery($method, $url, array $options = [])
    {
        $client = new Client([
            RequestOptions::VERIFY => CaBundle::getSystemCaRootBundlePath(),
        ]);
        // Send an asynchronous request.
        $request = new Request($method, $url);
        $promise = $client->sendAsync($request, $options)->then(function (Response $response) use (&$data) {
            $data = (string)$response->getBody();
        });
        $promise->wait();
        return $data;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setExcludeOldTransactions($exclude)
    {
        $this->exclude_old_transactions = $exclude;
        return $this;
    }
}
