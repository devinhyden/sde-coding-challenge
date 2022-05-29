<?php
require_once 'Services/SuitabilityScore.php';
require_once 'DataTransferObjects/Driver.php';
require_once 'DataTransferObjects/Address.php';
require_once 'DataTransferObjects/Score.php';

if ($argc !== 3) {
	die("Address and drivers file required as parameters");
}

$addresses = file(dirname(__FILE__).'/'.$argv[1]);
if ( !$addresses) {
	die("Cannot find address file\n");
}

$drivers = file(dirname(__FILE__).'/'.$argv[2]);
if ( !$drivers) {
	die("Cannot find drivers file\n");
}
new SuitabilityScore($addresses, $drivers);