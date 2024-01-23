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
  return data;
};

// show errors if login fails (in the modal)
const login_error = (data) => {
  if (data && data.login_error.length > 0) {
    let error = data.login_error;
    let email = data.login_data['email'];

    $("#ModalForm").modal("show");

    $("#ModalForm").on("shown.bs.modal", function () {
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

      // set the email value to the email address that was entered
      $("#email").val(email);

      // clear the error data
      data.login_error = [];
    });
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
  // get the user data and pass promise to displayWelcome and login_error
  getUser()
    .then(displayWelcome)
    .then(login_error)
    .catch((error) => {
      console.log(error);
    });
});
