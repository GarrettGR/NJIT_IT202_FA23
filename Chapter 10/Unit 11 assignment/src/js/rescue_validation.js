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

  // check the value of the radio button, if it is "numeric" then show the placeholder "006", if it is "entire" then show the placeholder "BRD-006"
  $(document).on("change", "input[name='override-radio']", function () {
    if ($(this).val() == "numeric") {
      $("#animal-code").attr("placeholder", "Ex: '006'");
    } else if ($(this).val() == "prefix") {
      $("#animal-code").attr("placeholder", "Ex: 'BRD'");
    } else {
      $("#animal-code").attr("placeholder", "Ex: 'BRD-006'");
    }
  });

  $("#rescue_form").on("submit", (event) => {
    let isValid = true;
    // Ensure an Animal Type is selected
    const animalType = $("#animal_type").val();
    if (animalType == 0) {
      isValid = false;
      $("#animal_type").addClass("is-invalid");
      $("#animal-type-feedback").text("Please select an animal type").show();
    } else {
      $("#animal_type").removeClass("is-invalid");
      $("#animal-type-feedback").hide();
    }

    // Validate Animal Code only if "automatic" is unchecked
    if (!$("#automatic").is(":checked")) {
      const animalCode = $("#animal-code").val();
      let overrideType = $("input[name='override-radio']:checked").val();

      if (overrideType == "numeric") {
        if (animalCode.length < 3 || animalCode.length > 3) {
          isValid = false;
          $("#animal-code").addClass("is-invalid");
          $("#animal-code-feedback")
            .text("Animal code must be 3 characters")
            .show();
        } else {
          $("#animal-code").removeClass("is-invalid");
          $("#animal-code-feedback").hide();
        }
      } else if (overrideType == "prefix") {
        if (animalCode.length < 3 || animalCode.length > 3) {
          isValid = false;
          $("#animal-code").addClass("is-invalid");
          $("#animal-code-feedback")
            .text("Animal code must be 3 characters")
            .show();
        } else {
          $("#animal-code").removeClass("is-invalid");
          $("#animal-code-feedback").hide();
        }
      } else if (overrideType == "entire") {
        if (animalCode.length < 7 || animalCode.length > 7) {
          isValid = false;
          $("#animal-code").addClass("is-invalid");
          $("#animal-code-feedback")
            .text("Animal code must be 7 characters")
            .show();
        } else {
          $("#animal-code").removeClass("is-invalid");
          $("#animal-code-feedback").hide();
        }
      } else {
        if (animalCode.length < 4 || animalCode.length > 10) {
          isValid = false;
          $("#animal-code").addClass("is-invalid");
          $("#animal-code-feedback")
            .text("Animal code must be between 4 and 10 characters")
            .show();
        } else {
          $("#animal-code").removeClass("is-invalid");
          $("#animal-code-feedback").hide();
        }
      }
    }

    // Validate Animal Name
    const animalName = $("#animal-name").val();
    if (animalName.length < 10 || animalName.length > 100) {
      isValid = false;
      $("#animal-name").addClass("is-invalid");
      $("#animal-name-feedback")
        .text("Animal name must be between 10 and 100 characters")
        .show();
    } else {
      $("#animal-name").removeClass("is-invalid");
      $("#animal-name-feedback").hide();
    }

    // Validate Animal Description
    const animalDescription = $("#animal-description").val();
    if (animalDescription.length < 10 || animalDescription.length > 255) {
      isValid = false;
      $("#animal-description").addClass("is-invalid");
      $("#animal-description-feedback")
        .text("Animal description must be between 10 and 255 characters")
        .show();
    } else {
      $("#animal-description").removeClass("is-invalid");
      $("#animal-description-feedback").hide();
    }

    // Validate Animal Price
    const animalPrice = $("#animal-price").val();
    if (animalPrice <= 0 || animalPrice > 100000) {
      isValid = false;
      $("#animal-price").addClass("is-invalid");
      $("#animal-price-feedback")
        .text("Animal price must be between $0 and $100,000")
        .show();
    } else {
      $("#animal-price").removeClass("is-invalid");
      $("#animal-price-feedback").hide();
    }

    if (!isValid) {
      event.preventDefault();
    }
  });
});
