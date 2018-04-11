let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result');
const validateName = function () {
    validationResult.innerText = 'Validuosiu su: ' + validationResult.dataset.path;
};

name.onkeyup = validateName;
name.onchange = validateName;
