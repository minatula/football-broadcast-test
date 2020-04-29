<?php

namespace App\Entity;

use App\Traits\GoalsTrait;

class Player
{
	use GoalsTrait;

    private const PLAY_PLAY_STATUS = 'play';
    private const BENCH_PLAY_STATUS = 'bench';

    private int $number;
    private string $name;
    private string $playStatus;
    private int $inMinute;
    private int $outMinute;
    private int $yellowCards;
    private int $redCards;
	private string $position;

    public function __construct(int $number, string $name, string $position)
    {
        $this->number = $number;
        $this->name = $name;
        $this->playStatus = self::BENCH_PLAY_STATUS;
        $this->inMinute = 0;
        $this->outMinute = 0;
        $this->yellowCards = 0;
        $this->redCards = 0;
		$this->position = $position;
    }

	public function addYellowCard(): void
	{
		if ($this->yellowCards < 2) {
			$this->yellowCards += 1;
		}
	}

	public function getYellowCards(): int
	{
		return $this->yellowCards;
	}

	public function addRedCard(): void
	{
		if ($this->redCards < 1) {
			$this->redCards += 1;
		}
	}

	public function getRedCards(): int
	{
		return $this->redCards;
	}

    public function getNumber(): int
    {
        return $this->number;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getInMinute(): int
    {
        return $this->inMinute;
    }

    public function getOutMinute(): int
    {
        return $this->outMinute;
    }

    public function isPlay(): bool
    {
        return $this->playStatus === self::PLAY_PLAY_STATUS;
    }

    public function getPlayTime(): int
    {
        if(!$this->outMinute) {
            return 0;
        }

        return $this->outMinute - $this->inMinute;
    }

	public function getPosition(): string
	{
		return $this->position;
	}

    public function goToPlay(int $minute): void
    {
        $this->inMinute = $minute;
        $this->playStatus = self::PLAY_PLAY_STATUS;
    }

    public function goToBench(int $minute): void
    {
        $this->outMinute = $minute;
        $this->playStatus = self::BENCH_PLAY_STATUS;
    }
}