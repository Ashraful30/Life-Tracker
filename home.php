<?php 

    session_start();


	// error_reporting(0);

	if(!$_SESSION['login_user']){

		header("location:index.php");
	}
	// include('db_connect.php');
	// $log_in_error="";
	// $email="";
	// $password="";

	// if(isset($_POST["submit"])){

	// 	$email=mysqli_real_escape_string($conn,$_POST["email"]);
	// 	$password=mysqli_real_escape_string($conn,$_POST["password"]);
	// 	$sql="Select id from admin where admin_email='$email' and admin_password='$password'";
	// 	$result = mysqli_query($conn, $sql);

	// 	if (mysqli_num_rows($result)) {

	// 		$_SESSION['login_user']=$email;
	// 	    header('location:home.php');
	// 	}
	// 	else
	// 		$log_in_error="Incorrect Email & Password";
	// }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/fontawesome/css/all.css">
	<link rel="stylesheet" href="css/nav.css">
	<link rel="icon" type="image/gif/png" href="img/symbol.png">
	<title>Home</title>
	<style> #hactive{color: #C8C8C8;} </style>

</head>

<body>

	
	<nav class="navbar navbar-dark navbar-expand-sm fixed-top">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand " href="home.php"><img src="img/symbol.png" height="32" width="32" alt="Logo" style="margin-right: -10px;"></a>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item cnav"><a id="hactive" class="nav-link" href="home.php"><i class="fa fa-home"></i> Home</a></li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list"></i> Category</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="helper/add_category.php">Add Category</a>
	                        <a class="dropdown-item" href="helper/manage_category.php">Manage Category</a>
                        </div>
					</li>

					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-hand-holding-usd"></i> Income</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="helper/add_income.php">Add Income</a>
	                        <a class="dropdown-item" href="helper/manage_income.php">Manage Income</a>
	                        <a class="dropdown-item" href="#">View Income</a>
                        </div>
					</li>

					<li class="nav-item dropdown" id="eactive">
						<a class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-donate"></i> Expense</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="helper/add_expense.php">Add Expense</a>
	                        <a class="dropdown-item" href="helper/manage_expense.php">Manage Expense</a>
	                        <a class="dropdown-item" href="#">View Expense</a>
                        </div>
					</li>

					<li class="nav-item dropdown" id="lactive">
						<a class="nav-link dropdown-toggle my-style" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-calendar-check"></i> Life Event</a>

						<div class="dropdown-menu idiv" aria-labelledby="navbarDropdown">
	                        <a class="dropdown-item" href="helper/add_life_event.php">Add Life Event</a>
	                        <a class="dropdown-item" href="helper/manage_life_event.php">Manage Life Event</a>
	                        <a class="dropdown-item" href="#">View Life Event</a>
                        </div>
					</li>					
				
				</ul>
				<ul class="navbar-nav demo">
					<li class="nav-item demo">
						<a href="" class="btn login" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-out-alt"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	
	<div class="container-fluid">
		
		<div class="row row-content">
			
		</div>

	</div>

	<?php include 'helper/footer.php'; ?>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

