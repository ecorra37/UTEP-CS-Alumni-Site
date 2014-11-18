

function validateForm() {
    var Username = document.forms["Login_Form"]["Username"].value;
    var Password = document.forms["Login_Form"]["Password"].value;
    $.get('test.php', function(data) {
        alert(data)
    });
}
