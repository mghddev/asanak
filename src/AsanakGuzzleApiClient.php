<?php
namespace mghddev\asanak;

use Exception;
use GuzzleHttp\Client;

/**
 * Class AsanakGuzzleApiClient
 * @package mghddev\asanak
 */
class AsanakGuzzleApiClient implements iAsanakApiClient
{
    protected $default_config = [
        'base_uri'          => 'https://panel.asanak.com/webservice/v1rest',
        'sendSmsUrl'        => '/sendsms',
        'getStatusUrl'      => '/msgstatus',
    ];

    /**
     * @var mixed|string
     */
    private $base_uri;
    /**
     * @var Client
     */
    private Client $http_client;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var array
     */
    private array $config;

    /**
     * AsanakGuzzleApiClient constructor.
     * @param string $username
     * @param string $password
     * @param array $config
     */
    public function __construct(string $username, string $password, array $config = [])
    {
        $this->base_uri = $this->config['base_uri'] ?? $this->default_config['base_uri'];
        $this->http_client = new Client();
        $this->username = $username;
        $this->password = $password;
        $this->config = $config;
    }

    public function sendSms(SendSmsVO $smsVO)
    {
        $headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded'
        ];
        $uri = $this->base_uri . $this->default_config['sendSmsUrl'];
        $request_json_array = [
            "username" => $this->username,
            "password" => $this->password,
            "source" => $smsVO->getSource(),
            "destination" => implode(',', $smsVO->getDestination()),
            "message" => $smsVO->getMessage()
        ];

        $response = $this->http_client->request(
            'POST',
            $uri,
            [
                'headers' => $headers,
                'http_errors' => false,
                'json' => $request_json_array
            ]
        );

        try{
            return json_decode(
                $response->getBody()->getContents(),
                $assoc = true,
                $depth = 512,
                JSON_THROW_ON_ERROR
            );
        }
        catch (Exception $e) {
            throw $e;
        }
    }

    public function getStatus(array $msgIDs)
    {
        $headers = [
            'cache-control' => 'no-cache',
            'content-type' => 'application/x-www-form-urlencoded'
        ];
        $uri = $this->base_uri . $this->default_config['getStatusUrl'];
        $request_json_array = [
            "username" => $this->username,
            "password" => $this->password,
            "msgid" => implode(',', $msgIDs)
        ];

        $response = $this->http_client->request(
            'POST',
            $uri,
            [
                'headers' => $headers,
                'http_errors' => false,
                'json' => $request_json_array
            ]
        );

        $responseBody =  $response->getBody()->getContents();
    }
}