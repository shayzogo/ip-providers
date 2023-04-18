<?php

require_once './interfaces/GeolocationProviderInterface.php';

class IpApi implements GeolocationProviderInterface {
	private $apiKey;
	private $ip;
	private $curlFactory;

	public function __construct(string $key, string $ip) {
		$this->apiKey = $key;
		$this->ip = $ip;
		$this->curlFactory = new CurlFactory();
	}

	public function getGeolocationData(): array {
		$url = "https://ip-api.com/json/{$this->ip}?fields=status,message,country,regionName,city,lat,lon";
		$options = [
			CURLOPT_TIMEOUT => 10,
		];

		$response = $this->curlFactory->makeRequest($url, 'GET', [], $options);


		$geolocationData = json_decode($response, true);

		if (!$this->isGeolocationDataValid($geolocationData)) {
			throw new Exception('Invalid geolocation data returned from API');
		}

		return $geolocationData;
	}

	public function isGeolocationDataValid(array $geolocationData): bool {
		return isset($geolocationData['status']) && $geolocationData['status'] == 'success'
			&& isset($geolocationData['country']) && isset($geolocationData['regionName'])
			&& isset($geolocationData['city']) && isset($geolocationData['lat']) && isset($geolocationData['lon']);
	}
}
