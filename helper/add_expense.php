
<?php 


	session_start();
	include 'db_connect.php';

	if(isset($_POST["logout"])){

		unset($_SESSION['login_user']);
		session_destroy();
		header("location:../index.php");
	}

	$error="";
	$msg="";
	if(isset($_POST["add_income"])){

		$title=$_POST["title"];
		$amount=$_POST["amount"];
		$date=$_POST["date"];
		$description=$_POST["description"];
		$parent_id=$_POST["parent_id"];
		$sql="insert into event(title,description,amount,parent_id,date) values('$title','$description','$amount','$parent_id','$date')";

		$res=mysqli_query($conn,$sql);

		if ($res) {
			$msg="Income added successfully";
		}
		else{
			$error="Failed to add income";	
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
	<title>Add Expense</title>

	<style> #eactive{color: #C8C8C8 !important;} </style>


</head>

<body>

	<?php include 'nav.php'; ?>


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


	<div class="container-fluid" >

		<div class="row row-content">

			<div class="offset-sm-2 col-sm-8 mt-2">

				<div class="row justify-content-center">
					
					<div class="card" style="min-width: 80%">
						<h3 class="card-header bg-primary text-white text-center">Add Income</h3>
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
			                        <label for="firstname" class="col-sm-4 col-from-label">Income Title</label>
			                        <div class="col-sm-8">
			                            <input type="text" class="form-control" name="title" id="fisrtname" placeholder="Income Title" required>
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        <label for="firstname" class="col-sm-4 col-from-label">Amount</label>
			                        <div class="col-sm-8">
			                            <input type="number" min=0 class="form-control" name="amount" id="fisrtname" placeholder="Amount" required>
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        <label for="description" class="col-sm-4 col-from-label">Income Description</label>
			                        <div class="col-sm-8">
			                            <textarea class="form-control" name="description" id="feedback" rows="5" placeholder="Income Description" required></textarea>
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        <label for="firstname" class="col-sm-4 col-from-label">Date</label>
			                        <div class="col-sm-8">
			                            <input type="date" name="date" required>
			                        </div>
			                    </div>
      
			                 	<div class="form-group row">
			                        <label for="description" class="col-sm-4 col-from-label">Income Category</label>
			                        <div class="col-sm-8">
										<select class="form-control" name="parent_id" required>
										<?php 

											$sql="SELECT id,category_name FROM category WHERE parent_id = (SELECT DISTINCT id FROM category WHERE category_name='Income')";
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
			                            <button type="submit" name="add_income" class="btn btn-primary">Add Income</button>
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

