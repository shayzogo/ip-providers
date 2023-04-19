<?php

namespace Geolocation;

interface GeolocationProvider
{
	public function getGeolocation(string $ip);
}