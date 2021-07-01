<?php 

	session_start();

	if(isset($_SESSION['login_user'])){
		
		header("location:home.php");
  	}

  	include('helper/db_connect.php');

  	$log_in_error="";
	$email="";
	$password="";

	if(isset($_POST["submit"])){

		$email=mysqli_real_escape_string($conn,$_POST["email"]);
		$password=mysqli_real_escape_string($conn,$_POST["password"]);
		$sql="Select id from admin where email='$email' and password='$password'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result)) {

			$_SESSION['login_user']=$email;
		    header('location:home.php');
		}
		else{
			$log_in_error="Incorrect Email or Password";
		}
	}

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
	<title>Login</title>
    
</head>

	

<body style="background: #808080">
		
	
	

	<div class="container">
		

		<div class="col-12 offset-md-4 col-md-4" style="background: white;color: black;border-right: none;">
			
			<form style="border: none;" action="" method="post">	

				<div class="row pt-4 pb-4">
					<img src="img/Pro.jpg" alt="avatar" class="rounded-circle img-responsive mx-auto">
				</div>	

				<div class="row pb-3 justify-content-center">
					<h5>Ashraful Islam</h5>
				</div>	

				<div class="row pb-2 justify-content-center">
					
					<?php if ($log_in_error!='') {
						echo '<div class="alert alert-danger text-center" role="alert" style="width: 92%;">'.$log_in_error.'</div>';
						} 
					?>

				</div>	
													
				<div class="form-group row">
					<label for="email" class="col-1 col-md-1 col-from-label align-self-center"><i class="fa fa-envelope fa-lg"></i></label>
					<div class="col-11 col-md-11">
						<input type="email" class="form-control validate" name="email" id="email" placeholder="Your email" required>
					</div>
				</div>		
				
				<div class="form-group row">
					<label for="password" class="col-1 col-md-1 col-from-label align-self-center"><i class="fa fa-lock fa-lg"></i></label>
					<div class="col-11 col-md-11">
						<input type="password" class="form-control" name="password" id="password" placeholder="Your password" required>
					</div>
				</div>

				<div class="form-group row pb-4">
					<div class="col-12">
						<button type="submit" name="submit" class="btn btn-primary btn-block">LOG IN</button>
					</div>
				</div>	
			</form>
		</div>
	</div>



	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function(){
		    $('#modal').modal('show');
		}); 

		// $('#myModal').modal({
		// 	backdrop: 'static',
		// 	keyboard: false
		// });
	</script>
    

</body>
</html>
