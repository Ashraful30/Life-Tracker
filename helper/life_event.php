<?php 

	session_start();
	include 'db_connect.php';

	if(!$_SESSION['login_user']){

		header("location:../index.php");
	}

	if(isset($_POST["logout"])){

		unset($_SESSION['login_user']);
		session_destroy();
		header("location:../index.php");
	}

	$sql="SELECT * FROM category WHERE parent_id IN(SELECT id FROM category WHERE category_name='Life Event' AND parent_id IS null) ORDER BY category_name";
	$res=mysqli_query($conn,$sql);
	
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
	<link rel="stylesheet" href="../css/nav.css">
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

<body onload="helper_life_event();">

	
	<?php include 'nav.php'; ?>


	<div class="container-fluid ">	
		<div class="row-content">

			<div class="row mt-4">

				<div class="col-12 offset-sm-1 col-sm-10">
						
					<form action="" method="post">
						
	                 	<div class="form-group row">
	                        <label for="description" class="col-4 col-sm-2 offset-sm-1 col-from-label text-center" ><h5> Life Event </h5></label>
	                        <div class="col-8 col-sm-4">
								<select class="form-control" name="category" id="cat">
									<option value="all" selected>All Life Event</option>
									<?php
										if ($res) {
											while ($row=mysqli_fetch_assoc($res)) {
												echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
											}
										}
									?>
									
	                            </select>
	                        </div>

							<label for="description" class="col-4 col-sm-1 col-from-label text-center" ><p style="font-size: 18px;"> Show</p></label>

	                        <div class="col-8 col-sm-2">

								<select class="form-control" id="lper_page">
									
									<option value="8" selected>8</option>
									<option value="15">15</option>
									<option value="25">25</option>
									<option value="50">50</option>
	                            </select>
	                        </div> 
	                    </div>
					</form>

					<div id="message">
															
							
					</div>

					<div class="row table-responsive justify-content-center" >
						
						<div class="card-body col-12 offset-sm-1 col-sm-10" id="ltable">
							
						</div>
		
					</div>
		    	</div>

		    </div>

		</div>	
	</div>


	<?php include 'footer.php'; ?>

	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/display.js"></script>
	
</body>
</html>

