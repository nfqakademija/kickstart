<?php

namespace App\Services;

class NfqTeams implements TeamsInterface
{
    private $data = [];

    /**
     * NfqKaunasTeams constructor.
     *
     * @param string[][] $data ['teamName' => ['mentors' => ..., 'students' => ''], ...]
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function getTeamByMember(string $name): ?string
    {
        foreach ($this->data as $teamName => $teamData) {
            foreach ($teamData['students'] as $student) {
                if ($student === $name) {
                    return $teamName;
                }
            }
        }

        return null;
    }

    public function getTeamByMentor(string $name): ?string
    {
        foreach ($this->data as $teamName => $teamData) {
            foreach ($teamData['mentors'] as $mentor) {
                if ($mentor === $name) {
                    return $teamName;
                }
            }
        }

        return null;
    }
}
