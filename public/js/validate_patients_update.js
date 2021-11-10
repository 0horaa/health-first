const formUpdate = document.forms["update-patients-form"];
const phoneUpdate = formUpdate.phone;
const feedbackFromNameUpdate = document.querySelector("#feedback-from-name-up");
const feedbackFromAvatarUpdate = document.querySelector("#feedback-from-avatar-up");
const feedbackFromAgeUpdate = document.querySelector("#feedback-from-age-up");
const feedbackFromCpfUpdate = document.querySelector("#feedback-from-cpf-up");

function handleWithGeneralChecksAtUpdate() {
    let hasEmptyInput = false;

    let inputsFromPatients = {
        name: formUpdate.name.value,
        socialName: formUpdate.social_name.value,
        avatar: formUpdate.avatar.value,
        age: formUpdate.age.value,
        cpf: formUpdate.cpf.value
    }

    if(someInputIsEmpty(inputsFromPatients.name) || inputNameIsInsufficient(inputsFromPatients.name)) {
        feedbackFromNameUpdate.style.display = "block";
        feedbackFromNameUpdate.innerHTML = "Digite o nome completo do paciente."
        feedbackFromNameUpdate.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromNameUpdate.style.display = "block";
        feedbackFromNameUpdate.innerHTML = "Tudo certo."
        feedbackFromNameUpdate.setAttribute("class", "valid-feedback");
    }

    if(someInputIsEmpty(inputsFromPatients.age) || inputAgeIsInsufficient(inputsFromPatients.age)) {
        feedbackFromAgeUpdate.style.display = "block";
        feedbackFromAgeUpdate.innerHTML = "Informe a idade do paciente."
        feedbackFromAgeUpdate.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromAgeUpdate.style.display = "block";
        feedbackFromAgeUpdate.innerHTML = "Tudo certo."
        feedbackFromAgeUpdate.setAttribute("class", "valid-feedback");
    }

    if(someInputIsEmpty(inputsFromPatients.cpf) || !checkIfCPFIsValid(inputsFromPatients.cpf)) {
        feedbackFromCpfUpdate.style.display = "block";
        feedbackFromCpfUpdate.innerHTML = "Informe o CPF do paciente corretamente."
        feedbackFromCpfUpdate.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromCpfUpdate.style.display = "block";
        feedbackFromCpfUpdate.innerHTML = "Tudo certo."
        feedbackFromCpfUpdate.setAttribute("class", "valid-feedback");
    }

    if(hasEmptyInput) {
        return false;
    } else {
        return true;
    }
}

function someInputIsEmpty(input) {
    if(input.length == 0) {
        return true;
    }
}

function inputNameIsInsufficient(name) {
    if(name.length < 6) {
        return true;
    }
}

function inputAgeIsInsufficient(age) {
    if(age <= 0 || age >= 120) {
        return true;
    }
}

function inputPhoneIsInsufficient(phone) {
    if(String(phone).length !== 15) {
        return true;
    }
}

try{
    document.querySelector("#age").addEventListener("keypress", event => {
        if(!verifyChar(event)){
            event.preventDefault();
        }
    });
    function verifyChar(event){
        var char = String.fromCharCode(event.keyCode);
        var pattern = '[0-9]';
        if(char.match(pattern)){
            return true;
        }
    }
}catch(e){}

try{
    document.querySelector("#phone").addEventListener("keypress", event => {
        if(!verifyChar(event)){
            event.preventDefault();
        }
    });
    function verifyChar(event){
        var char = String.fromCharCode(event.keyCode);
        var pattern = '[0-9]';
        if(char.match(pattern)){
            return true;
        }
    }
}catch(e){}

function addMaskToCpfAtUpdate(){
    var cpf = formUpdate.cpf;
    if(cpf.value.length === 3 || cpf.value.length === 7){
        cpf.value += ".";
    }else if(cpf.value.length === 11){
        cpf.value += "-";
    }
}

function addMaskToPhoneOnPressUpdate() {
    if(phoneUpdate.value.length === 0) {
        phoneUpdate.value += "(";
    } else if(phoneUpdate.value.length === 10) {
        phoneUpdate.value += "-";
    }
}

function addMaskToPhoneOnUpUpdate() {
    if(phoneUpdate.value.length === 3) {
        phoneUpdate.value += ")9 ";
    } else if(phoneUpdate.value.lenght === 10) {
        phoneUpdate.value += "-";
    }
}

function cleanPhoneField() {
    phone.value = "";
}

function cleanCPFField() {
    cpf.value = "";
}
