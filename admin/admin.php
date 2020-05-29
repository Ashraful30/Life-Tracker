
<?php 


	session_start();

	if(!$_SESSION['login_user']){

		header("location:../index.php");
	}

	if(isset($_POST["logout"])){

		unset($_SESSION['login_user']);
		session_destroy();
		header("location:../index.php");
	}

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
	<link rel="stylesheet" href="../css/admin.css">
	<link rel="stylesheet" href="../css/fontawesome/css/all.css">
	<link rel="icon" type="image/gif/png" href="../img/symbol.png">
	<title>Admin</title>

	<style>
		#mactive{
			color: white;
		}
	</style>


</head>

<body>

	<nav class="navbar navbar-dark navbar-expand-sm fixed-top">
		<div class="container">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
				<span class="navbar-toggler-icon"></span>
			</button>
			<a class="navbar-brand " href="../home.php"><img src="../img/symbol.png" height="32" width="32" alt="Logo" style="margin-right: -10px;"></a>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item"><a id="hactive" class="nav-link" href="../home.php"><i class="fa fa-home"></i> Home</a></li>
					<li class="nav-item" ><a class="nav-link" id="mactive" href="admin.php"><i class="fas fa-user"></i> Admin</a></li>
					<li class="nav-item"><a id="iactive" class="nav-link" href="../income.php"><i class="fas fa-hand-holding-usd"></i> Income</a></li>
					<li class="nav-item" id="eactive"><a class="nav-link" href="../expense.php"><i class="fas fa-donate"></i> Expense</a></li>
					<li class="nav-item" id="lactive"><a class="nav-link" href="../life_event.php"><i class="fas fa-calendar-check"></i> Life Event</a></li>
				</ul>
				<ul class="navbar-nav demo">
					<li class="nav-item demo">
						<a href="" class="btn login" data-toggle="modal" data-target="#modalLoginForm"><i class="fas fa-sign-out-alt"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>


	<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" >
				<div class="modal-header" style="border: none;">
					<div class="container">
						<div class="row">
							<h5 class="modal-title">Log out <i class="fas fa-lg fa-sign-out-alt"></i></h5>
							<button type="button" class="close pb-4" data-dismiss="modal" >
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
				<div class="modal-body mx-3">
					<p><i class="fa fa-question-circle"></i> Are you sure you want to log-off?</p>

					<div class="modal-footer pt-4" style="border-top: none">
				        <form action="" method="post">
				        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        	<button type="submit" name="logout" class="btn btn-danger">Logout</button>
				        </form>
			      </div>
				</div>
				
			</div>
		</div>
	</div>


	<div class="container" style="margin-left: 0px;padding-left: 0px;">		
		<div class="row">

			<div class="col-sm-3" style="min-height: 650px;margin-left: 0px auto;background: lightgrey">				
				
				<div class="row">
					<a class="list-unstyled pt-1" href="add_category.php" style="text-decoration:none;width: 100%;"><button type="button" class="btn login btn-block">Add Category</button></a>		
				</div>
				<div class="row">
					<a class="list-unstyled" href="manage_category.php" style="text-decoration:none;width: 100%;"><button type="button" class="btn login btn-block">Manage Category</button></a>		
				</div>

			</div>

			<div class="col-sm-9 mt-4">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non accusamus praesentium tenetur vero aspernatur veniam, fugiat, reiciendis aperiam sunt corporis quod dolorum magnam blanditiis rerum quas hic, magni assumenda expedita similique atque deleniti rem, impedit neque unde sit. Porro inventore fuga necessitatibus, labore incidunt mollitia sint voluptatem odio temporibus reiciendis.</p>
			</div>

	    </div>
	</div>



	<footer class="footer">
		<div class="container">				
			<div class="row justify-content-center">
				<div class="col-auto">
					<p>&copy; Copyright 2020 Life Tracker</p>
				</div>
			</div>
		</div>
	</footer>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>


</body>
</html>

