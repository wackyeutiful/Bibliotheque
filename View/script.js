document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        let isValid = true;
        let errorMessages = [];

        const title = document.getElementById('titre').value.trim();
        if (title === '') {
            isValid = false;
            errorMessages.push('Title is required.');
            displayError('titre', 'Title is required.');
        } else if (title.length > 255) {
            isValid = false;
            errorMessages.push('Title must be less than 255 characters.');
            displayError('titre', 'Title must be less than 255 characters.');
        }

        const author = document.getElementById('auteur').value.trim();
        if (author === '') {
            isValid = false;
            errorMessages.push('Author is required.');
            displayError('auteur', 'Author is required.');
        } else if (!/^[a-zA-Z\s]+$/.test(author)) {
            isValid = false;
            errorMessages.push('Author name should only contain letters and spaces.');
            displayError('auteur', 'Author name should only contain letters and spaces.');
        }

        const publicationDate = document.getElementById('date_publication').value;
        if (publicationDate === '') {
            isValid = false;
            errorMessages.push('Publication date is required.');
            displayError('date_publication', 'Publication date is required.');
        } else if (new Date(publicationDate) > new Date()) {
            isValid = false;
            errorMessages.push('Publication date cannot be in the future.');
            displayError('date_publication', 'Publication date cannot be in the future.');
        }

        const category = document.getElementById('categorie').value.trim();
        if (category === '') {
            isValid = false;
            errorMessages.push('Category is required.');
            displayError('categorie', 'Category is required.');
        } else if (!/^[a-zA-Z\s]+$/.test(category)) {
            isValid = false;
            errorMessages.push('Category should only contain letters and spaces.');
            displayError('categorie', 'Category should only contain letters and spaces.');
        }

        const description = document.getElementById('description').value.trim();
        if (description === '') {
            isValid = false;
            errorMessages.push('Description is required.');
            displayError('description', 'Description is required.');
        }

        if ( isValid === false ) {
            event.preventDefault();
            displayErrorMessages(errorMessages);
        }
    });

    function displayError(inputId, message) {
        const inputElement = document.getElementById(inputId);
        let errorElement = inputElement.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('span');
            errorElement.classList.add('error-message');
            inputElement.after(errorElement);
        }
        errorElement.textContent = message;
        errorElement.style.color = 'red';
    }

    function displayErrorMessages(messages) {
        let summaryElement = document.getElementById('error-summary');
        if (!summaryElement) {
            summaryElement = document.createElement('div');
            summaryElement.id = 'error-summary';
            summaryElement.style.color = 'red';
            form.prepend(summaryElement);
        }

        summaryElement.innerHTML = '<strong>Please correct the following errors:</strong><ul>' +
            messages.map(message => `<li>${message}</li>`).join('') +
            '</ul>';
    }
});


//EMPRUNT
emprunt.addEventListener('DOMContentLoaded', function () {
    const form = emprunt.querySelector('form');

    form.addEventListener('submit', function (event) {
        let isValid = true;
        let errorMessages = [];

        const id_emprunt = emprunt.getElementById('id_emprunt').value.trim(); //check by what ??
        if (id_emprunt === '') {
            isValid = false;
            errorMessages.push('id emprunt is required.');
            displayError('id_emprunt', 'id emprunt is required.');
        } else if (id_emprunt.length > 255) {
            isValid = false;
            errorMessages.push('id emprunt must be less than 255 characters.');
            displayError('id_emprunt', 'id emprunt must be less than 255 characters.');
        }

        const emprunteur = emprunt.getElementById('emprunteur').value.trim();
        if (emprunteur === '') {
            isValid = false;
            errorMessages.push('Emprunteur is required.');
            displayError('emprunteur', 'Emprunteur is required.');
        } else if (!/^[a-zA-Z\s]+$/.test(emprunteur)) {
            isValid = false;
            errorMessages.push('Emprunteur should only contain letters and spaces.');
            displayError('emprunteur', 'Emprunteur name should only contain letters and spaces.');
        }

        const EmpruntDate = emprunt.getElementById('date_emprunt').value;
        if (EmpruntDate === '') {
            isValid = false;
            errorMessages.push('Emprunt date is required.');
            displayError('date_emprunt', 'Emprunt date is required.');
        } else if (new Date(EmpruntDate) > new Date()) {
            isValid = false;
            errorMessages.push('Emprunt date cannot be in the future.');
            displayError('date_emprunt', 'Emprunt date cannot be in the future.');
        }


        const PreuveDate = emprunt.getElementById('date_retour_preuve').value;
        if (PreuveDate === '') {
            isValid = false;
            errorMessages.push('Retour preuve date is required.');
            displayError('date_retour_preuve', 'Retour preuve date is required.');
        } else if (new Date(PreuveDate) > new Date()) {
            isValid = false;
            errorMessages.push('Retour preuve date cannot be in the future.');
            displayError('date_retour_preuve', 'Retour preuve_date cannot be in the future.');
        }

        const statut = emprunt.getElementById('statut').value.trim();
        if (statut === '') {
            isValid = false;
            errorMessages.push('Statut is required.');
            displayError('statut', 'statut is required.');
        } else if (!/^[a-zA-Z\s]+$/.test(statut)) {
            isValid = false;
            errorMessages.push('statut should only contain letters and spaces.');
            displayError('statut', 'statut should only contain letters and spaces.');
        }

        const id_document = emprunt.getElementById('id_document').value.trim();
        if (id_document === '') {
            isValid = false;
            errorMessages.push('id document is required.');
            displayError('id_document', 'id document is required.');
        }

        if ( isValid === false ) {
            event.preventDefault();
            displayErrorMessages(errorMessages);
        }
    });

    function displayError(inputId, message) {
        const inputElement = document.getElementById(inputId);
        let errorElement = inputElement.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('span');
            errorElement.classList.add('error-message');
            inputElement.after(errorElement);
        }
        errorElement.textContent = message;
        errorElement.style.color = 'red';
    }

    function displayErrorMessages(messages) {
        let summaryElement = document.getElementById('error-summary');
        if (!summaryElement) {
            summaryElement = document.createElement('div');
            summaryElement.id = 'error-summary';
            summaryElement.style.color = 'red';
            form.prepend(summaryElement);
        }

        summaryElement.innerHTML = '<strong>Please correct the following errors:</strong><ul>' +
            messages.map(message => `<li>${message}</li>`).join('') +
            '</ul>';
    }
});
