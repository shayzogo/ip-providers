<?php

require_once './services/GeolocationService.php';

$ipApi = new IpApi();
$ipStack = new IpStack();

$providersArray = [$ipApi, $ipStack];
$geoLocationService = new GeolocationService($providersArray);
$ip = '127.0.0.1';
try {
	$geoLocationData = $geoLocationService->getGeolocationData($ip);
} catch (Exception $e) {
	//...
}