// Validate the password confirmation
function validatePassword() {
  var password = document.getElementById("password").value;
  var passwordConfirmation = document.getElementById("password_confirmation").value;

  if (password !== passwordConfirmation) {
    document.getElementById("password_confirmation").setCustomValidity("Passwords must match");
  } else {
    document.getElementById("password_confirmation").setCustomValidity("");
  }
}

// Add event listener to password confirmation field
document.getElementById("password_confirmation").addEventListener("keyup", validatePassword);
