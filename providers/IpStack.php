<?php

require_once './interfaces/GeolocationProviderInterface.php';
require_once './CurlFactory.php';

class IpStack implements GeolocationProviderInterface
{
	private $apiKey;
	private $ip;
	private $curlFactory;

	public function __construct(string $apiKey, string $ip)
	{
		$this->apiKey = $apiKey;
		$this->ip = $ip;
		$this->curlFactory = new CurlFactory();
	}

	public function getGeolocationData(): array
	{
		$url = "https://api.ipstack.com/{$this->ip}?access_key={$this->apiKey}";
		$options = [
			CURLOPT_TIMEOUT => 10,
		];

		$response = $this->curlFactory->makeRequest($url, 'GET', [], $options);

		if (!$this->isGeolocationDataValid($response)) {
			throw new Exception('Invalid geolocation data returned from API');
		}

		return $response;
	}

	public function isGeolocationDataValid(array $geolocationData): bool
	{
		return isset($geolocationData['latitude']) && isset($geolocationData['longitude']);
	}
}
