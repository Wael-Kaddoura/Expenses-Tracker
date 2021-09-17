<?php
    include "php/connection.php";

    session_start();

    if (!isset($_SESSION["logedin"])) {
        $_SESSION["logedin"] = false ;
    }

    if (!isset($_SESSION["email_used"])) {
    $_SESSION["email_used"] = false ;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Register Now</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/bootstrap/css/bootstrap.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/font-awesome-4.7.0/css/font-awesome.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css"
    />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css" />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/css-hamburgers/hamburgers.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/animsition/css/animsition.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/select2/select2.min.css"
    />
    <!--===============================================================================================-->
    <link
      rel="stylesheet"
      type="text/css"
      href="vendor/daterangepicker/daterangepicker.css"
    />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    <!--===============================================================================================-->
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
          <a class="navbar-brand" href="index.html">Expenses Tracker</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
              <a class="nav-link active" aria-current="page" href="index.html">Home</a>
              <?php if ($_SESSION["logedin"]) {
                  echo '<a class="nav-link" href="php/logout.php">Logout</a>';
              }else {
                  echo '<a class="nav-link" href="login.php">Login</a>';
              } ?>
          </div>
              
          </div>
      </div>
  </nav>

    <div class="limiter">
      <div class="container-login100">
        <div class="wrap-login100 p-t-90 p-b-30">
          <form class="login100-form validate-form" method="POST" id="signup-form" action="php/signup.php">
            <span class="login100-form-title p-b-40"> Register Now </span>
            
            <?php if($_SESSION["email_used"]){?>
            
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                This email is already used!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php } $_SESSION["email_used"] = false; ?>

            <div
              class="wrap-input100 v m-b-16"
            >
              <input
                class="input100"
                type="text"
                name="first_name"
                id="first-name"
                placeholder="First Name"
              />
              <span class="focus-input100"></span>
            </div>

            <div
              class="wrap-input100 v m-b-16"
            >
              <input
                class="input100"
                type="text"
                name="last_name"
                id="last-name"
                placeholder="Last Name"
              />
              <span class="focus-input100"></span>
            </div>

            <div
              class="wrap-input100 validate-input m-b-16"
              data-validate="Please enter email: ex@abc.xyz"
            >
              <input
                class="input100"
                type="text"
                name="email"
                id="email"
                placeholder="Email"
              />
              <span class="focus-input100"></span>
            </div>

            <div
              class="wrap-input100 validate-input m-b-20"
              data-validate="Please enter password"
            >
              <span class="btn-show-pass">
                <i class="fa fa fa-eye"></i>
              </span>
              <input
                class="input100"
                type="password"
                name="password"
                id="password"
                placeholder="Password"
              />
              <span class="focus-input100"></span>
            </div>

            <div
              class="wrap-input100 validate-input m-b-20"
              data-validate="Please enter password"
            >
              <span class="btn-show-pass">
                <i class="fa fa fa-eye"></i>
              </span>
              <input
                class="input100"
                type="password"
                name="confirmPassword"
                id="confirm-password"
                placeholder="Confirm Password"
              />
              <span class="focus-input100"></span>
            </div>


            <div class="container-login100-form-btn">
              <button type = "button" class="login100-form-btn" id = "submit-button">Create Account</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>

    <script src="js/signup.js"></script>
  </body>
</html>
