const axios = require('axios');

let name = document.getElementById('name');
let validationResultName = document.getElementById('validation-result-name');

let team = document.getElementById('team');
let validationResultTeam = document.getElementById('validation-result-team');

const validateName = function () {
    validationResultName.innerText = "...";

    axios.post(validationResultName.dataset.path, {input: name.value})
        .then(function (response) {

            if (response.data.valid) {
                validationResultName.innerHTML = ":)";
            } else {
                validationResultName.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResultName.innerText = "error: " + error;
        })
};

const validateTeam = function () {
    validationResultTeam.innerText = "...";

    axios.post(validationResultTeam.dataset.path, {input: team.value})
        .then(function (response) {

            if (response.data.valid) {
                validationResultTeam.innerHTML = ":)";
            } else {
                validationResultTeam.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            validationResultTeam.innerText = "error: " + error;
        })
};

name.onkeyup = validateName;
name.onchange = validateName;
team.onkeyup = validateTeam;
team.onchange = validateTeam;
