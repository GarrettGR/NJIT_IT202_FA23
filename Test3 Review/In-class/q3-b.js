$(document).ready(function() {
  let imageList = $('#image-list li img');
  
  imageList.each(function() {
    let src = $(this).attr('src');
    console.log(src);
  });
});

