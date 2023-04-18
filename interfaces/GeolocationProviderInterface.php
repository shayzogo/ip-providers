<?php

interface GeolocationProviderInterface
{

	public function getGeolocationData(): array;

	public function isGeolocationDataValid(array $geolocationData): bool;
}