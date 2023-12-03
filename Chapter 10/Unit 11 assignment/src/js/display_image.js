const getBread = (breadId) => {
  // $.ajax({
  //     url: `https://jsonplaceholder.typicode.com/photos/${breadID}`,
  //     method: "GET",
  //     success: bread => resolve(bread),
  //     error: err => reject(err)
  // });

  if (breadId < 1 || breadId > 5000) {
    return Promise.reject(new Error("Photo ID must be between 1 and 5000"));
  } else {
    const domain = "https://jsonplaceholder.typicode.com/";
    const request = `${domain}/photos/${breadId}`;
    return fetch(request).then((response) => response.json());
  }
};

const displayBread = (bread) => {
  // let html = `<img src="${bread.thumbnailUrl}" alt="${bread.title}">`;
  let html = `<img class="img-fluid" id="animal-image" src="${bread.thumbnailUrl}" data-fullsize="${bread.url}" data-thumbnail="${bread.thumbnailUrl}" alt="${bread.title}">`;
  $("#display").html(html);


  // $("#animal-image").hover(
  //   function () {
  //     // mouse over
  //     console.log("mouse over");
  //     $(this).attr("src", $(this).data("fullsize"));
  //   }, function () {
  //     // mouse out
  //     console.log("mouse out");
  //     $(this).attr("src", $(this).data("thumbnail"));
  //   }
  // )

  $(document).on('mouseenter', '#animal-image', function() {
    // mouse over
    console.log("mouse over");
    $(this).attr("src", $(this).data("fullsize"));
  }).on('mouseleave', '#animal-image', function() {
    // mouse out
    console.log("mouse out");
    $(this).attr("src", $(this).data("thumbnail"));
  });

};

const displayError = (err) => {
  // $("#display").empty();
  let html = `<span>${err.message}</span>`;
  $("#display").html(html);
};

$(document).ready(() => {
  let breadID = $("#breadID").val();

  getBread(breadID).then(displayBread).catch(displayError);
});
