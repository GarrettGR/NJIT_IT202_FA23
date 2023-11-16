$(document).ready(() => {
  // focus to first input
  $("#email").focus();

  // handle change event for radio buttons
  $(":radio").change(() => {
    const radioButton = $(":radio:checked").val();

    if (radioButton == "buisness") {
      // $("#company").enable();
      $("#company").attr("disabled", false);
      $("#company").next().text("*");
    } else {
      $("#company").attr("disabled", true);
      $("#company").next().text("");
    }
  });

  $("#member_form").submit((event) => {
    let isValid = true;

    // validate email

    const emailPattern = /^[\w\.\-]+@[\w\.\-]+\.[a-zA-Z]+$/;
    const email = $("#email").val();

    if (email == "") {
      $("#email").next().text("This field is required.");
      isValid = false;
    } else if (!emailPattern.test(email)) {
      $("#email").next().text("Must be a valid email address.");
      isValid = false;
    } else {
      $("#email").next().text("");
    }
  });

  //validate password
  const password = $("#password").val();
    if (password == "") {
        $("#password").next().text("This field is required.");
        isValid = false;
    } else if (password.length < 6) {
        $("#password").next().text("Must be 6 or more characters.");
        isValid = false;
    } else {
        $("#password").next().text("");
    }

    // validate company name
    if ($("#company").prop("disabled") == false) {
        if ($("#company").val() == "") {
            $("#company").next().text("This field is required.");
            isValid = false;
        } else {
            $("#company").next().text("");
        }
    }

  if ((!isValid)) {
    event.preventDefault();
  }

});
