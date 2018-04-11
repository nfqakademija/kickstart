let name = document.getElementById('name');
let validationResult = document.getElementById('validation-result');
const validateName = function () {
    validationResult.innerText = 'Įrašėte: ' + name.value;
};

name.onkeyup = validateName;
name.onchange = validateName;
