const clearDisplay = () => {
    const display = document.querySelector('#display');
    while (display.firstChild) {
        display.removeChild(display.firstChild);
    }
    // display.innerHTML = '';
}

const displayError = (err) => {
    const display = document.querySelector('#display');
    const span = document.createElement('span');
    span.setAttribute('class', 'error');
    const text = document.createTextNode(err);
    span.appendChild(text);
    display.appendChild(span);
}

