function validateForm() {
    var Username = document.forms["Login_Form"]["Username"].value;
    var Password = document.forms["Login_Form"]["Password"].value;
    $.post('test.php',{user:Username}, function (output) {
            alert(output);
    });
}
