<?php

namespace App\Entity;

class Position
{
	/**
	 * @var string
	 */
	private string $name;

	/**
	 * @var int
	 */
	private int $totalTime;

	/**
	 * @param string $name
	 */
	public function __construct(string $name)
	{
		$this->name = $name;
		$this->totalTime = 0;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return int
	 */
	public function getTotalTime(): int
	{
		return $this->totalTime;
	}

	/**
	 * @param $minutes
	 *
	 * @return void
	 */
	public function increaseTotalTime($minutes): void
	{
		$this->totalTime += $minutes;
	}
}
