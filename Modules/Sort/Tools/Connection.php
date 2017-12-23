<?php
namespace Modules\Sort\Tools;

use Modules\CommonTools\Src\Curl\Curl;

class Connection
{
    private $domain = 'https://krr-prd.star-api.com';

    private $header = [
        'Unity-User-Agent' => 'app/0.0.0; Android OS 5.1.1 / API-22 LMY48Z/eng.absidea.20171024.072801; oppo oppo r7',
        'Content-Type' => 'application/json; charset=UTF-8',
        'X-STAR-REQUESTHASH' => '4c582796a2b45b7891e922fcf2b9a17ede772bc438d30031a564798c34644999',
        'X-Unity-Version' => '5.5.4f1',
        'User-Agent' => 'Dalvik/2.1.0 (Linux; U; Android 5.1.1; oppo r7 Build/LMY48Z)',
        'Host' => 'krr-prd.star-api.com',
        'Connection' => 'Keep-Alive',
        'Accept-Encoding' => 'gzip',
    ];
    
    private $version = '/api/app/version/get?platform=2&version=1.0.4';

    private $curl;

    public function __construct()
    {
        $this->curl = new Curl;
        $this->curl->setSSL();
        $this->curl->setHeaders($this->header);
    }

    public function getVersion()
    {
        $url = $this->domain . $this->version;
        $this->get2($url);
    }

    private function get2(string $url)
    {
        $curl = new Curler;
        $curl->setSSL();
        $curl->setHeaders($this->header);
        $curl->setGzip();
        $content = $curl->get($url);
        dd($content);
    }

    private function get(string $url)
    {
        $content = $this->curl->get($url);
        echo "$content";
    }
}
