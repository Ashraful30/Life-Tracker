
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
	<title>Expense</title>

	<style>
		#eactive{
			color: white;
		}
	</style>


</head>

<body>

	
	<?php include 'helper/header.php'; ?>


	<div class="container">
		
		<div class="row justify-content-center" id="bottom">
			<div class="card" style="min-width: 60%;margin-top: 150px;margin-bottom: 200px;">
				<h3 class="card-header bg-primary text-white">Add Earning</h3>
				<div class="card-body">
					<form >

						<div class="form-group row">
							<label for="guestnom" class="col-md-3 col-from-label">Number of Guests</label>
							<div class="col-md-9">
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
									<label class="form-check-label" for="inlineRadio1">1</label>
								  </div>
								  <div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
									<label class="form-check-label" for="inlineRadio2">2</label>
								  </div>
								  <div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
									<label class="form-check-label" for="inlineRadio3">3</label>
								  </div>
								  <div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="option4">
									<label class="form-check-label" for="inlineRadio4">4</label>
								  </div>
								  <div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio5" value="option5">
									<label class="form-check-label" for="inlineRadio5">5</label>
								  </div>
								  <div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio6" value="option6">
									<label class="form-check-label" for="inlineRadio6">6</label>
								  </div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="date" class="col-12 col-md-3 col-from-label">Date and Time</label>
							<div class="col-6 col-md-3">
								<input type="text" class="form-control" name="date" id="date" placeholder="Date">
							</div>
							<div class="col-6 col-md-3">
								<input type="text" class="form-control" name="time" id="time" placeholder="Time">
							</div>
						</div>

						<div class="form-group row">
							<div class="offset-md-3 col-md">
								<button type="submit" class="btn btn-primary">Reserve</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<?php include 'helper/footer.php'; ?>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>

