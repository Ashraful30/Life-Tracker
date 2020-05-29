
<?php 


	session_start();
	include '../helper/db_connect.php';

	$error="";
	$msg="";

	if (isset($_GET)) {
  		$id=$_GET['id'];
  		$name=$_GET['name'];
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
	<title>Get Category</title>
	


</head>

<body>

	
	<div class="col-sm-12 mt-4">
		
		
		<div class="">
			
			<div class="card" style="width: 100%">

				<div class="card-body">

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
					<div class="row">
						<table class="table table-hover text-center">
							<thead class="thead-dark">
								<tr>
									<th>Category Name</th>
									<th>Category Description</th>
									<th>Parent Category</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>

								<?php 

									if ($id=='NULL') {
										$sql="SELECT id,category_name,category_description FROM category WHERE parent_id IS NULL ORDER BY category_name ASC";

										$result = mysqli_query($conn, $sql);

										if (mysqli_num_rows($result)>0) {

											while($row=mysqli_fetch_assoc($result)){

												$url="edit.php?id=".$row['id']."&category_name=".$row['category_name']."&category_description=".$row['category_description']."&parent_id=NULL";
												echo '<tr><td>'.$row['category_name'].'</td><td>'.$row['category_description'].'</td><td>'.$name.'</td><td><a href="'.$url.'" class="btn btn-primary" style="width:90px;"><i class="fas fa-edit"></i> Edit</a> <a href="" class="btn btn-danger" data-toggle="modal" data-target="#mmodalDelete" onclick="myFunction('.$row['id'].',\'NULL\''.',\''.$name.'\''.')"  style="width:90px;"><i class="far fa-trash-alt"></i> Delete</a></td></div></tr>';																		

												
											}
										}
										elseif (mysqli_num_rows($result)==0) {

										}
										else{
											$error="Query Error";										
										}

									}

									else
									{
										$sql="SELECT id,category_name,category_description,parent_id FROM category WHERE parent_id='$id' ORDER BY category_name ASC";

										$result = mysqli_query($conn, $sql);

										if (mysqli_num_rows($result)>0) {

											while($row=mysqli_fetch_assoc($result)){
												$url="edit.php?id=".$row['id']."&category_name=".$row['category_name']."&category_description=".$row['category_description']."&parent_id=".$row['parent_id'];
												echo '<tr><td>'.$row['category_name'].'</td><td>'.$row['category_description'].'</td><td>'.$name.'</td><td><a href="'.$url.'" class="btn btn-primary"><i class="fas fa-edit"></i> Edit</a> <a href="" class="btn btn-danger" data-toggle="modal" onclick="myFunction('.$row['id'].','.$row['parent_id'].',\''.$name.'\''.')" ><i class="far fa-trash-alt"></i> Delete</a></td></tr>';				
											}
										}
										elseif (mysqli_num_rows($result)==0) {

										}
										else{
											$error="Query Error";										
										}										
									}
								?>
							</tbody>
						</table>
					</div>	 				

				</div>
			</div>

		</div>

	</div>

	<!---- Delete modal ---->

	<!-- <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content" >
					<div class="modal-header" style="border: none;">
						<div class="container">
							<div class="row">
								<h5 class="modal-title">Delete Category <i class="far fa-trash-alt"></i></i></h5>
								<button type="button" class="close pb-4" data-dismiss="modal" >
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
					<div class="modal-body mx-3">
						<p><i class="fas fa-trash"></i></i> Are you sure you want to delete?</p>
						<div class="modal-footer pt-4" style="border-top: none">
					        <form action="" method="post">
					        	<input type="hidden" name="cafeId" value="" />
					        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        	<button type="submit" name="delete" class="btn btn-danger">Delete</button>
					        </form>
				      </div>
					</div>
					
				</div>
			</div>
		</div> -->
	

	<script src="../js/jquery.min.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>

	<script>
		

	</script>


</body>
</html>

