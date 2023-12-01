const clearDisplay = () => {
  const display = document.querySelector("#display");
  while (display.firstChild) {
    display.removeChild(display.firstChild);
  }
  // display.innerHTML = '';
};

const displayError = (err) => {
  const display = document.querySelector("#display");
  const span = document.createElement("span");
  span.setAttribute("class", "error");
  const text = document.createTextNode(err);
  span.appendChild(text);
  display.appendChild(span);
};

const displayData = (data) => {
  // console.log(data);
  // TODO display data from APOD API

  clearDisplay();
  const display = document.querySelector("#display");

  const h3 = document.createElement("h3");
  const title = document.createTextNode(data.title);
  h3.appendChild(title);
  display.appendChild(h3);

  switch (data.media_type) {
    case "image":
      const img = document.createElement("img");
      img.setAttribute("src", data.url);
      img.setAttribute("width", 640);
      img.setAttribute("alt", "NASA photo");
      display.appendChild(img);
      break;
    case "video":
      const iframe = document.createElement("iframe");
      iframe.setAttribute("src", data.url);
      iframe.setAttribute("width", 640);
      iframe.setAttribute("height", 360);
      iframe.setAttribute("frameborder", 0);
      iframe.setAttribute("allowfullscreen", true);
      display.appendChild(iframe);
      break;
    default:
      const none = document.createElement("img");
      none.setAttribute("width", 640);
      none.setAttribute("alt", "NASA photo");
      display.appendChild(none);
  }

  const div = document.createElement("div");
  const date = document.createTextNode(data.date);
  div.appendChild(date);

  if (data.copyright) {
    const span = document.createElement("span");
    span.setAttribute("class", "right");
    const text = document.createTextNode("Copyright " + data.copyright);
    span.appendChild(text);
    div.appendChild(span);
  }
  display.appendChild(div);

  const p = document.createElement("p");
  const explanation = document.createTextNode(data.explanation);
  p.appendChild(explanation);
  display.append(p);
};

const displayPicture = (data) => {
  if (data.error) {
    displayError(data.error.message);
  } else if (data.code) {
    displayError(data.smg);
  } else {
    displayData(data);
  }
};

// document.addEventListener("DOMContentLoaded", () => {
//   document.querySelector("#view_button").addEventListener("click", () => {
//     console.log("view button clicked");
//     clearDisplay();
//     const date = document.querySelector("#date").value;
//     const url = `https://api.nasa.gov/planetary/apod?api_key=DEMO_KEY&date=${date}`;
//     fetch(url)
//       .then((response) => response.json())
//       .then((data) => displayPicture(data))
//       .catch((err) => displayError(err));
//   });
// });

document.addEventListener("DOMContentLoaded", () => {
  document.querySelector("#view_button").addEventListener("click", () => {
    // console.log("view button clicked");

    const dateBox = document.querySelector("#date");
    let dateStr = dateBox.value;

    if (dateStr) {
      const domain = "https://api.nasa.gov/planetary/apod";
      const demo_api_key = "DEMO_KEY";
      const my_api_key = "INbBKTJv3P6ncJpx93P7sclbrum3aoK7POTzP8gG";

      const request = `?api_key=${my_api_key}&date=${dateStr}`;
      const url = domain + request;

      fetch(url)
        .then((response) => response.json())
        .then((data) => displayPicture(data))
        .catch((err) => displayError(err));
    } else {
      const msg = "Please select a valid date.";
      displayError(msg);
    }
  });
});
