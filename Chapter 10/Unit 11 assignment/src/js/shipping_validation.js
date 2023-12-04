//! THIS IS NOT CURRENTLY BEING USED -- IT IS JUST A PROOF OF CONCEPT

// the actual error handling is all handled server side, the client side just displays the errors

// TODO: could refactor this to use a loop by renaming the elements to match the error names (see below):
/*
  const displayError = (data) => {
    if (data && data.label_error_message.length > 0) {
      data.label_error_message.forEach((error) => {
        if (error.field) {
          $('#' + error.field).addClass('is-invalid');
          $('#' + error.field + '_error').text(error.message).show();
        }
      });
    }
  };
*/
// TODO: could also use the same technique to display the values in the shipping_data array (rather than php echoing the values into the html)
    // ? is that actually more readable / better practice

const displayError = (data) => {
  if (data && data.label_error_message.length > 0) {
    let error = data.label_error_message;
    // TODO: could make error message contain multiple errors -- where the type of error is the key and the error message is the value -- then loop through the error object and display the errors; this would allow for multiple errors to be displayed at once

    if (error[0] == "first") {
      $("#first-name").addClass("is-invalid");
      $("#first_name_error").text(error[1]).show();
    } else {
      $("#first-name").removeClass("is-invalid");
      $("#first_name_error").hide();
    }

    if (error[0] == "last") {
      $("#last-name").addClass("is-invalid");
      $("#last_name_error").text(error[1]).show();
    } else {
      $("#last-name").removeClass("is-invalid");
      $("#last_name_error").hide();
    }

    if (error[0] == "address") {
      $("#address-one").addClass("is-invalid");
      $("#address_one_error").text(error[1]).show();
    } else {
      $("#address-one").removeClass("is-invalid");
      $("#address_one_error").hide();
    }

    if (error[0] == "city") {
      $("#city").addClass("is-invalid");
      $("#city_error").text(error[1]).show();
    } else {
      $("#city").removeClass("is-invalid");
      $("#city_error").hide();
    }

    if (error[0] == "state") {
      $("#state").addClass("is-invalid");
      $("#state_error").text(error[1]).show();
    } else {
      $("#state").removeClass("is-invalid");
      $("#state_error").hide();
    }

    // TODO: could use the shipping data to say things like " '9988888' is not a valid zip code "
    if (error[0] == "zip") {
      $("#zip-code").addClass("is-invalid");
      $("#zip_code_error").text(error[1]).show();
    } else {
      $("#zip-code").removeClass("is-invalid");
      $("#zip_code_error").hide();
    }

    if (error[0] == "date") {
      $("#ship-date").addClass("is-invalid");
      $("#ship_date_error").text(error[1]).show();
    } else {
      $("#ship-date").removeClass("is-invalid");
      $("#ship_date_error").hide();
    }

    if (error[0] == "dimensions") {
      $("#package-dimensions").addClass("is-invalid");
      $("#package_dimensions_error").text(error[1]).show();
    } else {
      $("#package-dimensions").removeClass("is-invalid");
      $("#package_dimensions_error").hide();
    }

    if (error[0] == "weight") {
      $("#package-weight").addClass("is-invalid");
      $("#package_weight_error").text(error[1]).show();
    } else {
      $("#package-weight").removeClass("is-invalid");
      $("#package_weight_error").hide();
    }

    if (error[0] == "number") {
      $("#order-number").addClass("is-invalid");
      $("#order_number_error").text(error[1]).show();
    } else {
      $("#order-number").removeClass("is-invalid");
      $("#order_number_error").hide();
    }
  }
};

// get the user data from the server
const getShipping = () => {
  return fetch("src/php/shipping_data.php")
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

$(document).ready(function () {
  // get the shipping data and pass promise to displayWelcome and login_error
  getShipping()
    .then(displayError)
    .catch((error) => console.log(error));
});
