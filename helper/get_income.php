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
							<th>Amount</th>
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
							<td>'.$row['amount'].'</td>
							<td>'.$row['date'].'</td>
							<td>'.$category.'</td>
							<td><button type="button" class="btn btn-primary" id="edit_income" data-id='.$row['id'].'><i class="fas fa-edit"></i> Edit</button>
							<button type="button" class="btn btn-danger" id="delete_income" parent-id='.$id.' data-id='.$row['id'].'><i class="far fa-trash-alt"></i> Delete</button></td>
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
				$user_data['amount']=$row['amount'];
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
		$amount=$_POST["update_amount"];
		$date=$_POST["update_date"];
		$description=$_POST["update_description"];
		$parent_id=$_POST["update_parent_id"];

		
		$sql="UPDATE event SET title='$title', description='$description', amount='$amount', parent_id='$parent_id', date='$date' WHERE id='$id'";
			
		
		$res=mysqli_query($conn,$sql);

		if ($res) {
			echo "Income updated successfully";
		}
		else{
			echo "Failed to update";	
		}
	}

	if(isset($_POST["delID"])){

		$id=$_POST["delID"];
		
		$sql="DELETE FROM event WHERE id='$id'";
			
		
		$res=mysqli_query($conn,$sql);

		if ($res) {
			echo "Income deleted successfully";
		}
		else{
			echo "Failed to delete";	
		}
	}

	if(isset($_POST["get_income"])){

		$from_month = date('Y').'-'.date('m').'-01';
		$to_month = date('Y').'-'.date('m').'-31';

		$from_year = date('Y').'-01-'.'01';
		$to_year = date('Y').'-12-'.'31';


		
		$sql="SELECT SUM(amount) AS sum FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT id FROM category WHERE category_name='Income')))";
			
		
		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			$row=mysqli_fetch_assoc($res);
			
			$data['total']=$row['sum'];
		}
		else{
			echo "Error in data fetch";	
		}


		$sql="SELECT SUM(amount) AS sum FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT id FROM category WHERE category_name='Income'))) AND date BETWEEN '$from_month' AND '$to_month' ";

		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			$row=mysqli_fetch_assoc($res);
			
			$data['month']=$row['sum'];
		}
		else{
			echo "Error in data fetch";	
		}

		$sql="SELECT SUM(amount) AS sum FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT id FROM category WHERE category_name='Income'))) AND date BETWEEN '$from_year' AND '$to_year' ";

		$res=mysqli_query($conn,$sql);

		if ($res) {
			
			$row=mysqli_fetch_assoc($res);
			
			$data['year']=$row['sum'];
		}
		else{
			echo "Error in data fetch";	
		}

		echo json_encode($data);
	}



	if (isset($_POST['month'])) {

		$month=$_POST['month'];
		$year=$_POST['year'];
		$total=0;

		$from=$year.'-'.$month.'-01';
		$to=$year.'-'.$month.'-31';

		$value=[];
		

		if ($month==0) {

			$from=$year.'-01-01';
			$to=$year.'-12-31';

			$sql="SELECT title,description,amount,date FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT id FROM category WHERE category_name='Income'))) AND date BETWEEN '$from' AND '$to' ORDER BY date DESC";
		}
		else{
			$sql="SELECT title,description,amount,date FROM `event` WHERE parent_id IN ((SELECT id FROM category WHERE parent_id=(SELECT id FROM category WHERE category_name='Income'))) AND date BETWEEN '$from' AND '$to' ORDER BY date DESC";
		}

		$res=mysqli_query($conn,$sql);

		if ($res) {
			$i=0;
			while ($row=mysqli_fetch_assoc($res)) {
				
				$value[$i]['title']=$row['title'];
				$value[$i]['description']=$row['description'];
				$value[$i]['date']=$row['date'];
				$value[$i]['amount']=$row['amount'];
				$total+=$row['amount'];
				$i++;
			}
			$data['data']=$value;
			$data['total']=$total;
			//echo $value;
			echo json_encode(['status'=>'success','value'=>$data]);
			//echo $value;
		}
		else{
			echo "Error in data fetch";	
		}
	}

?>