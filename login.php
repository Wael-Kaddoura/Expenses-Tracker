<?php
    include "php/connection.php";

    session_start();

    if (!isset($_SESSION["logedin"])) {
        $_SESSION["logedin"] = FALSE ;
    }

    if (!isset($_SESSION["new_account"])) {
        $_SESSION["new_account"] = FALSE;
    }
    
    if (!isset($_SESSION["login_error"])) {
        $_SESSION["login_error"] = FALSE;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
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
    <link rel="stylesheet" href="bootstrap-5.1.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
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
          <form class="login100-form validate-form" method="POST" id="login-form" action="php/login.php">
          
          <?php if ($_SESSION["new_account"]) {?>

            <div class="alert alert-success alert-dismissible fade show" role="alert">
            Your Account is successfull created!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?php $_SESSION["new_account"] = false;} else if ($_SESSION["login_error"]) {?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Wrong email or/and password!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

          <?php $_SESSION["login_error"] = false;}?>


            <span class="login100-form-title p-b-40"> Login </span>

            <div
              class="wrap-input100 validate-input m-b-16"
              data-validate="Please enter email: ex@abc.xyz"
            >
              <input required
                class="input100"
                type="text"
                name="email"
                id = "email"
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
              <input required
                class="input100"
                type="password"
                name="password"
                placeholder="Password"
              />
              <span class="focus-input100"></span>
            </div>

            <div class="container-login100-form-btn">
              <button type = "button" class="login100-form-btn" id = "submit-button">Login</button>
            </div>

            <div class="flex-col-c p-t-224">
              <span class="txt2 p-b-10"> Don’t have an account? </span>

              <a href="signup.php" class="txt3 bo1 hov1"> Sign up now </a>
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
    <!--===============================================================================================-->
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

    <script src="js/login.js"></script>
  </body>
</html>
