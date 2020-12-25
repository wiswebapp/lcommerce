<?php


function printr($array){
    echo '<h1>Powered by Laravel Custom Helper</h1>';
    echo "<h3>Current Time : ".date('dMY (h:i:sa)')."</h3>";
    echo "<hr>";
    echo "<pre>";
    print_r($array);
    exit;
}

function adminAssets($url = ''){
    return URL::to('/backend/'.$url);
}

function toDate($date,$format = 'd-M-Y'){
    $newDate = date($format , strtotime($date));
    return $newDate;
}

function formatNum($number, $decimal = 2){
    $newNumber = number_format($number, $decimal); 
    return $newNumber;
}

function greetings()
{
    $time = date("H");
    
    $timezone = date("e");
    if ($time < "12") {
        $returnMsg = "Good morning";
    } else
    if ($time >= "12" && $time < "17") {
        $returnMsg = "Good afternoon";
    } else
    if ($time >= "17" && $time < "19") {
        $returnMsg = "Good evening";
    } else
    if ($time >= "19") {
        $returnMsg = "Good night";
    }
    return $returnMsg;
}