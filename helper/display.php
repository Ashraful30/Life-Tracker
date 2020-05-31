<?php  

	session_start();
	include 'db_connect.php';

	if (isset($_POST['pID'])) {

		$id=$_POST['pID'];
		
		$value="";
		$value='<table class="table table-bordered text-center">
					<thead class="thead-dark">
						<tr>
							<th>Title</th>
							<th>Amount</th>
							<th>Description</th>
							<th>Category</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead';

		$sql="SELECT category_name FROM category WHERE id = '$id'";
		$result = mysqli_query($conn, $sql);
		$row=mysqli_fetch_assoc($result);
		$category=$row['category_name'];

		$sql="SELECT * FROM event WHERE parent_id='$id' ";
		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value.='<tr>
							<td>'.$row['title'].'</td>
							<td>'.$row['amount'].'</td>
							<td>'.$row['description'].'</td>
							<td>'.$category.'</td>
							<td>'.$row['date'].'</td>
							<td><button type="button" class="btn btn-primary" id="edit" data-id='.$row['id'].'><i class="fas fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-danger" id="delete" data-id='.$row['id'].'><i class="far fa-trash-alt"></i> Delete</button></td>
						</tr>';
			}
			$value.='</table>';
			//echo $value;
			echo json_encode(['status'=>'success','html'=>$value]);
			//echo $value;
		}
		else{
			echo "Error in data fetch";	
		}
	}	

?>