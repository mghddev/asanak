<?php
namespace mghddev\asanak;

use Exception;
use mghddev\asanak\Exceptions\AsanakException;

/**
 * Class AsanakCurlApiClient
 * @package mghddev\asanak
 */
class AsanakCurlApiClient implements iAsanakApiClient
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
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var array
     */
    private $config;

    /**
     * AsanakCurlApiClient constructor.
     * @param string $username
     * @param string $password
     * @param array $config
     */
    public function __construct(string $username, string $password, array $config = [])
    {
        $this->base_uri = $this->config['base_uri'] ?? $this->default_config['base_uri'];
        $this->username = $username;
        $this->password = $password;
        $this->config = $config;
    }

    public function sendSms(SendSmsVO $smsVO)
    {
        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://panel.asanak.com/webservice/v1rest/sendsms",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => array(
                    'username' => $this->username,
                    'password' => $this->password,
                    'Source' => $smsVO->getSource(),
                    'Message' => $smsVO->getMessage(),
                    'destination' => implode(',', $smsVO->getDestination())
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true);
        } catch (Exception $exception) {
            throw new AsanakException($exception->getMessage());
        }
    }

    public function getStatus(array $msgIDs)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://panel.asanak.com/webservice/v1rest/msgstatus",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => array(
                'username' => $this->username,
                'password' => $this->password,
                'msgid' => implode(',', $msgIDs)
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;

    }
}