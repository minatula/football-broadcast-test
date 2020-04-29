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
	private array $cards;

    public function __construct(int $number, string $name)
    {
        $this->number = $number;
        $this->name = $name;
        $this->playStatus = self::BENCH_PLAY_STATUS;
        $this->inMinute = 0;
        $this->outMinute = 0;
        $this->cards = [
        	'yellow' => 0,
        	'red' => 0,
		];
    }

	/**
	 * @param $color
	 *
	 * @return void
	 */
	public function addCard($color): void
	{
		$this->cards[$color] += 1;
	}

	/**
	 * @param $color
	 *
	 * @return int
	 *
	 * @throws \Exception
	 */
	public function getCards($color): int
	{
		if (isset($this->cards[$color])) {
			return $this->cards[$color];
		}

		throw new \Exception(
			sprintf(
				'Card with color "%d" doesn\'t exists.',
				$color
			)
		);
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