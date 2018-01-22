<?php
namespace Modules\RemoteSystem\Src;

use Config;
use Modules\Base\Exception\BaseException;
use Modules\Error\Constants\ErrorCode;
use Modules\RemoteSystem\Tools\Curler;

class GoogleMapConnection
{
    /** @var  Curler */
    private $curl;

    /** @var string */
    private $mapApi;

    private $mapData;

    public function __construct()
    {
        $this->mapApi = Config::get('remotesystem.googleMapApi');
    }

    public function getMapInfoFromAddress(string $address)
    {
        $this->initCurl();
        $this->curl->get($this->getApiUrlWithParameter($address));

        if ($this->curl->getHttpCode() != 200) {
            throw new BaseException(
                'network error',
                ErrorCode::REMOTE_SYSTEM_GET_TOKEN_ERROR
            );
        }

        $this->mapData = $this->dataValidate($this->curl->getResponse());
        return $this;
    }

    /**
     * google map 所回傳的 results 資訊
     * @return mixed
     */
    public function getResults()
    {
        return $this->mapData;
    }

    private function dataValidate($response)
    {
        if (!$response) {
            throw new BaseException(
                'data error',
                ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_GET_DATA_ERROR
            );
        }

        $response = json_decode($response, true);
        if (count($response) < 1 || !array_key_exists('status', $response)) {
            throw new BaseException(
                'decoder error',
                ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_DATA_DECODER_ERROR
            );
        }

        if ($response['status'] != 'OK') {
            $errorMsg = 'normal error.';
            if (array_key_exists('error_message', $response)) {
                $errorMsg = $response['error_message'];
            }
            throw new BaseException(
                $errorMsg,
                ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_NORMAL_ERROR
            );
        }

        if (!array_key_exists('results', $response)) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_CAN_NOT_GET_RESULT),
                ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_CAN_NOT_GET_RESULT
            );
        }
        return $response['results'];
    }

    private function initCurl()
    {
        $this->curl = new Curler;
        $this->curl->setSSL();
    }

    /**
     * 帶參數的api位置
     * @param string $address
     * @return string
     * @throws BaseException
     */
    private function getApiUrlWithParameter(string $address)
    {
        if (is_null($address) || empty($address)) {
            throw new BaseException(
                trans('entrust::errors.' . ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_PARAMETER_ERROR),
                ErrorCode::REMOTE_SYSTEM_GOOGLE_MAP_PARAMETER_ERROR
            );
        }
        $parameter = [
            'key' => config('remotesystem.googleMapApiKey'),
            'address' => $address,
            'language' => 'zh-TW',
        ];
        return "{$this->mapApi}?" . http_build_query($parameter);
    }
}
