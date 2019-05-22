const NfqTeams = {
    getTeamByMember: (data, name) => {
        let result = null;
        Object.keys(data).forEach((team) => {
            data[team].students.forEach((student) => {
                if (name === student) {
                    result = team;
                }
            })
        });
        return result;
    },

    getTeamByMentor: (data, name) => {
        let result = null;
        Object.keys(data).forEach((team) => {
            data[team].mentors.forEach((mentor) => {
                if (name === mentor) {
                    result = team;
                }
            })
        });
        return result;
    }
};

export {NfqTeams};