<?php

namespace App\Entity;

use App\Traits\GoalsTrait;

class Team
{
	use GoalsTrait;

    private string $name;
    private string $country;
    private string $logo;
    /**
     * @var Player[]
     */
    private array $players;
    private string $coach;
	/**
	 * @var Position[]
	 */
	private array $positions;

    public function __construct(string $name, string $country, string $logo, array $players, string $coach)
    {
        $this->assertCorrectPlayers($players);

        $this->name = $name;
        $this->country = $country;
        $this->logo = $logo;
        $this->players = $players;
        $this->coach = $coach;
        $this->goals = 0;
		foreach (['В', 'З', 'П', 'Н'] as $positionName) {
			$this->positions[] = new Position($positionName);
		}
    }

	public function countTotalPositionsTime()
	{
		foreach ($this->positions as $position) {
			foreach ($this->players as $player) {
				if ($position->getName() == $player->getPosition()) {
					$position->increaseTotalTime($player->getPlayTime());
				}
			}
		}
	}

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getLogo(): string
    {
        return $this->logo;
    }

    /**
     * @return Player[]
     */
    public function getPlayersOnField(): array
    {
        return array_filter($this->players, function (Player $player) {
            return $player->isPlay();
        });
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getPlayer(int $number): Player
    {
        foreach ($this->players as $player) {
            if ($player->getNumber() === $number) {
                return $player;
            }
        }

        throw new \Exception(
            sprintf(
                'Player with number "%d" not play in team "%s".',
                $number,
                $this->name
            )
        );
    }

    public function getCoach(): string
    {
        return $this->coach;
    }

	public function getPositions()
	{
		return $this->positions;
	}

	public function getPosition(string $name): Position
	{
		foreach ($this->positions as $position) {
			if ($position->getName() === $name) {
				return $position;
			}
		}

		throw new \Exception(
			sprintf(
				'Position with name "%d" not exists in team "%s".',
				$name,
				$this->name
			)
		);
	}

    private function assertCorrectPlayers(array $players)
    {
        foreach ($players as $player) {
            if (!($player instanceof Player)) {
                throw new \Exception(
                    sprintf(
                        'Player should be instance of "%s". "%s" given.',
                        Player::class,
                        get_class($player)
                    )
                );
            }
        }
    }
}