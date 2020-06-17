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

	if (isset($_GET)) {
  		$id=$_GET['id'];
  		$name=$_GET['category_name'];
  		$description=$_GET['category_description'];
  		$pid=$_GET['parent_id'];
  		$parent;

  		if ($pid!="NULL") {

  			$sql="SELECT category_name FROM category WHERE id='$pid'";
	  		$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result)>0) {

				$row=mysqli_fetch_assoc($result);
				$parent=$row['category_name'];
			}
  		}
  		else{
  			$parent="Parent";
  		}
  	}



	if(isset($_POST["logout"])){

		unset($_SESSION['login_user']);
		session_destroy();
		header("location:../index.php");
	}

	if(isset($_POST["update_category"])){

		$id=$_POST["id"];
		$cat_name=$_POST["category_name"];
		$description=$_POST["description"];
		$parent_id=$_POST["parent_id"];

		 //echo "Parent Id is ".$parent_id;

		if ($_POST["parent_id"]=='NULL') {
			
			$sql="UPDATE category SET category_name='$cat_name' , category_description='$description' , parent_id=NULL WHERE id='$id'";
			//echo "string";

		}
		else{
			$sql="UPDATE category SET category_name='$cat_name' , category_description='$description' , parent_id='$parent_id' WHERE id='$id'";
			
		}

		$res=mysqli_query($conn,$sql);

		if ($res) {
			$msg="Category Updated successfully";
		}
		else{
			$error="Error in insertion";	
		}
		if ($parent_id!='NULL') {

			$sql="SELECT category_name from category where id='$parent_id' limit 1";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0) {

				$row=mysqli_fetch_assoc($result);
				$cat_name=$row["category_name"];
				//echo ' inside '.$cat_name;
			}
		}
		//echo ' Outside '.$cat_name;
		header("location: manage_category.php?editedParent=".$parent_id."&editedName=".$cat_name."&editedMsg=".$msg."&edittedError=".$error.".php");
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
	<title>Edit Category</title>

	<style>
		
	</style>


</head>

<body>

	<?php include 'nav.php'; ?>


	<div class="container-fluid" >		

		<div class="row row-content">

			<div class="offset-sm-2 col-sm-8 mt-4">
				
				
				<div class="row justify-content-center">
					
					<div class="card" style="min-width: 70%">
						<h3 class="card-header bg-primary text-white text-center">Update Category</h3>
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
								<input type="hidden" name="id" value="<?php echo $id ?>">
			                    <div class="form-group row">
			                        <label for="firstname" class="col-sm-4 col-from-label">Category Name</label>
			                        <div class="col-sm-8">
			                            <input type="text" class="form-control" name="category_name" id="fisrtname" placeholder="Category Name" required value="<?php echo $name ?>">
			                        </div>
			                    </div>

			                    <div class="form-group row">
			                        <label for="description" class="col-sm-4 col-from-label">Category Description</label>
			                        <div class="col-sm-8">
			                            <textarea class="form-control" name="description" rows="5" placeholder="Category Description" required ><?php echo $description; ?></textarea>
			                        </div>
			                    </div>
      
			                 	<div class="form-group row">
			                        <label for="description" class="col-sm-4 col-from-label">Parent Category</label>
			                        <div class="col-sm-8">
										<select class="form-control" name="parent_id">
											<option value="NULL" <?php if ($parent=="Parent") {echo "selected";} ?> >Parent</option>
										<?php 

											$sql="Select id,category_name from category where parent_id is null order by category_name asc";
											$result = mysqli_query($conn, $sql);
											$id=[];
											$category_name=[];
											if (mysqli_num_rows($result)>0) {

												while($row=mysqli_fetch_assoc($result)){
													echo '<option value="'.$row['id'].'"';?> <?php if ($parent==$row['category_name']) {echo "selected";}; echo '>'.$row['category_name'].'</option>';
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
			                            <button type="submit" name="update_category" class="btn btn-primary">Update Category</button>
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

	<script>
		
	</script>


</body>
</html>

