const form = document.forms["create-patients-form"];
const feedbackFromName = document.querySelector("#feedback-from-name");
const feedbackFromAvatar = document.querySelector("#feedback-from-avatar");
const feedbackFromAge = document.querySelector("#feedback-from-age");
const feedbackFromPhone = document.querySelector("#feedback-from-phone");
const feedbackFromCpf = document.querySelector("#feedback-from-cpf");

function handleWithGeneralChecks() {
    let hasEmptyInput = false;

    let inputsFromPatients = {
        name: form.name.value,
        socialName: form.social_name.value,
        avatar: form.avatar.value,
        age: form.age.value,
        phone: form.phone.value,
        cpf: form.cpf.value
    }

    if(someInputIsEmpty(inputsFromPatients.name) || inputNameIsInsufficient(inputsFromPatients.name)) {
        feedbackFromName.style.display = "block";
        feedbackFromName.innerHTML = "Digite o nome completo do paciente.";
        feedbackFromName.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromName.style.display = "block";
        feedbackFromName.innerHTML = "Tudo certo.";
        feedbackFromName.setAttribute("class", "valid-feedback");
    }

    if(someInputIsEmpty(inputsFromPatients.avatar)) {
        feedbackFromAvatar.style.display = "block";
        feedbackFromAvatar.innerHTML = "Selecione uma foto para o paciente."
        feedbackFromAvatar.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromAvatar.style.display = "block";
        feedbackFromAvatar.innerHTML = "Tudo certo.";
        feedbackFromAvatar.setAttribute("class", "valid-feedback");
    }

    if(someInputIsEmpty(inputsFromPatients.age) || inputAgeIsInsufficient(inputsFromPatients.age)) {
        feedbackFromAge.style.display = "block";
        feedbackFromAge.innerHTML = "Informe a idade do paciente."
        feedbackFromAge.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromAge.style.display = "block";
        feedbackFromAge.innerHTML = "Tudo certo.";
        feedbackFromAge.setAttribute("class", "valid-feedback");
    }


    if(someInputIsEmpty(inputsFromPatients.phone) || inputPhoneIsInsufficient(inputsFromPatients.phone)) {
        feedbackFromPhone.style.display = "block";
        feedbackFromPhone.innerHTML = "Informe o número do paciente."
        feedbackFromPhone.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromPhone.style.display = "block";
        feedbackFromPhone.innerHTML = "Tudo certo.";
        feedbackFromPhone.setAttribute("class", "valid-feedback");
    }

    if(someInputIsEmpty(inputsFromPatients.cpf) || !checkIfCPFIsValid(inputsFromPatients.cpf)) {
        feedbackFromCpf.style.display = "block";
        feedbackFromCpf.innerHTML = "Informe o CPF do paciente corretamente."
        feedbackFromCpf.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromCpf.style.display = "block";
        feedbackFromCpf.innerHTML = "Tudo certo.";
        feedbackFromCpf.setAttribute("class", "valid-feedback");
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
    if(String(age).length > 3) {
        return true;
    }
}

function inputPhoneIsInsufficient(phone) {
    if(String(phone).length !== 11) {
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

function addMaskToCpf() {
    var cpf = form.cpf;
    if(cpf.value.length === 3 || cpf.value.length === 7){
        cpf.value += ".";
    }else if(cpf.value.length === 11){
        cpf.value += "-";
    }
}

function checkIfCPFIsValid(strCPF) {
    strCPF = strCPF.replace(/[^0-9]/g, "");
    var Soma;
    var Resto;
    Soma = 0;
    if (strCPF == "00000000000") return false;

    for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}
