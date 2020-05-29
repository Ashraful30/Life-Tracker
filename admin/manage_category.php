
<?php 

	$parent="'NULL'";
	$name="'Parent'";
	// $parent=21;
	// $name="'Expense'";
	$error="";
	$msg="";

	session_start();
	include '../helper/db_connect.php';

	if(isset($_POST["logout"])){

		unset($_SESSION['login_user']);
		session_destroy();
		header("location:../index.php");
	}


	if (isset($_GET['editedParent'])) {

  		$epid=$_GET['editedParent'];
  		$ecat_name=$_GET['editedName'];
  		$msg=$_GET['editedMsg'];
  		$error=$_GET['edittedError'];

  		if ($epid=="NULL") {
			$parent="'NULL'";
			$name="'Parent'";
		}
		else{
			$parent=$epid;
			$name='\''.$ecat_name.'\'';
		}
  	}

	if(isset($_POST["delete"])){

		$id=$_POST["delid"];
		$parent_id=$_POST["delparent"];
		$name=$_POST["delname"];
		$sql = " DELETE FROM category WHERE id='$id'";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			$msg="Category deleted successfully";
		}
		else{
			$error="Error in deletion";	
		}
		if ($parent_id=="NULL") {
			$parent="'NULL'";
			$name="'Parent'";
		}
		else{
			$parent=$parent_id;
			$name='\''.$name.'\'';
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
	<link rel="icon" type="image/gif/png" href="../img/symbol.png">
	<title>Manage Category</title>

	<style>
		#mactive{
			color: white;
		}
	</style>


</head>

<body onload="loadData(<?php echo $parent.','.$name; ?>)">

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


	<div class="container-fluid" >		
		<div class="row">

			<div class="col-sm-3" style="min-height: 650px;background: lightgrey">				
				
				<div class="row">
					<a class="list-unstyled pt-2" href="add_category.php" style="text-decoration:none;width: 100%;"><button type="button" class="btn login btn-block">Add Category</button></a>		
				</div>
				<div class="row">
					<a class="list-unstyled" href="manage_category.php" style="text-decoration:none;width: 100%;"><button type="button" class="btn login btn-block">Manage Category</button></a>		
				</div>

			</div>

			<div class="col-sm-9 mt-4 pt-4">
					
				<div >
					
					<form action="" method="post">
						
	                 	<div class="form-group row">
	                        <label for="description" class="offset-sm-1 col-sm-5 col-from-label text-center" ><h6>Which category you want to manage?</h6></label>
	                        <div class="col-sm-4 w100">
								<select class="form-control" name="parent_id" onchange="getval(this);" >
									
									<option value="NULL" id="selectParent">Parent</option>
									<?php 

										$sql="Select id,category_name from category where parent_id is null order by category_name asc";
										$result = mysqli_query($conn, $sql);

										if (mysqli_num_rows($result)>0) {

											while($row=mysqli_fetch_assoc($result)){
												echo '<option value="'.$row['id'].'" id="select'.$row['category_name'].'">'.$row['category_name'].'</option>';
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
				</div>

				<div class="justify-content-center">
					<div class="row mx-1">
						<?php 
							if ($msg!='') {
								echo '<div class="alert alert-success alert-dismissible fade show text-center justify-content-center" role="alert" style="width: 100%;margin-bottom: -25px;">'.$msg.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							}
							elseif ($error!='') {
								echo '<div class="alert alert-danger alert-dismissible fade show text-center justify-content-center" role="alert" style="width: 100%;margin-bottom: -25px;">'.$error.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
							}
						?>					
					</div>
					<div class="row" id="txtHint">
						<!-- Customer info will be listed here... -->

					</div>
				</div>
	    	</div>
	    </div>
	</div>


	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
		aria-hidden="true">	
		<div class="modal-dialog" role="document">
			<div class="modal-content" >
				<div class="modal-header" style="border: none;">
					<div class="container">
						<div class="row">
							<h5 class="modal-title">Delete Category <i class="far fa-trash-alt"></i></h5>
							<button type="button" class="close pb-4" data-dismiss="modal" >
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
				</div>
				<div class="modal-body mx-3">
					<p><i class="fas fa-trash"></i> Are you sure you want to delete?</p>
					
					<div class="modal-footer pt-4" style="border-top: none">
				        <form action="" method="post">
				        	<input type="hidden" name="delid" id="delid" value="" />
				        	<input type="hidden" name="delparent" id="delparent" value="" />
				        	<input type="hidden" name="delname" id="delname" value="" />
				        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        	<button type="submit" name="delete" class="btn btn-danger">Delete</button>
				        </form>
			      </div>
				</div>	
			</div>
		</div>
	</div>



	<footer class="footer">
		<div class="container-fluid">				
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
		
		function getval(val){

			//alert(val.value+"Working");

			if (val.value!=""){

				var url = "id="+val.value+"&name="+val.options[val.selectedIndex].text;
				//alert(test);
				var xhttp;
				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("txtHint").innerHTML = this.responseText;
					}
				};
				xhttp.open("GET", "get_category.php?"+url, true);
				xhttp.send();
			}
		}
		// function myNewFunction(sel) {
		//   alert(sel.options[sel.selectedIndex].text+' '+sel.value);
		// }

		// $(document).ready(function(){
		//    $(".announce").click(function(){ // Click to only happen on announce links
		//      $("#cafeId").val($(this).data('id'));
		//      $('#modalDelete').modal('show');tt
		//    });
		// });

		function loadData(val,name){
			var url;
			if (val=='NULL') {
				url = "id=NULL&name=Parent";
			}
			else{
				url = "id="+val+"&name="+name;
			}
			var selector = '#select'+name;
			$(selector).attr("selected", "selected");
			
			//alert(val+' '+name);
			var xhttp;
			xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("txtHint").innerHTML = this.responseText;
				}
			};
			xhttp.open("GET", "get_category.php?"+url, true);
			xhttp.send();
		}

		function myFunction(id,parent,name) {
			
			// $("#delid").val(val);
			// $("#modalDelete").modal();
			$("#delid").val(id);
			$("#delparent").val(parent);
			$("#delname").val(name);
			$("#modalDelete").modal();
			//alert('ok');
			//alert(id+' '+parent+' '+name);
		}
	</script>
</body>
</html>

