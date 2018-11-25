let projectName = document.getElementById('projectName');
let validationResult = document.getElementById('validation-result');
const validateName = function () {
    validationResult.innerText = 'Project name: ' + projectName.value;
    validationResult.innerText = 'Validation with: ' + validationResult.dataset.path;
};
projectName.onkeyup = validateName;
projectName.onchange = validateName;