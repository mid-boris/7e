<?php
namespace Modules\RemoteSystem\Src;

use Config;
use Modules\CommonTools\Src\Curl\Curl;

class Connection
{
    private $domain;

    private $getTokenUrl;

    private $getAccountInfoUrl;

    public function __construct()
    {
        $this->domain = Config::get('remotesystem.remoteDomain');
        $this->getTokenUrl = $this->domain . Config::get('remotesystem.uriGetToken');
        $this->getAccountInfoUrl = $this->domain . Config::get('remotesystem.uriGetAccountInfo');
    }

    public function getToken()
    {
        $curl = new Curl($this->getTokenUrl);
        $curl->post($this->getTokenUrl, [
            'account' => 'tuohoi87',
            'password' => '123456',
        ]);

        dd($this->getTokenUrl, $curl->response->error);
    }

    private function getCurl()
    {
    }
}
