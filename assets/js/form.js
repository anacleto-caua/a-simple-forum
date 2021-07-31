var idErrorUsername = document.getElementById("username-field-error");
var idErrorPassword = document.getElementById("password-field-error");
var idErrorSubmit = document.getElementById("submit-field-error");

idErrorPassword.innerText = "i see"; 

$('input#username').on('click', function(){
    var username = $('input#username').val();
    if ($.trim(username) != '') {
        $.post('ajax/form')
    }
})