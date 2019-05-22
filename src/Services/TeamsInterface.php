<?php

namespace App\Services;

interface TeamsInterface
{
    public function getTeamByMember(string $name): ?string;

    public function getTeamByMentor(string $name): ?string;
}
