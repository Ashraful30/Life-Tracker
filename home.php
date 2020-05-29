
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
	<link rel="icon" type="image/gif/png" href="img/symbol.png">
	<title>Home</title>

	<style>
		#hactive{
			color: white;
		}
	</style>


</head>

<body>

	
	<?php include 'helper/header.php'; ?>


	<?php include 'helper/footer.php'; ?>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

