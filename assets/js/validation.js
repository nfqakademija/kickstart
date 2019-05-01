
const axios = require('axios');

let name = document.getElementById('name');
let team = document.getElementById('team');

let validationNameResult = document.getElementById('name-validation');
let validationTeamResult = document.getElementById('team-validation');

const validation = function (validationResult, element) {
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: element.value})
        .then(function (response) {
            if (response.data.valid) {
                validationResult.innerHTML = ":)";
            } else {
                validationResult.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResult.innerText = 'Error: ' + error;
        });
};

name.onkeyup = () => validation(validationNameResult, name);
name.onchange = () => validation(validationNameResult, name);

team.onkeyup = () => validation(validationTeamResult, team);
team.onchange = () => validation(validationTeamResult, team);