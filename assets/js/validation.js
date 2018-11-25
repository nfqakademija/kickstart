let projectName = document.getElementById('projectName');
let validationResult = document.getElementById('validation-result');
const validateName = function () {
    validationResult.innerText = 'Project name: ' + projectName.value;
};
projectName.onkeyup = validateName;
projectName.onchange = validateName;