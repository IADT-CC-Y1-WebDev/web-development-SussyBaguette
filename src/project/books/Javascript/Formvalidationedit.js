let editForm = document.querySelector('form');
let errorSummaryTop = document.getElementById('error_summary_top');

let titleInput = document.getElementById('title');
let authorInput = document.getElementById('author');
let publisherInput = document.getElementById('publisher_id');
let yearInput = document.getElementById('year');
let isbnInput = document.getElementById('isbn');
let descriptionInput = document.getElementById('description');
let formatInputs = document.getElementsByName('format_ids[]');
let imageInput = document.getElementById('cover');

// Error span elements
let titleError = document.getElementById('title_error');
let authorError = document.getElementById('author_error');
let publisherError = document.getElementById('publisher_error');
let yearError = document.getElementById('year_error');
let isbnError = document.getElementById('isbn_error');
let descriptionError = document.getElementById('description_error');
let formatError = document.getElementById('format_error');
let imageError = document.getElementById('cover_error');

let errors = {};

// Intercept submit button click
editForm.addEventListener('submit', onSubmitForm);

editForm.addEventListener('keydown', (event) => {
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
    errorSummaryTop.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function showFieldErrors() {
    titleError.innerHTML       = errors.title       || '';
    authorError.innerHTML      = errors.author      || '';
    publisherError.innerHTML   = errors.publisher   || '';
    yearError.innerHTML        = errors.year        || '';
    isbnError.innerHTML        = errors.isbn        || '';
    descriptionError.innerHTML = errors.description || '';
    formatError.innerHTML      = errors.format      || '';
    imageError.innerHTML       = errors.image       || '';
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

function isExactLength(value, length) {
    return String(value).trim().length === length;
}

function isInRange(value, min, max) {
    const num = Number(value);
    return !isNaN(num) && num >= min && num <= max;
}

function onSubmitForm(evt) {
    evt.preventDefault();
    errors = {};

    const currentYear = new Date().getFullYear();

    // Title
    if (!isRequired(titleInput.value)) {
        addError('title', 'Title is required.');
    } else if (!isMinLength(titleInput.value, 4)) {
        addError('title', 'Title must be at least 4 characters.');
    } else if (!isMaxLength(titleInput.value, 255)) {
        addError('title', 'Title must be at most 255 characters.');
    }

    // Author
    if (!isRequired(authorInput.value)) {
        addError('author', 'Author is required.');
    } else if (!isMinLength(authorInput.value, 5)) {
        addError('author', 'Author must be at least 5 characters.');
    } else if (!isMaxLength(authorInput.value, 255)) {
        addError('author', 'Author must be at most 255 characters.');
    }

    // Publisher
    if (!isRequired(publisherInput.value)) {
        addError('publisher', 'Publisher is required.');
    }

    // Year
    if (!isRequired(yearInput.value)) {
        addError('year', 'Year is required.');
    } else if (!isInRange(yearInput.value, 1900, currentYear)) {
        addError('year', `Year must be between 1900 and ${currentYear}.`);
    }

    // ISBN
    if (!isRequired(isbnInput.value)) {
        addError('isbn', 'ISBN is required.');
    } else if (!isExactLength(isbnInput.value, 13)) {
        addError('isbn', 'ISBN must be exactly 13 characters.');
    }

    // Description
    if (!isRequired(descriptionInput.value)) {
        addError('description', 'Description is required.');
    } else if (!isMinLength(descriptionInput.value, 10)) {
        addError('description', 'Description must be at least 10 characters.');
    }

    // Formats — at least one checkbox must be checked
    let formatSelected = false;
    for (let i = 0; i < formatInputs.length; i++) {
        if (formatInputs[i].checked) {
            formatSelected = true;
            break;
        }
    }
    if (!formatSelected) {
        addError('format', 'Please select at least one format.');
    }


    if (imageInput.files && imageInput.files.length > 0) {
        const file = imageInput.files[0];
        const allowed = ['image/jpeg', 'image/jpg', 'image/png'];
        const maxSize = 5 * 1024 * 1024; // 5 MB

        if (!allowed.includes(file.type)) {
            addError('image', 'Image must be a JPG or PNG file.');
        } else if (file.size > maxSize) {
            addError('image', 'Image must not exceed 5 MB.');
        }
    }

    showFieldErrors();
    showErrorSummaryTop();

    if (Object.keys(errors).length === 0) {
        editForm.submit();
    }
}


document.querySelector('form').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        this.submit();
    }
});
 