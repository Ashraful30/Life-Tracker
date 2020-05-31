$(document).ready(function(){

	view();
})



function view(){

	$('#view').on('change', function() {

		var parent_id = this.value;
		
		$.ajax({

			url: 'display.php',
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

		url: 'display.php',
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