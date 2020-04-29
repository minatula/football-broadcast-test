<?php

namespace App\Traits;

trait GoalsTrait
{
	private int $goals = 0;

	public function addGoal(): void
	{
		$this->goals += 1;
	}

	public function getGoals(): int
	{
		return $this->goals;
	}
}
