<?php  

	session_start();
	include 'db_connect.php';

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

		$sql="SELECT * FROM event WHERE parent_id='$id' ";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value.='<tr class="thover">
							<td>'.$row['title'].'</td>
							<td>'.$row['description'].'</td>
							<td>'.$row['date'].'</td>
							<td>'.$category.'</td>
							<td><button type="button" class="btn btn-primary" id="edit_life_event" data-id='.$row['id'].'><i class="fas fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-danger" id="delete_life_event" parent-id='.$id.' data-id='.$row['id'].'><i class="far fa-trash-alt"></i> Delete</button></td>
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
		$title=$_POST["update_title"];
		$date=$_POST["update_date"];
		$description=$_POST["update_description"];
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

?>