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
	<title>Manage Life Event</title>

	<style> #lactive{color: #C8C8C8 !important;} </style>


</head>

<body onload="onload_view_life_event();">

	<?php include 'nav.php'; ?>


	<div class="container-fluid" >	

		<div class="row row-content">

			<div class="offset-sm-1 col-sm-10">
					
				<form action="" method="post">
					
                 	<div class="form-group row">
                        <label for="description" class="offset-sm-1 col-sm-5 col-from-label text-center" ><h6>Which life event you want to manage?</h6></label>
                        <div class="col-sm-4 w100">
							<select class="form-control" name="parent_id" id="view_life_event">
								
								<?php 

									$sql="SELECT id,category_name FROM category WHERE parent_id = (SELECT DISTINCT id FROM category WHERE category_name='Life Event')";
									$result = mysqli_query($conn, $sql);
									$id=[];
									$category_name=[];
									$flag=0;
									if (mysqli_num_rows($result)>0) {

										while($row=mysqli_fetch_assoc($result)){

											if ($flag==1) {
												echo '<option value="'.$row['id'].'" selected>'.$row['category_name'].'</option>';
												$flag+=1;
											}
											else
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
				</form>

				<div id="message">
														
						
				</div>

				<div class="justify-content-center">
					
					<div class="card-body">
						<div class="row table-responsive" id="table">
					

						</div>
					</div>
	
				</div>
	    	</div>

	    </div>
	</div>


<!------ Edit Modal ----------->

	<div class="modal fade" id="update_life_event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" >
				<div class="modal-header" style="border: none;">
					<div class="container">
						<div class="row com-sm-12">
							<h5 class="modal-titles"><i class="far fa-edit"></i> Update Life Event</h5>
							<button type="button" class="close pb-4" data-dismiss="modal" >
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
				<div class="modal-body mx-3">
					
					<input type="hidden" class="form-control" name="title" id="editID">
					<div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-from-label">Life Event Title</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="title" id="editTitle" placeholder="Life Event Title" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-sm-4 col-from-label">Life Event Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="description" id="editDescription" rows="5" placeholder="Life Event Description" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="firstname" class="col-sm-4 col-from-label">Date</label>
                        <div class="col-sm-8">
                            <input type="date" name="date" id="editDate" required>
                        </div>
                    </div>

                 	<div class="form-group row">
                        <label for="description" class="col-sm-4 col-from-label">Life Event Category</label>
                        <div class="col-sm-8">
							<select class="form-control" name="parent_id" id="createOption" required>

                            </select>
                        </div>
                    </div>

					
					<div class="modal-footer pt-4" style="border-top: none">
			        	<button type="button" class="btn btn-secondary" id="btn_close" data-dismiss="modal">Close</button>
			        	<!-- <button type="submit" name="add" id="add_user" class="btn btn-primary">Add User</button> -->
			        	<button type="button" name="add" id="modify_life_event" class="btn btn-primary">Update Life Event</button>
			        </div>

				</div>
				
			</div>
		</div>
	</div>



	<!-- Delete Modal -->

	<div class="modal fade" id="del_life_event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">	
		<div class="modal-dialog" role="document">
			<div class="modal-content" >
				<div class="modal-header" style="border: none;">
					<div class="container">
						<div class="row">
							<h5 class="modal-title">Delete Life Event <i class="far fa-trash-alt"></i></h5>
							<button type="button" class="close pb-4" data-dismiss="modal" >
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
				<div class="modal-body mx-3">
					<p><i class="fas fa-trash"></i> Are you sure you want to delete?</p>
					
					<div class="modal-footer pt-4" style="border-top: none">
				        
			        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        	<button type="submit" id="DelLifeEvent" name="delete" class="btn btn-danger">Delete</button>
				       
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
	<script src="../js/custom.js"></script>
	

</body>
</html>

