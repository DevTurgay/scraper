<?php

namespace Scraper;

use Entities\Trademark;
use Scraper\GoutteScraperService;

class ScraperController
{

	private $scraper;
	private $output = [];

	public function index()
	{
	}

	public function searchKeyWord(string $url, string $keyword)
	{
		// Request Search Page
		$this->scraper = new GoutteScraperService(new \Goutte\Client());

		// Fill the form & submit
		$this->scraper->request('GET', $url)
			->findAndPostForm('#basicSearchForm', [KEYWORD_KEY => [$keyword]]);

		return $this->scrapeIt();
	}

	public function scrapeIt()
	{
		// Collect the data
		$this->collectData()->paginateNextPage();

		return $this;
	}

	private function paginateNextPage(): void
	{
		// Check if there is a further page
		$this->nextPage = $this->scraper->handleNextPage('.pagination-buttons > a.js-nav-next-page', 'href');
		if ($this->nextPage) {
			$this->scraper->request('GET', $this->nextPage);
			$this->scrapeIt(); // recursion
		}
	}

	private function collectData()
	{
		$this->scraper->getContent()->filter('#resultsTable > tbody > tr')->each(function ($element) {
			$statuses = explode(':', $this->scraper->filterText($element, 'td.status'));

			$data = [
				'number' => $this->scraper->filterText($element, 'td.number > a'),
				'logo_url' => $this->scraper->filterAttr($element, 'td.image > img', 'src'),
				'name' => $this->scraper->filterText($element, 'td.trademark.words'),
				'classes' => $this->scraper->filterText($element, 'td.classes'),
				'status1' => $statuses[0] ?? '',
				'status2' => trim($statuses[1] ?? ''),
				'details_page_url' => $this->scraper->filterUri($element, 'td.number > a'),
			];
			$this->output[] = (new Trademark)->mapper($data);
		});
		return $this;
	}

	public function getOutput(): array
	{
		$out = [];
		foreach ($this->output as $trademark) {
			$out[] = $trademark->resolve();
		}
		return $out;
	}
}
