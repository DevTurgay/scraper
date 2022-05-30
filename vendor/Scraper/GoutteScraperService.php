<?php

namespace Scraper;

class GoutteScraperService extends \Scraper\AbstractScraper
{
	private $content;
	private $nextPage = false;

	public function request(string $method, string $url, array $headers = [], array $body = [])
	{
		$this->content = $this->httpClient->request($method, $url, $headers, $body);
		return $this;
	}

	public function findAndPostForm(string $formSelector, array $data)
	{
		$form = $this->content->filter($formSelector)->form();
		$form->setValues($data);
		$this->content = $this->httpClient->submit($form);
		return $this;
	}

	public function handleNextPage(string $paginationSelector, string $attr)
	{
		return $this->filterAttr($this->content, $paginationSelector, $attr);
	}

	public function filterText($element, $filter)
	{
		try {
			return $element->filter($filter)->text();
		} catch (\InvalidArgumentException $e) {
			return false;
		}
	}

	public function filterUri($element, $filter)
	{
		try {
			return $element->filter($filter)->link()->getUri();
		} catch (\InvalidArgumentException $e) {
			return false;
		}
	}

	public function filterAttr($element, $filter, $attr)
	{
		try {
			return $element->filter($filter)->attr($attr);
		} catch (\InvalidArgumentException $e) {
			return false;
		}
	}

	public function getContent()
	{
		return $this->content;
	}
}
