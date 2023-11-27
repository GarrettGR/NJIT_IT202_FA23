$(document).ready(function() {
    console.log('document ready')
    $('#login-btn').click(function() {
        console.log('login-btn clicked')
        $('#login-modal').modal();
    });
});