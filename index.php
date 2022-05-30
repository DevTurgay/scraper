<form action="" method="POST">
	<input type="text" name="keyword" placeholder="search">
	<button>Submit</button>
</form>

<?php

require 'config.php';
require 'vendor/autoload.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$scraper = new \Scraper\ScraperController;
	echo '<pre>';
	print_r(
		$scraper
			->searchKeyWord(HOME, $_POST['keyword'])
			->getOutput()
	);
}
