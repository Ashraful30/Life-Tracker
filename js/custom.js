$(document).ready(function(){

	view_income();
	edit_income();
	update_income();
})



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
				//$('#table').html(data);
				//alert("WORKING")
			}
			//alert('ok')
		})
	});

    
}

function onload_view(){

	var parent_id = $("#view").val();
	//alert("working");

	$.ajax({

		url: 'get_income.php',
		method: 'post',
		data: {pID:parent_id},
		success: function(data){
			
			data = $.parseJSON(data);
			if (data.status=='success') {

				$('#table').html(data.html);
			}
			//$('#table').html(data);
			//alert("WORKING")
		}
		//alert('ok')
	})
}

function edit_income(){

	$(document).on('click','#edit_income',function(){

		var id=$(this).attr('data-id');
		//alert(id);
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
				
				//alert(data);
				//console.log(data['info']['title']);
				$('#createOption').empty().append('');
				var mySelect = $('#createOption');
				var i;
				for (i = 0; i < data['category'].length; i++) {
					
					//console.log(data['category'][i]['category_name']);
					mySelect.append(
				        $('<option></option>').val(data['category'][i]['id']).html(data['category'][i]['category_name'])
				    );
				} 
				$('#createOption').val(data['info']['parent_id']);
				$('#update_income').modal('show');
				//alert('ok');
				//console.log(cat);
				
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
		// console.log(id+' '+title+' '+amount+' '+description+' '+parent_id+' '+date);
		// alert(id);
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
						//$('#table').html(data);
						//alert("WORKING")
					}
					//alert('ok')
				})

				$('#update_success').html('<div class="alert alert-success alert-dismissible fade show" role="alert" style="width: 100%;"><p class="text-center">'+data+'</p><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

			}
			
		})
	})
}