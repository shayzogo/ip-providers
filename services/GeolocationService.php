<?php

class GeolocationService {

	private $providers;

	public function __construct(array $providers) {
		$this->providers = $providers;
	}

	public function getGeolocationData(): array {
		$validGeolocationData = array_reduce($this->providers, function ($carry, GeolocationProviderInterface $provider) {
			if ($carry) {
				return $carry;
			}
			try {
				return $provider->getGeolocationData();
			} catch (Exception $e) {
				error_log("Error retrieving geolocation data from provider " . get_class($provider) . ": " . $e->getMessage());
				// continue to the next provider
			}
		}, null);

		if (!$validGeolocationData) {
			throw new Exception('Unable to get geolocation data from any provider');
		}

		return $validGeolocationData;
	}

}
