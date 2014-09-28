<?php

require("../vendor/autoload.php");

$transport = new Puzzle\Client();
$transport->setHost("127.0.0.1");
// optional with port
// $transport->setHost("127.0.0.1", "9200");

// example if you want to use basic auth (e.g. you are using a proxy script)
// $transport->setAuthentication("user", "password");

$esClient = new EsClient\Client();
$esClient->injectTransport($transport);

$params = array();

$params['body'] = array("test"=> "asdasd");
$params['index'] = "custom";
$params['type'] = "typ";
$params['id'] = "2";

error_log(var_export($esClient->index($params),true));