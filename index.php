<?php
error_reporting(2047);
header('Content-Type: text/html; charset=utf-8');
header('Cache-control: no-cache');  #чтобы выдача не кэшировалась

require_once('vendor/autoload.php');
require_once('class/yaWeatherApi.php');

$yaW = new yaWeatherApi();