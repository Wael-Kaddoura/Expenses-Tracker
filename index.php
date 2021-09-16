<?php
    include "php/connection.php";

    session_start();

    if (!isset($_SESSION["logedin"])) {
        $_SESSION["logedin"] = FALSE ;
    }elseif ($_SESSION["logedin"]) {
        $user_id = $_SESSION["user_id"];
    
        //getting the users data from the database
        $sql1="Select * from users where id=?";
        $stmt1 = $connection->prepare($sql1);
        $stmt1->bind_param("s",$user_id);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1 = $result1->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses Tracker</title>

    <link rel="stylesheet" type="text/css" href="css/util.css" />
    <link rel="stylesheet" type="text/css" href="css/main.css" />

    <link rel="stylesheet" href="bootstrap-5.1.0-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
<body>

  <div class="container-fluid">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Expenses Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                <?php if ($_SESSION["logedin"]) {
                    echo '<a class="nav-link" href="php/logout.php">Logout</a>';
                }else {
                    echo '<a class="nav-link" href="login.php">Login</a>';
                } ?>
            </div>

            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (!$_SESSION["logedin"]) {?>
        <div class = "text-center">
            <h1>Login to Start Tracking your Expenses</h1>
        </div>
        <?php } else{?>
        <div>

            <!-- <div class="container text-center">
                <h1>Welcome <?php echo $_SESSION["name"] ?></h1>
            </div> -->

            <div id = "expenses_list" class = "text-center">
                <h2>Your Expenses</h2>


                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Add New Expense</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New Expense</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form>
					<div class="mb-3">
						<label for="expense_category" class="col-form-label">Category:</label>
						<div class="input-group mb-3">
							<select name="expense_category" class="form-select" id="expense_category">
								<option selected>Choose...</option>
							</select>
							<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#wael" data-bs-whatever="@mdo">Add a New Category</button>
							<div class="modal fade" id="wael" tabindex="-1" aria-labelledby="wael" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="wael">New Category</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
											<form>
												<div class="mb-3">
													<label for="new_category" class="col-form-label">Category Name:</label>
													<input type="text" class="form-control" id="new_category"> </div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="button" class="btn btn-success" data-bs-dismiss="modal" id="add_category">Add Category</button>
										</div>
									</div>
								</div>
							</div>
							<!-- here -->
						</div>
					</div>
					<div class="mb-3">
						<label for="expense_amount" class="col-form-label">Amount ($):</label>
						<input type="text" class="form-control" id="expense_amount" name="expense_amount"> </div>
					<div class="mb-3">
						<label for="expense_date" class="col-form-label">Date:</label>
						<input type="date" class="form-control" id="expense_date" name="expense_date"> </div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" data-bs-dismiss="modal" id="add_expense">Add Expense</button>
			</div>
		</div>                    </div>
                </div>




                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Category</th>
                        <th scope="col">Ammount</th>
                        <th scope="col">Date</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id = "expenses_table">
                    </tbody>
                </table>

            </div>

        </div>
        <?php } ?>
    </div>



  </div>
    

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="bootstrap-5.1.0-dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoWe/6oMVemdAVTMs2xqW4mwXrXsW0L84Iytr2wi5v2QjrP/xp" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>

    <script src="js/app.js"></script>
</body>
</html>