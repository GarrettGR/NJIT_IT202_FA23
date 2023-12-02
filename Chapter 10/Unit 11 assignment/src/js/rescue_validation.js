$(document).ready(() => {
  // $("#animal_type").focus();

  $("#automatic").change((event) => {
    if (!event.target.checked) {
      $("#manual-override").show();
      $("#animal_code").show();
    } else {
      $("#manual-override").hide();
      $("#animal_code").hide();
    }
  });

  $("#rescue_form").submit((event) => {
    let isValid = true;

    /*
    Bread Code
      - This field should not be blank
      - This field should have a minimum of 4 characters
      - This field should have a maximum of 10 characters
    Bread Name
      - This field should not be blank
      - This field should have a minimum of 10 characters
      - This field should have a maximum of 100 characters
    Bread Description
      - This field should not be blank
      - This field should have a minimum of 10 characters
      - This field should have a maximum of 255 characters.
    Bread Price
      - This field should not be blank
      - This field should not be negative or zero
      - This field should not exceed $100,000
    */

    // validate animal code
    if ($("#automatic").prop("checked") == false) {
      const animalCode = $("#animal-code").val();

      if (animalCode == "") {
        $("#animal-code").next().text("This field is required.");
        isValid = false;
      } else if (animalCode.length < 4) {
        $("#animal-code").next().text("Must be 4 or more characters.");
        isValid = false;
      } else if (animalCode.length > 10) {
        $("#animal-code").next().text("Must be 10 or less characters.");
        isValid = false;
      } else {
        $("#animal-code").next().text("");
      }
    }

    // validate animal name
    const animalName = $("#animal-name").val();

    if (!isValid) {
      event.preventDefault();
    }
  });
});
