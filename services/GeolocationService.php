<?php

class GeolocationService
{
	/**
	 * The list of geolocation providers to use.
	 *
	 * @var array An array of objects that implement the GeolocationProviderInterface.
	 */
	private $providers;

	/**
	 * Constructs a new GeolocationService object.
	 *
	 * @param array $providers An array of objects that implement the GeolocationProviderInterface.
	 */
	public function __construct(array $providers)
	{
		$this->providers = $providers;
	}

	/**
	 * Retrieves geolocation data for the specified IP address from the available providers.
	 *
	 * @param string $ip The IP address to retrieve geolocation data for.
	 *
	 * @return array An array containing geolocation data, or throws an exception if geolocation data is not available.
	 *
	 * @throws Exception If geolocation data cannot be retrieved from any of the available providers.
	 */
	public function getGeolocationData(string $ip): array
	{
		$geolocationDataList = array_map(function ($provider) use ($ip) {
			try {
				$geolocationData = $provider->getGeolocationData($ip);
				if ($provider->isGeolocationDataValid($geolocationData)) { // If failed go to the next one
					return $geolocationData; // If not return
				}
			} catch (Exception $e) {
				// log the error and continue to the next provider
			}
		}, $this->providers);

		$validGeolocationDataList = array_filter($geolocationDataList, function ($geolocationData) {
			return !empty($geolocationData);
		});

		if (count($validGeolocationDataList) == 0) {
			throw new Exception('Unable to get geolocation data from any provider');
		}

		return $validGeolocationDataList[0];
	}
}
