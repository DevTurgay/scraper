<?php

namespace Entities;

class Trademark
{
	private string $number;
	private string $logoUrl;
	private string $name;
	private string $classes;
	private string $status1;
	private string $status2;
	private string $detailsPageUrl;

	public function getNumber()
	{
		return $this->number;
	}

	public function setNumber(string $number)
	{
		$this->number = $number;
	}


	public function getLogoUrl()
	{
		return $this->logoUrl;
	}

	public function setLogoUrl(string $logoUrl)
	{
		$this->logoUrl = $logoUrl;
	}


	public function getName()
	{
		return $this->name;
	}

	public function setName(string $name)
	{
		$this->name = $name;
	}


	public function getClasses()
	{
		return $this->classes;
	}

	public function setClasses(string $classes)
	{
		$this->classes = $classes;
	}


	public function getStatus1()
	{
		return $this->status1;
	}

	public function setStatus1(string $status1)
	{
		$this->status1 = $status1;
	}


	public function getStatus2()
	{
		return $this->status2;
	}

	public function setStatus2(string $status2)
	{
		$this->status2 = $status2;
	}


	public function getDetailsPageUrl()
	{
		return $this->detailsPageUrl;
	}

	public function setDetailsPageUrl(string $detailsPageUrl)
	{
		$this->detailsPageUrl = $detailsPageUrl;
	}

	/** Mapper */
	public function mapper(array $data)
	{
		$this->number = $data['number'] ?? '';
		$this->logoUrl = $data['logo_url'] ?? '';
		$this->name = $data['name'] ?? '';
		$this->classes = $data['classes'] ?? '';
		$this->status1 = $data['status1'] ?? '';
		$this->status2 = $data['status2'] ?? '';
		$this->detailsPageUrl = $data['details_page_url'] ?? '';

		return $this;
	}

	/** Resolver */
	public function resolve(): array
	{
		return [
			'number' => $this->number,
			'logo_url' => $this->logoUrl,
			'name' => $this->name,
			'classes' => $this->classes,
			'status1' => $this->status1,
			'status2' => $this->status2,
			'details_page_url' => $this->detailsPageUrl
		];
	}
}
