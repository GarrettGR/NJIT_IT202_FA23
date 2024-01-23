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
  if (data) {
    if (data.login_error) {
      let error = data.login_error;

      if (error) {
        if (error[0] == "email") {
          $("#email").addClass("is-invalid");
          $("#email-feedback").text(error[1]).show();
        } else {
          $("#email").removeClass("is-invalid");
          $("#email-feedback").hide();
        }
        if (error[0] == "password") {
          $("#password").addClass("is-invalid");
          $("#password-feedback").text(error[1]).show();
        } else {
          $("#password").removeClass("is-invalid");
          $("#password-feedback").hide();
        }
      }
    }
  }
};

// open the modal if there is a login error
const open_modal = (data) => {
  if (data) {
    console.log(data);
    if (data.login_error) {
      console.log("open modal");
      $("#ModalForm").modal("show");
    }
  }
};

// get the user data from the server
const getUser = () => {
  return fetch("src/php/get_data.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Something went wrong");
      }
      return response.json();
    })
    .catch((error) => {
      console.error(error);
      throw error;
    });
};

// when the document is ready, run this
$(document).ready(function () {
  // automatically open the login modal if there is a login error
  // getUser().then(open_modal).catch((error) => console.log(error));
  // replaced with below to reduce expensive http requests

  // get the user data and pass promise to displayWelcome
  getUser()
    .then(displayWelcome)
    .then(open_modal)
    .then(login_error)
    .catch((error) => {
      console.log(error);
    });

  // display error in modal when its opened (if there is one)
  // $("#ModalForm").on("shown.bs.modal", function () {
  //   getUser()
  //     .then(login_error)
  //     .catch((error) => {
  //       console.log(error);
  //     });
  // });
});
