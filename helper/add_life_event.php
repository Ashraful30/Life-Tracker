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

	$error="";
	$msg="";
	if(isset($_POST["add_life_event"])){

		$title=addslashes($_POST["title"]);
		$date=$_POST["date"];
		$description=addslashes($_POST["description"]);
		$parent_id=$_POST["parent_id"];
		$sql="insert into event(title,description,parent_id,date) values('$title','$description','$parent_id','$date')";
		//echo $sql;
		$res=mysqli_query($conn,$sql);

		if ($res) {
			$msg="Life Event added successfully";
		}
		else{
			$error="Failed to add life event";	
		}
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
	<link rel="stylesheet" href="../css/nav.css">
	<link rel="icon" type="image/gif/png" href="../img/symbol.png">
	<title>Add Life Event</title>

	<style> #lactive{color: #C8C8C8 !important;} </style>


</head>

<body>

	<?php include 'nav.php'; ?>


	<div class="container-fluid" >

		<div class="row row-content">

			<div class="offset-sm-2 col-sm-8 mt-2">

				<div class="row justify-content-center">
					
					<div class="card" style="min-width: 80%">
						<h3 class="card-header bg-primary text-white text-center">Add Life Event</h3>
						<div class="card-body">
							
			                <form action="" method="post">

			                    <div class="row pb-2 com-md-10 justify-content-center">
					
									<?php 
										if ($msg!='') {
											echo '<div class="alert alert-success alert-dismissible text-center" role="alert" style="width: 95%;">'.$msg.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
										}
										elseif ($error!='') {
											echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">'.$error.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
										}
									?>

								</div>	

			                    <div class="form-group row">
			                        <label for="firstname" class="col-sm-4 col-from-label">Life Event Title</label>
			                        <div class="col-sm-8">
			                            <input type="text" class="form-control" name="title" id="fisrtname" placeholder="Life Event Title" required>
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        <label for="description" class="col-sm-4 col-from-label">Life Event Description</label>
			                        <div class="col-sm-8">
			                            <textarea class="form-control" name="description" id="feedback" rows="5" placeholder="Life Event Description" required></textarea>
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        <label for="firstname" class="col-sm-4 col-from-label">Date</label>
			                        <div class="col-sm-8">
			                            <input type="date" name="date" required>
			                        </div>
			                    </div>
      
			                 	<div class="form-group row">
			                        <label for="description" class="col-sm-4 col-from-label">Life Event Category</label>
			                        <div class="col-sm-8">
										<select class="form-control" name="parent_id" required>
										<?php 

											$sql="SELECT id,category_name FROM category WHERE parent_id = (SELECT DISTINCT id FROM category WHERE category_name='Life Event')";
											$result = mysqli_query($conn, $sql);
											$id=[];
											$category_name=[];
											if (mysqli_num_rows($result)>0) {

												while($row=mysqli_fetch_assoc($result)){
													echo '<option value="'.$row['id'].'">'.$row['category_name'].'</option>';
												}
											}
											elseif (mysqli_num_rows($result)==0) {
		
											}
											else{
												$error="Query Error";
											}

										?>

			                            </select>
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        <div class="offset-sm-4 col-sm-8">
			                            <button type="submit" name="add_life_event" class="btn btn-primary">Add Life Event</button>
			                        </div>
			                    </div>


			                </form>

						</div>
					</div>

				</div>

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

