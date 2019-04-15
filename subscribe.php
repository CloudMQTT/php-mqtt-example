<?php
require 'phpMQTT.php';

$url = parse_url(getenv('CLOUDMQTT_URL'));
$topic = substr($url['path'], 1);

$client_id = "phpMQTT-subscriber";

function procmsg($topic, $msg){
  echo "Msg Recieved: $msg\n";
}
    
$mqtt = new Bluerhinos\phpMQTT($url['host'], $url['port'], $client_id);
if ($mqtt->connect(true, NULL, $url['user'], $url['pass'])) {
  $topics[$topic] = array(
      "qos" => 0,
      "function" => "procmsg"
  );
  $mqtt->subscribe($topics,0);
  while($mqtt->proc()) {}
  $mqtt->close();
} else {
  exit(1);
}

