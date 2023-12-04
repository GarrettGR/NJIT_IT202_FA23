
$(document).ready(function() {
  // add event listener for mouseover (remove black and white effect)
  $('#pet-image').on('mouseover', function() {
    $(this).css('filter', 'grayscale(0)');
  });

  // add event listener for mouseout (apply black and white effect)
  $('#pet-image').on('mouseout', function() {
    $(this).css('filter', 'grayscale(1)');
  });
});
