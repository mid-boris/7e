<?php
namespace Modules\RemoteSystem\Tools;

use Exception;

class Curler
{
    private $curl;

    /** @var  string */
    private $url;

    private $response;

    private $info;

    private $header;

    private $httpCode;

    private $error;

    public function __construct()
    {
        $this->curl = curl_init();
        $this->withHeader();
        $this->returnTransfer();
    }

    public function get($url = null, array $getData = [])
    {
        $query = null;
        if (count($getData) > 0) {
            $query = http_build_query($getData);
        }

        if (!is_null($url)) {
            $this->setUrl($url);
        }
        if (!is_null($query)) {
            $this->url .= "?{$query}";
        }

        $this->setOpt(CURLOPT_POST, false);
        $this->setOpt(CURLOPT_URL, $this->url);

        $response = $this->exec();

        if ($response === false) {
            $this->error = $this->error();
            $this->close();
            throw new Exception($this->error);
        }

        $this->setInformation($response);

        $this->close();
        return $this->response;
    }

    public function post($url = null, array $postData = [])
    {
        if (!is_null($url)) {
            $this->setUrl($url);
        }

        $this->setOpt(CURLOPT_URL, $this->url);
        $this->setOpt(CURLOPT_POST, true);
        if (count($postData) > 0) {
            $this->setOpt(CURLOPT_POSTFIELDS, http_build_query($postData));
        }

        $response = $this->exec();

        if ($response === false) {
            $this->error = $this->error();
            $this->close();
            throw new Exception($this->error);
        }

        $this->setInformation($response);

        $this->close();
        return $this->response;
    }

    public function postJson($url = null, $json = null)
    {
        if (!is_null($url)) {
            $this->setUrl($url);
        }

        $this->setOpt(CURLOPT_URL, $this->url);
        $this->setOpt(CURLOPT_POST, true);
        if ($json) {
            $this->setOpt(CURLOPT_POSTFIELDS, $json);
        }
        $response = $this->exec();

        if ($response === false) {
            $this->error = $this->error();
            $this->close();
            throw new Exception($this->error);
        }

        $this->setInformation($response);

        $this->close();
        return $this->response;
    }

    protected function setInformation($response)
    {
        $this->info = $this->info();
        $headerSize = $this->getHeaderSize();

        $this->header = substr($response, 0, $headerSize);
        $this->response = substr($response, $headerSize);

        $this->setHttpCode();
    }

    public function getError()
    {
        return $this->error;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getResponseArray()
    {
        return json_decode($this->response, true);
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getHeaderArray()
    {
        $headerArray = [];
        foreach (explode("\r\n", $this->header) as $key => $value) {
            if ($key && $value) {
                list ($k, $v) = explode(': ', $value);
                $headerArray[$k] = $v;
            }
        }
        return $headerArray;
    }

    protected function setHttpCode()
    {
        $this->httpCode = curl_getinfo($this->curl, CURLINFO_HTTP_CODE);
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function setSSL()
    {
        $this->setOpts([
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
        ]);
    }

    public function setOpt($key, $value)
    {
        curl_setopt($this->curl, $key, $value);
    }

    public function setOpts(array $options)
    {
        foreach ($options as $key => $value) {
            $this->setOpt($key, $value);
        }
    }

    public function setHeader($key, $value)
    {
        $headers[] = "{$key}: $value";
        $this->setOpt(CURLOPT_HTTPHEADER, $headers);
    }

    public function setHeaders(array $options)
    {
        $headers = [];
        foreach ($options as $key => $value) {
            $headers[] = "{$key}: $value";
        }
        $this->setOpt(CURLOPT_HTTPHEADER, $headers);
    }

    public function setCookieJar(string $fileName = null)
    {
        if (is_null($fileName)) {
            $fileName = 'cookie.txt';
        }
        $dirPath = storage_path('app/cookies');
        if (!is_dir($dirPath)) {
            mkdir($dirPath);
        }
        $path = storage_path("app/cookies/{$fileName}");
        $this->setOpt(CURLOPT_COOKIESESSION, true);
        $this->setOpt(CURLOPT_COOKIEJAR, $path);
        $this->setOpt(CURLOPT_COOKIEFILE, $path);
    }

    public function setGzip()
    {
        $this->setOpt(CURLOPT_ENCODING, 'gzip,deflate');
    }

    protected function withHeader()
    {
        $this->setOpt(CURLINFO_HEADER_OUT, true);
        $this->setOpt(CURLOPT_HEADER, true);
    }

    protected function error()
    {
        return curl_error($this->curl);
    }

    protected function exec()
    {
        return curl_exec($this->curl);
    }

    protected function close()
    {
        curl_close($this->curl);
    }

    protected function returnTransfer()
    {
        $this->setOpt(CURLOPT_RETURNTRANSFER, true);
    }

    protected function info()
    {
        return curl_getinfo($this->curl);
    }

    protected function getHeaderSize()
    {
        return curl_getinfo($this->curl, CURLINFO_HEADER_SIZE);
    }
}
