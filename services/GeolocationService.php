<?php

final class Geolocation implements \JsonSerializable
{
	private string $ip;
	private string $iso2country;

	public function __construct(string $ip, string $iso2country)
	{
		//
	}

	public function jsonSerialize()
	{
		return [
			'ip' => $this->ip,
			'iso2' => $this->iso2country
		];
	}
}
class GeolocationService {

	private array $providers;
	private \PSR4\LoggerInterface $logger;

	public function __construct(LoggerInterface $logger, array $providers) {
		$this->providers = $providers;
	}

	public function getGeolocationData(): GeoLocation {
		$validGeolocationData = array_reduce($this->providers,
			function ($carry, GeolocationProviderInterface $provider) {
			try {
				return $carry || $provider->getGeolocationData();
			} catch (Exception $e) {
				$this->logger->error($e->getMessage());
			}
		}, null);

		if (is_null($validGeolocationData)) throw new GeolocationException('ip');
		return json_encode($validGeolocationData);
	}

}
