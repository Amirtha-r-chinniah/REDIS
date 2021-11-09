<?php
require './vendor/autoload.php';

$intialTime = 0;
$completedTime=0;
$timedifference=-1;

$redis = new Predis\Client();

$foodList = [];

$intialTime = microtime(true)*1000;

$catchedData = $redis->get('foodList');

$completedTime = microtime(true)*1000;

if($catchedData)
{
    //Incase redis has the data in catche and assigning the data to the variable .
    echo "Data is returned from Redis catch".'<br>';

    $foodList = json_decode($catchedData);
    
}
else{
    $intialTime = microtime(true)*1000;
    //Incase redis do not have the data in catche, assigning the data to redis catche and assigning the data to a variable.
    echo "Data is returned from API";

    $httpClient = new GuzzleHttp\Client(['base_uri' => "http://127.0.0.1:5000/",  'defaults' => [
        'exceptions' => false
    ],'verify' => false]);
    //what is httpclient
    $response = $httpClient -> request('GET','Indian');
    $foodList = json_decode($response->getBody());
    $redis->set('foodList',json_encode($foodList));
    $redis->expire('foodList',10);
    $completedTime = microtime(true)*1000;
}

for ($count = 0; $count < 10; $count++) {
  echo $foodList[$count] . '<br>';
}

$timedifference = $completedTime - $intialTime;
echo "TimeTaken:".$timedifference;


?>