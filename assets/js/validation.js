const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');

let validationNameResult = document.getElementById('validation-name-result');
let validationTeamResult = document.getElementById('validation-team-result');

const validateName = function () {
    validationNameResult.innerText = '...';
    axios.post(validationNameResult.dataset.path, {input: name.value})
        .then(function (response) {
            if (response.data.valid) {
                validationNameResult.innerHTML = ":)";
            } else {
                validationNameResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationNameResult.innerText = 'Error: ' + error;
        });
};

const validateTeam = function () {
    validationTeamResult.innerText = '...';
    axios.post(validationTeamResult.dataset.path, {input: team.value})
        .then(function (response) {
            if (response.data.valid) {
                validationTeamResult.innerHTML = ":)";
            } else {
                validationTeamResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationTeamResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = validateName;
name.onchange = validateName;

name.onkeyup = validateTeam;
name.onchange = validateTeam;