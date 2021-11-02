const formUpdate = document.forms["update-patients-form"];
const feedbackFromNameUpdate = document.querySelector("#feedback-from-name");
const feedbackFromSocialNameUpdate = document.querySelector("#feedback-from-social-name");
const feedbackFromAvatarUpdate = document.querySelector("#feedback-from-avatar");
const feedbackFromAgeUpdate = document.querySelector("#feedback-from-age");
const feedbackFromCpfUpdate = document.querySelector("#feedback-from-cpf");

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

    if(someInputIsEmpty(inputsFromPatients.socialName) || inputNameIsInsufficient(inputsFromPatients.socialName)) {
        feedbackFromSocialNameUpdate.style.display = "block";
        feedbackFromSocialNameUpdate.innerHTML = "Digite o nome social completo do paciente."
        feedbackFromSocialNameUpdate.setAttribute("class", "invalid-feedback");
        hasEmptyInput = true;
    } else {
        feedbackFromSocialNameUpdate.style.display = "block";
        feedbackFromSocialNameUpdate.innerHTML = "Tudo certo."
        feedbackFromSocialNameUpdate.setAttribute("class", "valid-feedback");
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

function addMaskToCpfAtUpdate(){
    var cpf = formUpdate.cpf;
    if(cpf.value.length === 3 || cpf.value.length === 7){
        cpf.value += ".";
    }else if(cpf.value.length === 11){
        cpf.value += "-";
    }
}
