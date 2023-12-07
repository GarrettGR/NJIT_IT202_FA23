function scopes() {
  var a = 10;
  if (true) {
    let a = 20;
    console.log(a); // prints 20
  }
  console.log(a); // prints 10
}

//? scopes();

// console.log(a); // throws an error (not defined)

// -------------------------------------------------------------------------

function variables() {
  let a = "this is a test"; // string // true
  let b = 5; // number // false
  let c = -5; // number // false
  let d = 12.5; // number // false
  let e = "12.5"; // string // false
  let f = true; // boolean // false (!)
  let g = parseFloat(f); // number // false

  let vars = [a, b, c, d, e, f, g];

  vars.forEach((variable) => {console.log(typeof variable)});
  vars.forEach((variable) => {console.log(isNaN(variable))})
}

//? variables();

// -------------------------------------------------------------------------

function windowObject() {
    let loc = window.location;
    let href = window.location.href;

    let name = window.prompt("What is your name?", "Danny boy");
    let age = parseInt(prompt("how old are you?"));

    window.alert(name);
    alert(age);

    // the same
    console.log("location: " + loc);
    console.log("href: " + href);
}

//? windowObject();

function documentObject() {
    let body = document.body;
    
    console.log (body);

    let number = prompt("pick a number: ");
    document.write(`<p> You Picked: ${number} </p>`);
}

//? documentObject();