<?php 

	session_start();

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

<body onload="onload_view();">

	
	<?php include 'nav.php'; ?>


	<div class="container-fluid ">	
		<div class="row-content">
			<div class="row">
				<div class="row col-12 offset-md-2 col-md-8">
					<div class="col-xl-4 pad align-items-center mx-auto" >
						<div class="mx-auto" style="background: #563D7C;width: 200px;height: 200px;border-radius: 100px;">
							<p class="count1 text-center" style="padding-top: 36%;font-size: 30px;color: #fff;" id="month"></p>
							<p class="text-center" style="padding-top: 6%;font-size: 18px;color: #fff;">This Month</p>
						</div>
					</div>
					<div class="col-xl-4 pad align-items-center mx-auto" >
						<div class="mx-auto" style="background: #563D7C;width: 200px;height: 200px;border-radius: 100px;">
							<p class="count2 text-center" style="padding-top: 36%;font-size: 30px;color: #fff;" id="year"></p>
							<p class="text-center" style="padding-top: 6%;font-size: 18px;color: #fff;">This Year</p>
						</div>
					</div>
					<div class="col-xl-4 pad align-items-center mx-auto" >
						<div class="mx-auto" style="background: #563D7C;width: 200px;height: 200px;border-radius: 100px;">
							<p class="count3 text-center" style="padding-top: 36%;font-size: 30px;color: #fff;" id="total"></p>
							<p class="text-center" style="padding-top: 6%;font-size: 18px;color: #fff;">Total</p>
						</div>
					</div>
				</div>
		    </div>

			<div class="row mt-4">

				<div class="col-12 offset-sm-1 col-sm-10">
						
					<form action="" method="post">
						
	                 	<div class="form-group row">
	                        <label for="description" class="col-4 offset-sm-2 col-sm-2 col-from-label text-center" ><h5> Income </h5></label>
	                        <div class="col-4 col-sm-3">
								<select class="form-control" name="month" id="m">

									<?php $date=date('m'); ?>
									
									<option value="0" >All Months</option>
									<option value="01" <?php if($date=='01'){echo "selected='selected'";} ?>>January</option>
									<option value="02" <?php if($date=='02'){echo "selected='selected'";} ?>>February</option>
									<option value="03" <?php if($date=='03'){echo "selected='selected'";} ?>>March</option>
									<option value="04" <?php if($date=='04'){echo "selected='selected'";} ?>>April</option>
									<option value="05" <?php if($date=='05'){echo "selected='selected'";} ?>>May</option>
									<option value="06" <?php if($date=='06'){echo "selected='selected'";} ?>>June</option>
									<option value="07" <?php if($date=='07'){echo "selected='selected'";} ?>>July</option>
									<option value="08" <?php if($date=='08'){echo "selected='selected'";} ?>>August</option>
									<option value="09" <?php if($date=='09'){echo "selected='selected'";} ?>>September</option>
									<option value="10" <?php if($date=='10'){echo "selected='selected'";} ?>>October</option>
									<option value="11" <?php if($date=='11'){echo "selected='selected'";} ?>>November</option>
									<option value="12" <?php if($date=='12'){echo "selected='selected'";} ?>>December</option>
	                            </select>
	                        </div>
	                        <div class="col-4 col-sm-3">
								<select class="form-control" id="y">
									
									<?php 

										$date=date('Y');

										for ($i=2020; $i <= $date; $i++) { 
											
											echo '<option value="'.$i.'"'; if($i==$date){echo "selected='selected'";} echo '>'.$i.'</option>';
										}

									?>
	                            </select>
	                        </div>
	                    </div>
					</form>

					<div id="message">
															
							
					</div>

					<div class="row table-responsive justify-content-center" >
						
						<div class="card-body col-12 offset-sm-1 col-sm-10" id="table">
							
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

