<?php

namespace App\Services;

class WorkLoadCounter
{
    /** @var TeamsInterface */
    private $teamsProvider = null;

    private $availableMentors = [];

    /**
     * @param TeamsInterface $teamsProvider
     * @param array $availableMentors
     */
    public function __construct(TeamsInterface $teamsProvider, array $availableMentors)
    {
        $this->teamsProvider = $teamsProvider;
        $this->availableMentors = $availableMentors;
    }


    public function studentsCount(string $team): int
    {
        $sum = 0;
        foreach ($this->availableMentors as $mentor) {
            if ($this->teamsProvider->getTeamByMentor($mentor) == $team) {
                $sum++;
            }
        }
        return $sum;
    }
}
