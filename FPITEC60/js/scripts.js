function togglePassword() {
    var passwordFields = document.querySelectorAll('#password, #confirm_password');
    passwordFields.forEach(function(field) {
        if (field.type === "password") {
            field.type = "text";
        } else {
            field.type = "password";
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    var toggleCheckbox = document.getElementById('togglePassword');
    
    toggleCheckbox.addEventListener('change', togglePassword);
});
