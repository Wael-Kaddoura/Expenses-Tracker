//defining the validation variable
var email_valid;

function validateEmail() {
  var email_value = $("#email").val();
  email_valid = false;
  //checking the basic requirments of the email
  if (
    email_value.length > 5 &&
    email_value.lastIndexOf(".") > email_value.lastIndexOf("@") &&
    email_value.lastIndexOf("@") != -1
  ) {
    email_valid = true;
  }
}

$("#submit-button").click(function () {
  validateEmail();

  if (!email_valid) {
    //triggering alerts if email is not valid
    $("#email").addClass("alert-danger");
    $("#email").addClass("alert");
  } else {
    $("#email").removeClass("alert-danger");
  }

  //checking the email validation before sending the login form
  if (email_valid) {
    $("#login-form").submit();
  }
});
