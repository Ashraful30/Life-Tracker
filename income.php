
<?php 

	session_start();


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
	<link rel="icon" type="image/gif/png" href="img/symbol.png">
	<title>Life Tracker</title>

	<style>
		#iactive{
			color: white;
		}
	</style>


</head>

<body>

	
	<?php include 'helper/header.php'; ?>


	<div class="container-fluid" >		
		<div class="row">

			<div class="col-sm-3" style="min-height: 650px;background: lightgrey">

				<div class="row">
					<a class="list-unstyled pt-2" href="helper/add_income.php" style="text-decoration:none;width: 100%;"><button type="button" class="btn login btn-block">Add Income</button></a>		
				</div>
				<div class="row">
					<a class="list-unstyled" href="helper/manage_income.php" style="text-decoration:none;width: 100%;"><button type="button" class="btn login btn-block">Manage Income</button></a>		
				</div>

			</div>

			<div class="col-sm-9 mt-4">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non accusamus praesentium tenetur vero aspernatur veniam, fugiat, reiciendis aperiam sunt corporis quod dolorum magnam blanditiis rerum quas hic, magni assumenda expedita similique atque deleniti rem, impedit neque unde sit. Porro inventore fuga necessitatibus, labore incidunt mollitia sint voluptatem odio temporibus reiciendis.</p>
			</div>

	    </div>
	</div>


	<?php include 'helper/footer.php'; ?>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

