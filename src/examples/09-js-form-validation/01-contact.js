// 09-1: Comment-style form validation (formHandler pattern)

let submitBtn = document.getElementById('submit_btn');
let commentForm = document.getElementById('comment_form');
let errorSummaryTop = document.getElementById('error_summary_top');

let nameInput = document.getElementById('name');
let categoryInput = document.getElementById('category');
let experienceInput = document.getElementsByName('experience');
let languagesInput = document.getElementsByName('languages[]');

let nameError = document.getElementById('name_error');
let categoryError = document.getElementById('category_error');
let experienceError = document.getElementById('experience_error');
let languagesError = document.getElementById('languages_error');

let errors = {};

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showFieldErrors() {
    nameError.innerHTML = errors.name || '';
    // categoryError.innerHTML = errors.category || '';
    // experienceError.innerHTML = errors.experience || '';
    // languagesError.innerHTML = errors.languages || '';
}

function onSubmitForm(e){
    e.preventDefault();

    //validate each field
    if(nameInput.value === ""){
        addError('name', "Name is required!")
    }else if (nameInput) {
        addError('name', 'Name can only contain letters and white space.');
    }
    console.log(errors);

    showFieldErrors();

    // if all data is valid
    if(Object.keys(errors).length === 0){
        commentForm.submit();
    }
}

submitBtn.addEventListener('click', onSubmitForm);