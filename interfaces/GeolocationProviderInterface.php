<?php

interface GeolocationProviderInterface
{
	/**
	 * Retrieves geolocation data for the specified IP address from the IpStack API.
	 *
	 * @param string $ip The IP address to retrieve geolocation data for.
	 *
	 * @return array An array containing geolocation data, or an empty array if geolocation data is not available.
	 */
	public function getGeolocationData(string $ip): array;

	/**
	 * Validates the specified geolocation data.
	 *
	 * @param array $geolocationData An array containing geolocation data.
	 *
	 * @return bool True if the geolocation data is valid, false otherwise.
	 */
	public function isGeolocationDataValid(array $geolocationData): bool;
}