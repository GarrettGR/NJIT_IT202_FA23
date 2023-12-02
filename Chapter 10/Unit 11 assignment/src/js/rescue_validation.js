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

    

    if (!isValid) {
      event.preventDefault();
    }
  });
});
