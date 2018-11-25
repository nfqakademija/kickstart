const axios = require('axios');

let commandName = document.getElementById('commandName');
let studentName = document.getElementById('studentName');

let validationCommand = document.getElementById('validation-command-name');
let validationName = document.getElementById('validation-student-name');


const validate = function (e) {
    e.innerText = '...';
    axios.post(e.dataset.path, {
            commandName: commandName.value,
            studentName: studentName.value
        }
    )
        .then(function (response) {
            if (response.data.valid) {
                e.innerHTML = ":)";
            } else {
                e.innerHTML = ":(";
            }
        })
        .catch(function (error) {
            e.innerText = 'Error: ' + error;
        });
};
commandName.onkeyup = () => validate(validationCommand);
commandName.onchange = () => validate(validationCommand);
studentName.onkeyup = () => validate(validationName);
studentName.onchange = () => validate(validationName);