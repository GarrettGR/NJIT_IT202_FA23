<<<<<<< refs/remotes/origin/main
$(document).ready(function() {
    console.log('document ready')
    $('#login-btn').click(function() {
        console.log('login-btn clicked')
        $('#login-modal').modal();
    });
});
=======
// if the person is logged in, show the logout button and hide the login button
// if the person is logged out, show the login button and hide the logout button
// if the person is logged in, show their name and email address in the welcome text
// if the person is logged out, show the default welcome text

const displayWelcome = (data) => {
  if (data) {
    if (data.logged_in) {
      let firstName = data.first_name;
      let lastName = data.last_name;
      let email = data.email;

      $("#welcome-text").html(
        "Welcome " + firstName + " " + lastName + " (" + email + ")"
      );
      $("#login-btn").hide();
      $("#logout-btn").show();

      $("#rescue-link").attr("disabled", false);
      $("#rescue-link").removeClass("disabled");
      $("#rescue-link").attr("aria-disabled", false);
      $("#rescue-link").attr("href", "rescue.php");

      $("#shipping-link").attr("disabled", false);
      $("#shipping-link").removeClass("disabled");
      $("#shipping-link").attr("aria-disabled", false);
      $("#shipping-link").attr("href", "shipping.php");
    } else {
      $("#welcome-text").html("Welcome! Please log in.");
      $("#login").show();
      $("#logout").hide();

      $("#rescue-link").attr("disabled", true);
      $("#rescue-link").addClass("disabled");
      $("#rescue-link").attr("aria-disabled", true);
      $("#rescue-link").attr("href", "#");

      $("#shipping-link").attr("disabled", true);
      $("#shipping-link").addClass("disabled");
      $("#shipping-link").attr("aria-disabled", true);
      $("#shipping-link").attr("href", "#");
    }
  } else {
    $("#welcome-text").html("Welcome! Please log in.");
    $("#login").show();
    $("#logout").hide();
  }
};

// show errors if login fails (in the modal)
const login_error = (data) => {
  if (data.login_error) {
    let error = data.login_error;
    if (error[0]) {
      // show the modal if there is an error
      $("#loginModal").modal("show");

      // TODO: remove any existing error classes

      // based on the error code, add the error class to the appropriate label
      if (error[0] == 1) {
        $("#login-error").html(error[1]);
        $("#email-label").addClass("text-danger");
        $("#password-label").addClass("text-danger");
      } else if (error[0] == 2) {
        $("#login-error").html(error[1]);
        $("#email-label").addClass("text-danger");
      } else if (error[0] == 3) {
        $("#login-error").html(error[1]);
        $("#email-label").addClass("text-danger");
      } else if (error[0] == 4) {
        $("#login-error").html(error[1]);
        $("#password-label").addClass("text-danger");
      }
    } else {
      // TODO: if there is no error, remove the error class from the labels

      // remove any error message text
      $("#login-error").html("");
    }
  }
};

const getUser = () => {
  return fetch("src/php/get_data.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Something went wrong");
      }
      return response.json();
    })
    .catch((error) => {
      console.log(error);
    });
};

// const toggleActiveClass = () => {
//   const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
//   const loc = window.location.href;

//   navLinks.forEach((link) => {
//     if (loc.includes(link.getAttribute("href"))) {
//       link.classList.toggle("active");
//     }
//   });
// };

// const toggleActiveClass = () => {
//   const navLinks = document.querySelectorAll(".navbar-nav .nav-link");
//   const loc = window.location.pathname; // Use pathname instead of href

//   navLinks.forEach((link) => {
//     // Remove "active" class from all links
//     link.classList.remove("active");

//     // Add "active" class to the link that matches the current path
//     if (loc === link.getAttribute("href")) {
//       link.classList.add("active");
//     }
//   });
// };

$(document).ready(function () {
  getUser().then(displayWelcome);
  // getUser().then(login_error);
  //   toggleActiveClass(); // ! DOESNT SEEM TO BE WORKING (with either version of the function...) ???
});
>>>>>>> working on final assignment
