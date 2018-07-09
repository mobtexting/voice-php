<?php
require(__DIR__.'/../vendor/autoload.php');


$response = new Mobtexting\Voice();
$response->answer();
$response->say('Hello');
$filter = $response->filter([10]);
$filter->onFail('hangup');
$url = $filter->onPass('Url')->setUrl('google.com');
$url->onResponse('*', 'hangup');
$url->onResponse('x', 'hangup');


//print_r($response->toArray());

echo $response;
