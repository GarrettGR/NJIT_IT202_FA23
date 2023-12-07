function forLoops() {
  const person = {
    name: "john",
    age: 30,
  };
  const numbers = [1, 2, 3, 4];

  console.log("\n for loop: ");
  for (let i = 0; i < 5; i++) {
    console.log(i);
  }

  console.log("\n for-in loop: ");
  for (let key in person) {
    console.log(key, ":", person[key]);
  }

  console.log("\n for-of loop: ");
  for (let number of numbers) {
    console.log(number);
  }
}

//? forLoops();

function whileLoops() {
  let i = 0;
  while (i < 5) {
    console.log("interation -", i++);
  }

  let j = 0;
  do {
    console.log("done -", j++);
  } while (j < 5);

  do {
    console.log("garuntees 1 run -> i :", i++);
  } while (i < 5);

  do {
    console.log("garuntees 1 run -> i :", i++);
  } while (i < 5);

  do {
    console.log("garuntees 1 run -> j :", j++);
  } while (j < 5);

  do {
    console.log("garuntees 1 run -> j :", j++);
  } while (j < 5);
}

//? whileLoops();

// -------------------------------------------------------------------------

function relationalOperators() {
  let a = true;
  let b = false;

  let c = 2;
  let d = 5;
  let e = 5;

  let f = "hopper";

  if (a) console.log("a");

  if (!b) console.log("!b");

  if (d == e) console.log("d == e");

  if (c < d) console.log("c < d");

  if (d > c) console.log ("d > c");

  if (isNaN(f)) console.log("f isNaN");

  // TODO: you already know the logical operators...
}

//? relationalOperators();

// -------------------------------------------------------------------------

function arrays () {
  let arr = new Array(1, 2, 3);
  console.log("arr:", arr, "size: ", arr.length);
  arr.push(4);
  console.log("arr:", arr, "size: ", arr.length);

  const arr2 = [1, 2, 3];
  console.log("arr2:", arr2, "size: ", arr2.length);
  arr2[3] = 4;
  console.log("arr2:", arr2, "size: ", arr2.length);

  const numbers = [];
  for(let i = 0; i < 10; i++) numbers[i] = i + 1;

  let sum = 0; 
  for (let i in numbers) sum += numbers[i]; // i holds the current index
  console.log(sum)

  let total = 0;
  for (let val of numbers) total += val; // val holds the current value
  console.log(total);


}

//? arrays();