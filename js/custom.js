$(document).ready(function(){

/***  Income Functions ****/

	view_income();
	edit_income();
	update_income();
	delete_income();
})


/***  Income Functions ****/


function view_income(){

	$('#view').on('change', function() {

		var parent_id = this.value;
		
		$.ajax({

			url: 'get_income.php',
			method: 'post',
			data: {pID:parent_id},
			success: function(data){
				
				data = $.parseJSON(data);
				if (data.status=='success') {

					$('#table').html(data.html);
				}
			}
		})
	});

    
}

function onload_view(){

	var parent_id = $("#view").val();

	$.ajax({

		url: 'get_income.php',
		method: 'post',
		data: {pID:parent_id},
		success: function(data){
			
			data = $.parseJSON(data);
			if (data.status=='success') {

				$('#table').html(data.html);
			}
		}
	})
}

function edit_income(){

	$(document).on('click','#edit_income',function(){

		var id=$(this).attr('data-id');

		$.ajax({

			url: 'get_income.php',
			method: 'post',
			data: {editID:id},
			dataType: 'JSON',
			success: function(data){

				$('#editID').val(data['info']['id']);
				$('#editTitle').val(data['info']['title']);
				$('#editAmount').val(data['info']['amount']);
				$('#editDescription').val(data['info']['description']);
				$('#editDate').val(data['info']['date']);
				
				$('#createOption').empty().append('');
				var mySelect = $('#createOption');
				var i;
				for (i = 0; i < data['category'].length; i++) {
					
					mySelect.append(
				        $('<option></option>').val(data['category'][i]['id']).html(data['category'][i]['category_name'])
				    );
				} 
				$('#createOption').val(data['info']['parent_id']);
				$('#update_income').modal('show');			
			}			
		})
	})
}


function update_income(){

	$(document).on('click','#modify_income',function(){

		var id=$("#editID").val();
		var title=$("#editTitle").val();
		var amount=$("#editAmount").val();
		var description=$("#editDescription").val();
		var date=$("#editDate").val();
		var parent_id=$("#createOption").val();

		$.ajax({

			url: 'get_income.php',
			method: 'post',
			data: {update_id:id,update_title:title,update_amount:amount,update_description:description,update_date:date,update_parent_id:parent_id},
			success: function(data){
				
				$('#update_income').modal('toggle');

				$.ajax({

					url: 'get_income.php',
					method: 'post',
					data: {pID:parent_id},
					success: function(data){
						
						data = $.parseJSON(data);
						if (data.status=='success') {

							$('#table').html(data.html);
						}
					}					
				})

				if (data == 'Income updated successfully') {

					$('#message').html('<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%;margin-bottom: 0px;"><p class="text-center">'+data+'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				} 
				else {

					$('#message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%;margin-bottom: 0px;"><p class="text-center">'+data+'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}			
		})
	})
}


function delete_income(){

	var id;
	var parent_id;

	$(document).on('click','#delete_income',function(){

		id=$(this).attr('data-id');
		parent_id=$(this).attr('parent-id');
		$('#del_income').modal('show');
				
	})

	$(document).on('click','#DelIncome',function(){
		
		$.ajax({

			url: 'get_income.php',
			method: 'post',
			data: {delID:id},
			success: function(data){

				$('#del_income').modal('toggle');

				$.ajax({

					url: 'get_income.php',
					method: 'post',
					data: {pID:parent_id},
					success: function(data){
						
						data = $.parseJSON(data);
						if (data.status=='success') {

							$('#table').html(data.html);
						}
					}
				})

				
				if (data == 'Income deleted successfully') {

					$('#message').html('<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%;margin-bottom: 0px;"><p class="text-center">'+data+'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				} 
				else {

					$('#message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert" style="width: 100%;margin-bottom: 0px;"><p class="text-center">'+data+'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}
		})		
	})
}



/*** End of Income Functions ****/