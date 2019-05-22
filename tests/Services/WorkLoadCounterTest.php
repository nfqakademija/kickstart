<?php

namespace App\Services\Tests;

use App\Services\TeamsInterface;
use App\Services\WorkLoadCounter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class WorkLoadCounterTest extends TestCase
{
    public function testOneMentorHelpsMultipleTeams()
    {
        /** @var TeamsInterface|MockObject $teams */
        $teams = $this->createMock(TeamsInterface::class);
        $teams->expects($this->exactly(2))
            ->method('getTeamByMentor')
            ->willReturn('a');

        $workLoadCounter = new WorkLoadCounter($teams, ['Jonas', 'Petras']);
        $this->assertEquals(2, $workLoadCounter->studentsCount('a'));
    }
}
