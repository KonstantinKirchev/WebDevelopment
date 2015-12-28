<?php
error_reporting(E_ALL ^ E_NOTICE);

include '../../myFrame/App.php';

$app = \myFrame\App::getInstance();

$app->setRouter('RPCRouter');

$app->run();