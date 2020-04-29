<?php

namespace App\Entity;

class Position
{
	private string $name;

	private int $totalTime;

	public function __construct(string $name)
	{
		$this->name = $name;
		$this->totalTime = 0;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getTotalTime(): int
	{
		return $this->totalTime;
	}

	public function increaseTotalTime($minutes): void
	{
		$this->totalTime += $minutes;
	}
}
