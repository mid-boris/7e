<?php
namespace Modules\Sort\Tools;

class Curler
{
    private $curl;

    /** @var  string */
    private $url;

    private $response;

    private $info;

    public function __construct()
    {
        $this->curl = curl_init();
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
        $this->setOpt(CURLOPT_URL, $this->url);
        $this->response = $this->exec();
        $this->info = $this->info();
        $this->close();
        return $this->response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function getHttpCode()
    {
        return $this->info['http_code'];
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
        $this->setOpt(CURLOPT_HTTPHEADER, [
            $key => $value
        ]);
    }

    public function setHeaders(array $options)
    {
        $this->setOpt(CURLOPT_HTTPHEADER, $options);
    }

    public function setCookieJar(string $fileName = null)
    {
        if (is_null($fileName)) {
            $fileName = 'cookie.txt';
        }
        $dirPath = public_path('cookies');
        if (!is_dir($dirPath)) {
            mkdir($dirPath);
        }
        $path = public_path("cookies/{$fileName}");
        $this->setOpt(CURLOPT_COOKIEJAR, $path);
    }

    public function setGzip()
    {
        $this->setOpt(CURLOPT_ENCODING, 'gzip,deflate');
    }

    public function error()
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

    protected function info()
    {
        return curl_getinfo($this->curl);
    }
}
