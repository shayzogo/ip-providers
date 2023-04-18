<?php

require_once './services/GeolocationService.php';

$ip = '127.0.0.1';
$ipApi = new IpApi(getenv('ip-api-key'), $ip);
$ipStack = new IpStack(getenv('ip-stack-key'), $ip);

$providersArray = [$ipApi, $ipStack];
$geoLocationService = new GeolocationService($providersArray);

try {
	$geoLocationData = $geoLocationService->getGeolocationData();
} catch (Exception $e) {
	//...
}