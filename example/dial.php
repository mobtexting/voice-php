<?php
require(__DIR__.'/../vendor/autoload.php');

$response = new Mobtexting\Voice();
$response->answer();
$dial = $response->dial("+91720414xxxx", "+91803007xxxx"); // customer number, DID number
$dial->onNoAnswer("dial", array("+9172xxxx", "+9180xxxx")); // customer number, DID number


//print_r($response->toArray());

echo $response;
