### Asanak Web service for sending sms
you can find usage of this library down here,

````php

<?php

use mghddev\asanak\AsanakCurlApiClient;
use mghddev\asanak\SendSmsVO;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'vendor/autoload.php';

$client = new AsanakCurlApiClient('***', '###');

$sms = new SendSmsVO();
$msgIDs = $sms->setSource('98******')
->setDestination(['0912*****'])
->setMessage('سلام پسر گل');

$res = $client->sendSms($sms);
//$res = $client->getStatus($res);
var_dump($res);

