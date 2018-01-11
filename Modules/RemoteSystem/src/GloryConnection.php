<?php
namespace Modules\RemoteSystem\Src;

use Config;
use Modules\Base\Exception\BaseException;
use Modules\Error\Constants\ErrorCode;
use Modules\RemoteSystem\Constants\GloryErrorCode;
use Modules\RemoteSystem\Tools\Curler;

class GloryConnection
{
    /** @var  Curler */
    private $curl;

    /** @var  string */
    private $token;

    /** @var  array */
    private $userInfo;

    private $domain;

    private $getTokenUrl;

    private $getAccountInfoUrl;

    public function __construct()
    {
        $this->domain = Config::get('remotesystem.remoteDomain');
        $this->getTokenUrl = $this->domain . Config::get('remotesystem.uriGetToken');
        $this->getAccountInfoUrl = $this->domain . Config::get('remotesystem.uriGetAccountInfo');
    }

    public function sendToken(string $user, string $password)
    {
        $this->initCurl();
        $this->curl->setHeaders($this->getHeader());
        $this->curl->post($this->getTokenUrl, [
            'account' => $user,
            'password' => $password,
        ]);

        if ($this->curl->getHttpCode() != 200) {
            throw new BaseException(
                'network error',
                ErrorCode::REMOTE_SYSTEM_GET_TOKEN_ERROR
            );
        }

        $data = $this->dataValidate($this->curl->getResponse());
        $this->token = $data['token'];
        return $this;
    }

    public function sendUserInfo()
    {
        $this->initCurl();
        $header = array_merge($this->getHeader(), [
            'Authorization' => sprintf('Bearer %s', $this->token),
        ]);
        $this->curl->setHeaders($header);
        $this->curl->get($this->getAccountInfoUrl);

        if ($this->curl->getHttpCode() != 200) {
            throw new BaseException(
                'network error',
                ErrorCode::REMOTE_SYSTEM_GET_TOKEN_ERROR
            );
        }

        $data = $this->dataValidate($this->curl->getResponse());
        $this->userInfo = $data;
        return $this;
    }

    public function getUserInfo()
    {
        return $this->userInfo;
    }

    private function dataValidate($response)
    {
        if (!$response) {
            throw new BaseException(
                'data error',
                ErrorCode::REMOTE_SYSTEM_GET_DATA_ERROR
            );
        }

        $response = json_decode($response, true);
        if (count($response) < 1 || !array_key_exists('error', $response)) {
            throw new BaseException(
                'decoder error',
                ErrorCode::REMOTE_SYSTEM_DATA_DECODER_ERROR
            );
        }

        if ($response['error'] != 0) {
            $eroCode = GloryErrorCode::mappingCode($response['error']);
            throw new BaseException(
                'something error: ' . $response['error'],
                $eroCode
            );
        }
        return $response['data'];
    }

    private function initCurl()
    {
        $this->curl = new Curler;
    }

    private function getHeader()
    {
        $headers = [
//            'Unity-User-Agent' =>
//                'app/0.0.0; Android OS 5.1.1 / API-22 LMY48Z/eng.absidea.20171024.072801; oppo oppo r7',
//            'Content-Type' => 'application/json; charset=UTF-8',
            'User-Agent' => 'Dalvik/2.1.0 (Linux; U; Android 5.1.1; oppo r7 Build/LMY48Z)',
            'Connection' => 'Keep-Alive',
        ];
        return $headers;
    }
}
