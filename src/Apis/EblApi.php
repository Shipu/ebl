<?php

namespace Shipu\Ebl\Apis;

use Shipu\Ebl\Response\EblResponse;

abstract class EblApi extends \Apiz\AbstractApi
{
    protected $version;

    protected $apiUser;

    protected $apiKey;

    protected $config;

    public $options = [
        'timeout' => 30,
        'http_errors' => false
    ];

    /**
     * @var string
     */
    protected $response = EblResponse::class;

    /**
     * EblApi constructor.
     *
     * @param $config
     */
    public function __construct( $config )
    {
        $this->config  = $config;
        $this->version = $config[ 'version' ];
        $this->apiUser = $config[ 'api_user' ];
        $this->apiKey  = $config[ 'api_key' ];

        parent::__construct();
    }

    /**
     * set base URL for guzzle client
     *
     * @return string
     */
    protected function baseUrl()
    {
        return "https://api.eblsky.com/" . $this->version . '/';
    }

    public function authorization()
    {
        return $this->headers([
            "Content-Type" => "application/json",
            "Authorization" => "Basic " . base64_encode($this->apiUser . ":" . $this->apiKey)
        ]);
    }
}
