<?php

namespace App\Services\Tests;

use App\Services\NfqTeams;
use PHPUnit\Framework\TestCase;

class NfqTeamsTest extends TestCase
{
    /** @var NfqTeams */
    private $twoTeams = null;

    public function setUp(): void
    {
        $this->twoTeams = new NfqTeams(
            [
                'academyui' => [
                    'mentors' => ['Jonas Jonaitis'],
                    'students' => ['Petras Petraitis', 'Gedas Gražauskas'],
                ],
                'supperreal' => [
                    'mentors' => ['Vardenis Pavardenis', 'Ada Kalbenė'],
                    'students' => ['Vytautas Vėjūnas'],
                ],
            ]
        );
    }

    public function testEmpty()
    {
        $teams = new NfqTeams([]);
        $this->assertNull($teams->getTeamByMember('notExisting'));
        $this->assertNull($teams->getTeamByMentor('notExisting'));
    }

    public function providerValidMentors(): array
    {
        return [
            'one of one' => ['academyui', 'Jonas Jonaitis'],
            'last one' => ['supperreal', 'Ada Kalbenė'],
        ];
    }

    /**
     * @dataProvider providerValidMentors
     * @param string $expectedTeam
     * @param string $actualName
     */
    public function testValidMentor($expectedTeam, $actualName)
    {
        $teams = $this->twoTeams;
        $this->assertEquals($expectedTeam, $teams->getTeamByMentor($actualName));
    }

    public function providerValidMembers(): array
    {
        return [
            'last one' => ['academyui', 'Gedas Gražauskas'],
            'one of one' => ['supperreal', 'Vytautas Vėjūnas'],
        ];
    }

    /**
     * @dataProvider providerValidMembers
     * @param string $expectedTeam
     * @param string $actualName
     */
    public function testValidMember($expectedTeam, $actualName)
    {
        $teams = $this->twoTeams;
        $this->assertEquals($expectedTeam, $teams->getTeamByMember($actualName));
    }

    public function testInvalidMember()
    {
        $teams = $this->twoTeams;
        $this->assertNull($teams->getTeamByMember('Neegzistuojantis'));
    }

    public function testInvalidMentor()
    {
        $teams = $this->twoTeams;
        $this->assertNull($teams->getTeamByMentor('Neegzistuojantis'));
    }
}
