const axios = require('axios');
let projectName = document.getElementById('projectName');
let validationResult = document.getElementById('validation-result');
const validateName = function () {
    // validationResult.innerText = 'Project name: ' + projectName.value;
    // validationResult.innerText = 'Validation with: ' + validationResult.dataset.path;
    validationResult.innerText = '...';
    axios.post(validationResult.dataset.path, {input: name.value})
        .then(function(response) {
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
projectName.onkeyup = validateName;
projectName.onchange = validateName;