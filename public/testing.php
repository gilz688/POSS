<?php
require 'PhpSerial.php';

$serial = new PhpSerial;
$serial->deviceSet("/dev/ttyUSB0");
$serial->confBaudRate(9600);
$success = $serial->deviceOpen('w+');
// We may need to return if nothing happens for 10 seconds
stream_set_timeout($serial->_dHandle, 10);

sleep(2);
$array = $serial->readPort();
var_dump($array);

$serial->deviceClose();

