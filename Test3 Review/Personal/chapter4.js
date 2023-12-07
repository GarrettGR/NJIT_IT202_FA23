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

const javascriptObjects = (() => {
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
})();
