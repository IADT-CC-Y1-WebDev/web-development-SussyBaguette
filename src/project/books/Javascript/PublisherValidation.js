let submitBtn = document.getElementById('submit_btn');
let publisherForm = document.getElementById('publisher_form');
let errorSummaryTop = document.getElementById('error_summary_top');
let nameInput = document.getElementById('name');
let nameError = document.getElementById('name_error');

let errors = {};

submitBtn.addEventListener('click', onSubmitForm);

publisherForm.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
        event.preventDefault();
        onSubmitForm(event);
    }
});

function addError(fieldName, message) {
    errors[fieldName] = message;
}

function showErrorSummaryTop() {
    const messages = Object.values(errors);

    if (messages.length === 0) {
        errorSummaryTop.style.display = 'none';
        errorSummaryTop.innerHTML = '';
        return;
    }

    errorSummaryTop.innerHTML =
        '<strong>Please fix the following:</strong><ul>' +
        messages.map(m => `<li>${m}</li>`).join('') +
        '</ul>';

    errorSummaryTop.style.display = 'block';
}

function showFieldErrors() {
    nameError.innerHTML = errors.name || '';
}

function isRequired(value) {
    return String(value).trim() !== '';
}

function isMinLength(value, min) {
    return String(value).trim().length >= min;
}

function isMaxLength(value, max) {
    return String(value).trim().length <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();
    errors = {};

    if (!isRequired(nameInput.value)) {
        addError('name', 'Name is required.');
    } else if (!isMinLength(nameInput.value, 2)) {
        addError('name', 'Name must be at least 2 characters.');
    } else if (!isMaxLength(nameInput.value, 255)) {
        addError('name', 'Name must be at most 255 characters.');
    }

    showFieldErrors();
    showErrorSummaryTop();

    if (Object.keys(errors).length === 0) {
        publisherForm.submit();
    }
}
