<?php

require_once './interfaces/GeolocationProviderInterface.php';

class IpStack implements GeolocationProviderInterface
{
	public function getGeolocationData(string $ip): array
	{
		// TODO: Implement getGeolocationData() method.
		return [];
	}

	public function isGeolocationDataValid(array $geolocationData): bool
	{
		// TODO: Implement isGeolocationDataValid() method.
		return true;
	}
}