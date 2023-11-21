const contactChange = () => {
    const selected = document.querySelectorAll('input[name="contact_me"]:checked').value;
    if (selected == 'email') {
        createEmailText();
    } else if (selected == 'phone') {
        createPhoneText();
    } else {
        removeAllText();
    }

    function createEmailText() {
        const contactText = document.querySelector('#contact_text');

        const newLabel = document.createElement('label');
        const text = document.createTextNode('Email Address:');
        newLabel.appendChild(text);
        contactText.appendChild(newLabel);

        const newInput = document.createElement('input');
        newInput.setAttribute('type', 'text');
        newInput.setAttribute('name', 'email');
        newInput.setAttribute('id', 'email');
        contactText.appendChild(newInput);
    }

    function createPhoneText() {
        const contactText = document.querySelector('#contact_text');

        const newLabel = document.createElement('label');
        const text = document.createTextNode('Phone Number:');
        newLabel.appendChild(text);
        contactText.appendChild(newLabel);

        const newInput = document.createElement('input');
        newInput.setAttribute('type', 'tel');
        newInput.setAttribute('name', 'phone');
        newInput.setAttribute('id', 'phone');
        contactText.appendChild(newInput);
    }

    function removeAllText() {
        const contactText = document.querySelector('#contact_text');
        while (contactText.firstChild) {
            contactText.removeChild(contactText.firstChild);
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    const inputContact = document.querySelectorAll('input[name="contact_me"]');
    for(let contact of inputContact) {
        contact.addEventListener('change', contactChange);
    }

    //! TODO: Add event listener for submit button
    //! TODO: field validation
});