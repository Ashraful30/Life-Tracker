<?php  

	session_start();
	include 'db_connect.php';

	if(!$_SESSION['login_user']){

		header("location:../index.php");
	}

	if (isset($_POST['pID'])) {

		$id=$_POST['pID'];
		
		$value="";
		$value='<table class="table text-center">
					<thead class="thead-dark">
						<tr>
							<th>Title</th>
							<th>Description</th>
							<th>Date</th>
							<th>Category</th>
							<th>Action</th>
						</tr>
					</thead<tbody>';

		$sql="SELECT category_name FROM category WHERE id = '$id'";
		$result = mysqli_query($conn, $sql);
		$row=mysqli_fetch_assoc($result);
		$category=$row['category_name'];

		$sql="SELECT * FROM event WHERE parent_id='$id' ORDER BY MONTH(`date`),DAY(`date`) ASC";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value.='<tr class="thover">
							<td>'.$row['title'].'</td>
							<td>'.$row['description'].'</td>
							<td>'.$row['date'].'</td>
							<td>'.$category.'</td>
							<td><button type="button" class="btn btn-primary" id="edit_life_event" data-id='.$row['id'].'><i class="fas fa-edit"></i></button><button type="button" class="btn btn-danger" id="delete_life_event" parent-id='.$id.' data-id='.$row['id'].'><i class="far fa-trash-alt"></i></button></td>
						</tr>';
			}
			$value.='</tbody></table>';
			//echo $value;
			echo json_encode(['status'=>'success','html'=>$value]);
			//echo $value;
		}
		else{
			echo "Error in data fetch";	
		}
	}

	if (isset($_POST['editID'])) {
		
		$id=$_POST['editID'];

		$sql="SELECT * FROM event WHERE id='$id'";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			while ($row=mysqli_fetch_assoc($res)) {
				
				$user_data['id']=$row['id'];
				$user_data['title']=$row['title'];
				$user_data['description']=$row['description'];
				$user_data['date']=$row['date'];
				$user_data['parent_id']=$row['parent_id'];
			}
			$parent_id=$user_data['parent_id'];

			$sql="SELECT id,category_name FROM category WHERE parent_id=(SELECT parent_id FROM category WHERE id='$parent_id')";
			$res=mysqli_query($conn,$sql);

			if ($res) {
				
				$i=0;
			
				while ($row=mysqli_fetch_assoc($res)) {
					
					// $cat[$i][0]=$row['id'];
					// $cat[$i][1]=$row['category_name'];
					$cat[$i]['id']=$row['id'];
					$cat[$i]['category_name']=$row['category_name'];
					$i+=1;
	
				}

				$data['info']=$user_data;
				$data['category']=$cat;
			 	echo json_encode($data);

			}
			else{
				echo json_encode("Error in data fetch");	
			}			

		}
		else{
			echo json_encode("Error in data fetch");
		 }
	}

	if(isset($_POST["update_id"])){

		$id=$_POST["update_id"];
		$title=addslashes($_POST["update_title"]);
		$date=$_POST["update_date"];
		$description=addslashes($_POST["update_description"]);
		$parent_id=$_POST["update_parent_id"];

		
		$sql="UPDATE event SET title='$title', description='$description', parent_id='$parent_id', date='$date' WHERE id='$id'";
			
		
		$res=mysqli_query($conn,$sql);

		if ($res) {
			echo "Life Event updated successfully";
		}
		else{
			echo "Failed to update life event";	
		}
	}

	if(isset($_POST["delID"])){

		$id=$_POST["delID"];
		
		$sql="DELETE FROM event WHERE id='$id'";
			
		
		$res=mysqli_query($conn,$sql);

		if ($res) {
			echo "Life Event deleted successfully";
		}
		else{
			echo "Failed to delete";	
		}
	}


	if (isset($_POST['cat'])) {

		$cat=$_POST['cat'];
		$value=[];
		
		if($cat == 'all'){
			$sql="SELECT title,description,date FROM `event` WHERE parent_id IN (SELECT id FROM category WHERE parent_id IN(SELECT id FROM category WHERE category_name='Life Event' AND parent_id IS null)) ORDER BY MONTH(`date`),DAY(`date`) ASC";
		}
		else{
			$sql="SELECT title,description,date FROM `event` WHERE parent_id='$cat' ORDER BY MONTH(`date`),DAY(`date`) ASC";
		}

		$res=mysqli_query($conn,$sql);

		if ($res) {
			$i=0;
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value[$i]['title']=$row['title'];
				$value[$i]['description']=$row['description'];
				$value[$i]['date']=$row['date'];
				$i++;
			}
			
			//echo $value;
			echo json_encode(['status'=>'success','value'=>$value]);
			//echo $value;
		}
		else{
			echo "Error in data fetch";	
		}
	}


	if (isset($_POST['day'])) {

		date_default_timezone_set("Asia/Dhaka");
		$date='%-'.date('m').'-'.date('d');
		//echo $date;
		$value=[];

		$sql="SELECT title,description,date FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT DISTINCT id FROM category WHERE category_name='Life Event'))) AND date LIKE '$date' ORDER BY date ASC";
	

		$res=mysqli_query($conn,$sql);

		if ($res) {
			$i=0;
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value[$i]['title']=$row['title'];
				$value[$i]['description']=$row['description'];
				$value[$i]['date']=$row['date'];
				$i++;
			}
			
			//echo $value;
			echo json_encode($value);
			//echo $value;
		}
		else{
			echo "Error in data fetch";		
		}
	}	

	if (isset($_POST['up'])) {
		date_default_timezone_set("Asia/Dhaka");
		$date='%-'.date('m').'-'.date("d", strtotime('tomorrow'));
		$value=[];
		$sql="SELECT title,description,date FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT DISTINCT id FROM category WHERE category_name='Life Event'))) AND date LIKE '$date' ORDER BY date ASC";
		$res=mysqli_query($conn,$sql);
		if ($res) {
			$i=0;
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value[$i]['title']=$row['title'];
				$value[$i]['description']=$row['description'];
				$value[$i]['date']=$row['date'];
				$i++;
			}
			$data['tomorrow']=$value;
			$day=date('d')+1;
			$month=date('m');
			$up= [];
			$sql="SELECT title,description,date FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT DISTINCT id FROM category WHERE category_name='Life Event'))) AND MONTH(`date`) = '$month' AND DAY(`date`) > '$day'  ORDER BY DAY(`date`) ASC ";
			$res=mysqli_query($conn,$sql);
			if ($res) {

				$i=0;
				while ($row=mysqli_fetch_assoc($res)) {
					
					$up[$i]['title']=$row['title'];
					$up[$i]['description']=$row['description'];
					$up[$i]['date']=$row['date'];
					$i++;
				}
				if($i < 11){

					$sql="SELECT title,description,date FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT DISTINCT id FROM category WHERE category_name='Life Event'))) AND MONTH(`date`) > '$month' ORDER BY MONTH(`date`) ASC ";
					$res=mysqli_query($conn,$sql);
					if ($res) {
						while ($row=mysqli_fetch_assoc($res)) {
							
							$up[$i]['title']=$row['title'];
							$up[$i]['description']=$row['description'];
							$up[$i]['date']=$row['date'];
							$i++;

							if($i == 10){
								break;
							}
						}

					}
					if($i < 11){

						$sql="SELECT title,description,date FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT DISTINCT id FROM category WHERE category_name='Life Event'))) AND MONTH(`date`) >=1 AND MONTH(`date`) <= '$month' ORDER BY MONTH(`date`),DAY(`date`) ASC ";
						$res=mysqli_query($conn,$sql);
						if ($res) {
							while ($row=mysqli_fetch_assoc($res)) {
								
								$up[$i]['title']=$row['title'];
								$up[$i]['description']=$row['description'];
								$up[$i]['date']=$row['date'];
								$i++;
								if($i == 10){
									break;
								}
							}	
						}
					}
				}
				
				$data['upcoming']=$up;

				echo json_encode($data);
				//echo $value;
			}
			else{
				echo json_encode("Error in data fetch");		
			}	
		}
		else{
			echo json_encode("Error in data fetch");		
		}
	}	

?>