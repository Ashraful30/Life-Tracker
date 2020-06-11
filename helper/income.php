
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
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/bootstrap-social.css">
	<link rel="stylesheet" href="../css/index.css">
	<link rel="stylesheet" href="../css/fontawesome/css/all.css">
	<link rel="icon" type="image/gif/png" href="../img/symbol.png">
	<title>Life Tracker</title>

	<style>
		#iactive{
			color: white;
		}
		.pad{
			padding: 10px 10px;
		}
	</style>


</head>

<body>

	
	<?php include 'nav.php'; ?>


	<div class="container-fluid" >		
		<div class="row row-content">
			<div class="row col-12 offset-md-2 col-md-8">
				<div class="col-xl-4 pad align-items-center mx-auto" >
					<div class="mx-auto" style="background: #563D7C;width: 250px;height: 250px;border-radius: 125px;">
						<p class="count text-center" style="padding-top: 40%;font-size: 30px;color: #fff;">2500000</p>
						<p class="text-center" style="padding-top: 12%;font-size: 18px;color: #fff;">This Month</p>
					</div>
				</div>
				<div class="col-xl-4 pad align-items-center mx-auto" >
					<div class="mx-auto" style="background: #563D7C;width: 250px;height: 250px;border-radius: 125px;">
						<p class="count text-center" style="padding-top: 40%;font-size: 30px;color: #fff;">2500000</p>
						<p class="text-center" style="padding-top: 12%;font-size: 18px;color: #fff;">This Year</p>
					</div>
				</div>
				<div class="col-xl-4 pad align-items-center mx-auto" >
					<div class="mx-auto" style="background: #563D7C;width: 250px;height: 250px;border-radius: 125px;">
						<p class="count text-center" style="padding-top: 40%;font-size: 30px;color: #fff;">2500000</p>
						<p class="text-center" style="padding-top: 12%;font-size: 18px;color: #fff;">Total</p>
					</div>
				</div>
			</div>
	    </div>
	</div>


	<?php include 'footer.php'; ?>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<script>
		

		$('.count').each(function () {
		    $(this).prop('Counter',0).animate({
		        Counter: $(this).text()
		    }, {
		        duration: 5000,
		        easing: 'swing',
		        step: function (now) {
		            $(this).text(Math.ceil(now)+' ৳');
		        }
		    });
		});

	</script>
</body>
</html>

