$(document).ready(() => {
  $("#email_address").focus();
  $("#email_form").submit(event => {
    const email = $("#email_address").val();
    let isValid = true;

    // validate the email address
    if (email == "") {
      $("#email_address").next().text("This field is required.");
      isValid = false;
    } else {
      $("#email_address").next().text("*");
    }

    // submit the form if all entries are valid
    if (isValid) {
      $("#email_form").submit();
    } else {
      event.preventDefault();
    }
  });

  $("#reset_form").click(() => {
    $("#email_address").val("");
    $("#email_address").next().text("*");
    $("#email_address").focus();
  });

});
