<?php

class CurlFactory
{
	public function makeRequest(string $url, string $method = 'GET', array $data = [], array $headers = []): array
	{
		$ch = curl_init();

		if ($method == 'POST') {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		} elseif ($method == 'GET' && !empty($data)) {
			$url .= '?' . http_build_query($data);
		}

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if (!empty($headers)) {
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}

		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response, true);
	}
}
