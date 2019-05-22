import {NfqTeams} from "./nfqTeams";

import {teamsData} from "./teamsData";

test('Get team by mentor full name', () => {
    expect(NfqTeams.getTeamByMentor(teamsData, 'Giedrius Gerulis')).toBe('supperreal');
    expect(NfqTeams.getTeamByMember(teamsData, 'Petras Petraitis')).toBe('academyui');
});
