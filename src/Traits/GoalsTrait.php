<?php

namespace App\Traits;

trait GoalsTrait
{
	/**
	 * @var int
	 */
	private int $goals = 0;

	/**
	 * @return void
	 */
	public function addGoal(): void
	{
		$this->goals += 1;
	}

	/**
	 * @return int
	 */
	public function getGoals(): int
	{
		return $this->goals;
	}
}
