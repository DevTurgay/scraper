<?php

require 'config.php';
require 'vendor/autoload.php';


if (isset($argv[1]) && !empty($argv[1])) {
	$scraper = new \Scraper\ScraperController;
	print_r(
		$scraper
			->searchKeyWord(HOME, $argv[1])
			->getOutput()
	);
}
