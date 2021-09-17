//defining the validation variables
var email_valid;
var confirm_pass;
var first_name_valid;
var last_name_valid;

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

function confirmPassword() {
  confirm_pass = false;

  //checking the basic requirments of the password, and the password confirmation
  if (
    $("#password").val() == $("#confirm-password").val() &&
    $("#password").val().length > 5
  ) {
    confirm_pass = true;
  }
}

function validatefname() {
  first_name_valid = false;

  //checking the basic requirments of the firstname
  if ($("#first-name").val().length > 2) {
    first_name_valid = true;
  }
}

function validatelname() {
  last_name_valid = false;

  //checking the basic requirments of the lastname
  if ($("#last-name").val().length > 2) {
    last_name_valid = true;
  }
}

$("#submit-button").click(function () {
  validateEmail();
  confirmPassword();
  validatefname();
  validatelname();

  if (!confirm_pass) {
    $("#confirm-password").addClass("alert-danger");
    $("#confirm-password").addClass("alert");
  } else {
    $("#confirm-password").removeClass("alert-danger");
  }

  if (!email_valid) {
    $("#email").addClass("alert-danger");
    $("#email").addClass("alert");
  } else {
    $("#email").removeClass("alert-danger");
  }

  if (!first_name_valid) {
    $("#first-name").addClass("alert-danger");
    $("#first-name").addClass("alert");
  } else {
    $("#first-name").removeClass("alert-danger");
  }

  if (!last_name_valid) {
    $("#last-name").addClass("alert-danger");
    $("#last-name").addClass("alert");
  } else {
    $("#last-name").removeClass("alert-danger");
  }

  //checking if all the conditions are met before sending the signup form
  if (email_valid && confirm_pass && first_name_valid && last_name_valid) {
    $("#signup-form").submit();
  }
});
