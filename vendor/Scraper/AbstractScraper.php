<?php

namespace Scraper;

abstract class AbstractScraper
{
	protected $httpClient;

	function __construct($httpClient)
	{
		$this->httpClient = $httpClient;
	}

	public abstract function request(string $method, string $url, array $headers, array $body);
}
