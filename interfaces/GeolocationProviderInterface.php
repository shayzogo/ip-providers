<?php

interface GeolocationProviderInterface
{
	public function getGeolocationData(): GeoLocation;
}