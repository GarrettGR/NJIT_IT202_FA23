const documentObjects = () => {
  const rate = document.querySelector("#rate");
  const links = document.querySelectorAll("a");
  const errors = document.querySelectorAll(".error");

  console.log(rate);
  console.log(links);
  console.log(errors);

  const paragraphs = document.querySelectorAll(".words p, #movies p");
  console.log(paragraphs);

  document.write(
    `<h3> there are ${paragraphs.length} paragraphs in those two divs </h3>`
  );
};

//? documentObjects();

// -------------------------------------------------------------------------

const querySelectorObjects = () => {
  document.querySelector("#rate").value = 14;
  let rate = parseFloat(document.querySelector("#rate").value);
  console.log(rate.toFixed(2));
  document.querySelector("#rate").value = 2;
  rate = parseFloat(document.querySelector("#rate").value);
  console.log(rate);
};

//? querySelectorObjects();

// -------------------------------------------------------------------------

const javascriptObjects = () => {
  const today = new Date();

  console.log(today.toDateString());
  console.log(today.getFullYear());
  console.log(today.getDate());
  console.log(today.getMonth());

  const name = "grace hopper";
  const nameUpper = name.toUpperCase();
  const nameLength = name.length;
  const spaceIndex = name.indexOf(" ");
  const firstName = name.substring(0, spaceIndex);

  let printStatement = `Hello ${nameUpper}, are you ${firstName}? It looks like your username is ${nameLength} charecrters long`;
  console.log(printStatement);
};

//? javascriptObjects();

// -------------------------------------------------------------------------

function arrowFunctions () {
    const add = function(a, b){
        return a + b;
    }
    console.log(add(1, 2));

    const adder = (a, b) => {
        sum = a + b;
        return sum;
    }
    console.log(adder(1, 2));

}

//? arrowFunctions()

// -------------------------------------------------------------------------

function events () {
    document.addEventListener('DOMContentLoaded', (event) => {
        let home = document.querySelector('#home');
        let errors = document.querySelectorAll('.error');

        home.addEventListener('click', function(){
            alert("you wanted to go home, too bad it does nothing");
        });
        errors.forEach((error) => {
            error.addEventListener('dblclick', function(){
                alert('you REALLY wanted this to end, too bad you\'re stuck');
            });
        });

        let name = document.querySelector('#name');
        let rate = document.querySelector('#rate');

        name.addEventListener('focus', function () {
            this.style.color = 'white';
            this.style.backgroundColor = 'black';
        });
        name.addEventListener('blur', function () {
            this.style.color = 'black';
            this.style.backgroundColor = 'white';
        });

        rate.addEventListener('change', function () {
            this.style.color = 'red';
        });

        let text = document.querySelector('#issue');

        text.addEventListener('mouseover', function(){
            this.style.color = 'white';
            this.style.backgroundColor = 'black';
        });
        text.addEventListener('mouseout', function(){
            this.style.color = 'black';
            this.style.backgroundColor = 'white';
        });

    });
}

// events();

// -------------------------------------------------------------------------

function forms () {
    const addError = (element) => {
        element.classList.add('error');
    } 
    const addInvalid = (input) => {
        input.classList.add('invalid');
    }
    const formDone = (evt) => {
        let isValid = true;
        let errorMsg = "";
        let classInput = document.querySelector('#class');
        let classNumInput = document.querySelector('#classNum');
        let classErr = document.querySelector('#classError');
        let classNumErr = document.querySelector('#classNumError');

        if (!classInput.value){
            errorMsg = "you need to enter a class";

            classErr.innerHTML = errorMsg;
            addError(classErr);
            addInvalid(classInput);

            isValid = false;
        } else {
            classErr.innerHTML = "*";
            classErr.classList.remove('error');
            classInput.classList.remove('invalid');
        }

        if(!classNumInput.value){
            errorMsg = "you need to enter a class Number";

            classNumErr.innerHTML = errorMsg;
            addError(classNumErr);
            addInvalid(classNumInput);

            isValid = false;
        } else if (isNaN(classNumInput.value)){
            errorMsg = "you need to enter a number";

            classNumErr.innerHTML = errorMsg;
            addError(classNumErr);
            addInvalid(classNumInput);

            isValid = false;
        } else {
            classNumErr.innerHTML="*"
            classNumErr.classList.remove('error');
            classNumInput.classList.remove('invalid');
        }

        if (!isValid){
            evt.preventDefault() 
        }
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        let form = document.querySelector('#myForm');

        form.addEventListener('submit', function(evt){
            formDone(evt);
        })
    });
}

//? forms();

// -------------------------------------------------------------------------

function domStructure () {
    const tree = document.querySelector('#tree');
    console.log(tree.innerHTML);
    console.log(tree.firstChild);
    console.log(tree.firstChild.nextSibling.nextSibling.innerHTML);
    console.log(tree.firstChild.firstChild.nodeValue);

    const myForm = document.querySelector('#myForm');
    const classInput = document.querySelector('#classInput');   

    console.log(myForm.firstChild);
    console.log(classInput.firstChild.nextSibling.nextSibling);

    // console.log(myForm.firstChild.nextSibling.firstChild.nextSibling.nextSibling.nextSibling.nextElementSibling); // it wanted to grab the whitespace when using 'nextSibling' -- stick to nextElementSibling

    myForm.firstChild.nextSibling.firstChild.nextSibling.nextSibling.nextSibling.nextElementSibling.setAttribute('disabled', true);

    const imageList = document.querySelector('#imageList');
    const imageItems = imageList.querySelectorAll('li img');
    
    imageItems.forEach((image) => {
        console.log(image.getAttribute('src'));
    });

    let errorText = document.querySelector('a.error');
    console.log(errorText);
    if(errorText.hasAttribute('class', 'error')){
        console.log('yup theres an error in a link: ', errorText.innerHTML);
    }

    let paragraphs = document.querySelectorAll('p');
    console.log('the first paragraph is: "' + paragraphs[0].innerHTML +'"');

}

domStructure()