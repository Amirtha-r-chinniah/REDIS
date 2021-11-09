<?php
require './vendor/autoload.php';
include 'config.php';

$intialTime = 0;
$completedTime=0;
$timedifference=-1;

$redis = new Predis\Client();
$studentList = '';

$catchedData = $redis->get('studentList');

if($catchedData)
{
    echo "Data is returned from Redis catch".'<br>';
    $intialTime = microtime(true)*1000;
    //Incase redis has the data in catche and assigning the data to the variable .
    
    $studentList = $catchedData;
    $completedTime = microtime(true)*1000;
    echo "TimeTaken:".round($completedTime-$intialTime,4);
    
}
else{
    $intialTime = microtime(true)*1000;
    //Incase redis do not have the data in catche, assigning the data to redis catche and assigning the data to a variable.
    echo "Data is returned from the mysqli".'<br>';

    $temp='';
    $result=mysqli_query($mysqli,"select * from students");
    while ($row = $result->fetch_assoc()) {
        $studentList .= $row['firstname'].$row["lastname"].'<br>';
        $temp .= $row['firstname'].' '.$row['lastname'].'<br>';
    }
    
    $completedTime = microtime(true)*1000;
    echo "TimeTaken:".round($completedTime-$intialTime,4);
    $redis->set('studentList',$temp);
    $redis->expire('studentList',10);
}

echo $studentList.'<br>';
?>