<?php

use Geolocation\Geolocation;
use Geolocation\GeolocationProvider;
use Geolocation\Infrastructure\Http\InvalidProviderResponse;

class IPStack implements GeolocationProvider
{
	public function getGeolocation(string $ip): GeoLocation
	{
		$res = $this->get($ip);
		$this->assert..($res);

		return $res;
	}

	private function get(string $ip)
	{
		//
	}

	private function assert($response)
	{
		if (!in_array()) throw new InvalidProviderResponse($response);
	}
}
}