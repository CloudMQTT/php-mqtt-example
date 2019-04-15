<?php
require 'phpMQTT.php';

$url = parse_url(getenv('CLOUDMQTT_URL'));
$topic = substr($url['path'], 1);
$client_id = "phpMQTT-publisher";

$message = "Hello CloudMQTT!";

$mqtt = new Bluerhinos\phpMQTT($url['host'], $url['port'], $client_id);
if ($mqtt->connect(true, NULL, $url['user'], $url['pass'])) {
    $mqtt->publish($topic, $message, 0);
    echo "Published message: " . $message;
    $mqtt->close();
}else{
    echo "Fail or time out<br />";
}
