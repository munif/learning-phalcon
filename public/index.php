<?php

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../apps/Bootstrap.php';

$app = new Bootstrap('frontend');
$app->init();

?>