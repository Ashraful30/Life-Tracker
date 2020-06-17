$(document).ready(function(){


	income_counter();
	view();

	expense_counter();
	view_expense();

})



function income_counter(){

	$.ajax({

		url: 'get_income.php',
		method: 'post',
		data: {get_income:2},
		success: function(data){
			console.log(data);
			data = $.parseJSON(data);
			$('.count3').each(function (){

				$({countNum: 0}).animate({countNum: data['total']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#total').html(Math.ceil(this.countNum)+' ৳');
				  }
				});
			});

			$('.count2').each(function (){

				$({countNum: 0}).animate({countNum: data['year']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#year').html(Math.ceil(this.countNum)+' ৳');
				  }
				});
			});

			$('.count3').each(function (){

				$({countNum: 0}).animate({countNum: data['month']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#month').html(Math.ceil(this.countNum)+' ৳');
				  }
				});
			});
		}
	})
}



function view(){

	$('#m').on('change', function() {

		var month = $("#m").val();
		var year = $("#y").val();
		$.ajax({

			url: 'get_income.php',
			method: 'post',
			data: {month:month,year:year},
			success: function(data){
				
				data = $.parseJSON(data);
				if (data.status=='success') {

					$('#table').html(data.html);
				}
			}
		})
	}); 

	$('#y').on('change', function() {

		var month = $("#m").val();
		var year = $("#y").val();
		$.ajax({

			url: 'get_income.php',
			method: 'post',
			data: {month:month,year:year},
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

	var month = $("#m").val();
	var year = $("#y").val();

	//console.log(month+year);
	$.ajax({

		url: 'get_income.php',
		method: 'post',
		data: {month:month,year:year},
		success: function(data){
			
			data = $.parseJSON(data);
			if (data.status=='success') {

				$('#table').html(data.html);
			}
		}
	})
}


//       Expense



function expense_counter(){

	$.ajax({

		url: 'get_expense.php',
		method: 'post',
		data: {get_expense:2},
		success: function(data){
			console.log(data);
			data = $.parseJSON(data);
			$('.count3').each(function (){

				$({countNum: 0}).animate({countNum: data['total']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#total_expense').html(Math.ceil(this.countNum)+' ৳');
				  }
				});
			});

			$('.count2').each(function (){

				$({countNum: 0}).animate({countNum: data['year']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#year_expense').html(Math.ceil(this.countNum)+' ৳');
				  }
				});
			});

			$('.count3').each(function (){

				$({countNum: 0}).animate({countNum: data['month']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#month_expense').html(Math.ceil(this.countNum)+' ৳');
				  }
				});
			});
		}
	})
}



function view_expense(){

	$('#m_expense').on('change', function() {

		var month = $("#m_expense").val();
		var year = $("#y_expense").val();
		$.ajax({

			url: 'get_expense.php',
			method: 'post',
			data: {month:month,year:year},
			success: function(data){
				
				data = $.parseJSON(data);
				if (data.status=='success') {

					$('#table_expense').html(data.html);
				}
			}
		})
	}); 

	$('#y_expense').on('change', function() {

		var month = $("#m_expense").val();
		var year = $("#y_expense").val();
		$.ajax({

			url: 'get_expense.php',
			method: 'post',
			data: {month:month,year:year},
			success: function(data){
				
				data = $.parseJSON(data);
				if (data.status=='success') {

					$('#table_expense').html(data.html);
				}
			}
		})
	}); 
}





function onload_view_expense(){

	var month = $("#m_expense").val();
	var year = $("#y_expense").val();

	//console.log(month+year);
	$.ajax({

		url: 'get_expense.php',
		method: 'post',
		data: {month:month,year:year},
		success: function(data){
			
			data = $.parseJSON(data);
			if (data.status=='success') {

				$('#table_expense').html(data.html);
			}
		}
	})
}