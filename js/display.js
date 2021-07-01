$(document).ready(function(){


	//helper_income();
	income_counter();
	view_income();
	pagination_view_income();

	expense_counter();
	view_expense();
	pagination_view_expense();

	view_life_event();
	pagination_view_life_event();

	clock();
})



function income_counter(){

	$.ajax({

		url: 'get_income.php',
		method: 'post',
		data: {get_income:2},
		success: function(data){
			//console.log(data);
			data = $.parseJSON(data);
			//console.log(data);
			// $('.icount3').each(function (){

			// 	$({countNum: 0}).animate({countNum: data['total']}, {
			// 	  duration: 5000,
			// 	  step: function() {
			// 	    // What todo on every count
			// 	    //console.log(Math.floor(this.countNum));
			// 	    $('#itotal').html(Math.ceil(this.countNum)+' Tk');
			// 	  }
			// 	});
			// });
	
			$('#itotal').html(Math.ceil(data['total'])+' Tk');
			$('#iyear').html(Math.ceil(data['year'])+' Tk');
			$('#imonth').html(Math.ceil(data['month'])+' Tk');

			// $('.icount2').each(function (){

			// 	$({countNum: 0}).animate({countNum: data['year']}, {
			// 	  duration: 5000,
			// 	  step: function() {
			// 	    // What todo on every count
			// 	    //console.log(Math.floor(this.countNum));
			// 	    $('#iyear').html(Math.ceil(this.countNum)+' Tk');
			// 	  }
			// 	});
			// });

			// $('.icount3').each(function (){

			// 	$({countNum: 0}).animate({countNum: data['month']}, {
			// 	  duration: 5000,
			// 	  step: function() {
			// 	    // What todo on every count
			// 	    //console.log(Math.floor(this.countNum));
			// 	    $('#imonth').html(Math.ceil(this.countNum)+' Tk');
			// 	  }
			// 	});
			// });
		}
	})
}


function helper_income(){

	var month = $("#im").val();
	var year = $("#iy").val();
	window.per_page = $("#iper_page").val();
	//console.log(month+year);
	$.ajax({

		url: 'get_income.php',
		method: 'post',
		data: {month:month,year:year},
		success: function(data){

			data = $.parseJSON(data);
			window.obj=data.value['data'];
			window.total=data.value['total'];
			window.size=obj.length;
			window.add_active=1;
			window.remove_active=0;
			var end;
			var content='';
			var pagination='';
			
			if (jQuery.isEmptyObject(data.value['data'])) {

				content='<h5 class="text-center text-secondary">This month no income history yet.</h5>';
				$('#itable').html(content);	
			} 
			else {

				if (size < per_page) {

					end=size;
				}
				else {

					end=per_page;
				}

				content='<table class="table text-center"> <thead class="thead-dark"> <tr> <th>Title</th><th>Description</th> <th>Amount</th> <th>Date</th> </tr> </thead><tbody>';
				for (start=0; start < end; start++) { 
					
					content += '<tr class="thover"> <td>'+obj[start]['title']+'</td> <td>'+obj[start]['description']+'</td> <td>'+obj[start]['amount']+' Tk'+'</td> <td>'+get_date(obj[start]['date'])+'</td> </tr>';
				}
				//console.log(data.value['total']);
				content+='<tr class="thover"> <td colspan="3" style="font-weight: bold;color:#512DA8;font-size:20px;">Total</td> <td style="font-weight: bold;color:#512DA8;font-size:20px;">'+total+' Tk'+'</td> </tr>';
				content+='</tbody></table><br>';

				content+='<nav aria-label="Page navigation example"> <ul class="pagination justify-content-center">';

				if(size > per_page){

					var k=1;
					for(var j=0; j< Math.ceil(size/per_page); j++){

						content += '<li class="page-item"><button class="page-link page'+k+'" id="ipag" idata-id="'+k+'">'+k+'</button></li>';
						k++;
					}
				}

				content+= '</ul> </nav>';
				//console.log(content);
				$('#itable').html(content);
				$(".page1").css({"background-color":"#007BFF","color":"#fff"});

			}
			
		}
	})
}


function view_income(){

	$('#im').on('change', function() {

		helper_income();
	}); 

	$('#iy').on('change', function() {

		helper_income();
	}); 

	$('#iper_page').on('change', function() {

		helper_income();
	});
}



function pagination_view_income(){

	$(document).on('click','#ipag',function(){

		//console.log("Page No: "+ $(this).attr('data-id'));

		var page=$(this).attr('idata-id');
		remove_active=add_active;
		add_active=page;
		$("#itable > table").html("");

		end=page*per_page;
		
		if (end>size) {
				end=size;
		}
		var start=(page*per_page)-per_page;
		// echo ' Start '.$start;
		var content= '<table class="table text-center"> <thead class="thead-dark"> <tr><th>Title</th><th>Description</th><th>Amount</th><th>Date</th> </tr> </thead><tbody>';

		for (start; start < end; start++) { 
			
			content += '<tr class="thover"> <td>'+obj[start]['title']+'</td> <td>'+obj[start]['description']+'</td> <td>'+obj[start]['amount']+' Tk'+'</td> <td>'+get_date(obj[start]['date'])+'</td> </tr>';
		}
		content+='<tr class="thover"> <td colspan="3" style="font-weight: bold;color:#512DA8; font-size:20px;">Total</td> <td style="font-weight: bold;color:#512DA8; font-size:20px;">'+total+' Tk'+'</td> </tr>';
		content+='</tbody></table>';
		$("#itable > table").html(content);

		//var id=".page"+page;

		$(".page"+remove_active).css({"background-color":"#fff","color":"#007BFF"});
		$(".page"+add_active).css({"background-color":"#007BFF","color":"#fff"});
	
	})
}



//       Expense



function expense_counter(){

	$.ajax({

		url: 'get_expense.php',
		method: 'post',
		data: {get_expense:2},
		success: function(data){
			//console.log(data);
			data = $.parseJSON(data);
			$('.ecount3').each(function (){

				$({countNum: 0}).animate({countNum: data['total']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#etotal').html(Math.ceil(this.countNum)+' Tk');
				  }
				});
			});

			$('.ecount2').each(function (){

				$({countNum: 0}).animate({countNum: data['year']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#eyear').html(Math.ceil(this.countNum)+' Tk');
				  }
				});
			});

			$('.ecount3').each(function (){

				$({countNum: 0}).animate({countNum: data['month']}, {
				  duration: 5000,
				  step: function() {
				    // What todo on every count
				    //console.log(Math.floor(this.countNum));
				    $('#emonth').html(Math.ceil(this.countNum)+' Tk');
				  }
				});
			});
		}
	})
}


function helper_expense(){

	var month = $("#em").val();
	var year = $("#ey").val();
	window.expense_per_page = $("#eper_page").val();
	//console.log(month+year);
	$.ajax({

		url: 'get_expense.php',
		method: 'post',
		data: {month:month,year:year},
		success: function(data){

			data = $.parseJSON(data);
			window.expense=data.value['data'];
			window.expense_total=data.value['total'];
			window.expense_size=expense.length;
			window.expense_add_active=1;
			window.expense_remove_active=0;
			var end;
			var content='';
			var pagination='';
			
			if (jQuery.isEmptyObject(data.value['data'])) {

				content='<h5 class="text-center text-secondary">This month no expense history yet.</h5>';
				$('#etable').html(content);	
			} 
			else{

				if (expense_size < expense_per_page) {

					end=expense_size;
				}
				else {

					end=expense_per_page;
				}

				content='<table class="table text-center"> <thead class="thead-dark"> <tr> <th>Title</th><th>Description</th> <th>Amount</th> <th>Date</th> </tr> </thead><tbody>';
				for (start=0; start < end; start++) { 
					
					content += '<tr class="thover"> <td>'+expense[start]['title']+'</td> <td>'+expense[start]['description']+'</td> <td>'+expense[start]['amount']+' Tk'+'</td> <td>'+get_date(expense[start]['date'])+'</td> </tr>';
				}
				//console.log(data.value['total']);
				content+='<tr class="thover"> <td colspan="3" style="font-weight: bold;color:#512DA8;font-size:20px;">Total</td> <td style="font-weight: bold;color:#512DA8;font-size:20px;">'+expense_total+' Tk'+'</td> </tr>';
				content+='</tbody></table><br>';

				content+='<nav aria-label="Page navigation example"> <ul class="pagination justify-content-center">';

				if(expense_size > expense_per_page){

					var k=1;
					for(var j=0; j< Math.ceil(expense_size/expense_per_page); j++){

						content += '<li class="page-item"><button class="page-link page'+k+'" id="epag" edata-id="'+k+'">'+k+'</button></li>';
						k++;
					}
				}

				content+= '</ul> </nav>';
				//console.log(content);
				$('#etable').html(content);
				$(".page1").css({"background-color":"#007BFF","color":"#fff"});
			}
			
		}
	})
}


function view_expense(){

	$('#em').on('change', function() {

		helper_expense();
	}); 

	$('#ey').on('change', function() {

		helper_expense();
	}); 

	$('#eper_page').on('change', function() {

		helper_expense();
	});
}



function pagination_view_expense(){

	$(document).on('click','#epag',function(){

		//console.log("Page No: "+ $(this).attr('data-id'));

		var page=$(this).attr('edata-id');
		expense_remove_active=expense_add_active;
		expense_add_active=page;
		$("#etable > table").html("");

		end=page*expense_per_page;
		
		if (end>expense_size) {
				end=expense_size;
		}
		var start=(page*expense_per_page)-expense_per_page;
		// echo ' Start '.$start;
		var content= '<table class="table text-center"> <thead class="thead-dark"><th>Title</th><th>Description</th><th>Amount</th><th>Date</th></thead><tbody>';

		for (start; start < end; start++) { 
			
			content += '<tr class="thover"> <td>'+expense[start]['title']+'</td> <td>'+expense[start]['description']+'</td> <td>'+expense[start]['amount']+' Tk'+'</td> <td>'+get_date(expense[start]['date'])+'</td> </tr>';
		}
		content+='<tr class="thover"> <td colspan="3" style="font-weight: bold;color:#512DA8; font-size:20px;">Total</td> <td style="font-weight: bold;color:#512DA8; font-size:20px;">'+expense_total+' Tk'+'</td> </tr>';
		content+='</tbody></table>';
		$("#etable > table").html(content);

		//var id=".page"+page;

		$(".page"+expense_remove_active).css({"background-color":"#fff","color":"#007BFF"});
		$(".page"+expense_add_active).css({"background-color":"#007BFF","color":"#fff"});
	
	})
}




//       Life Event





function helper_life_event(){

	var category = $("#cat").val();
	window.life_event_per_page = $("#lper_page").val();
	//console.log(month+' '+year);
	$.ajax({

		url: 'get_life_event.php',
		method: 'post',
		data: {cat:category},
		success: function(data){

			//console.log(data);
			data = $.parseJSON(data);
			//console.log(data.value);
			window.life_event=data.value;
			window.life_event_size=life_event.length;
			window.life_event_add_active=1;
			window.life_event_remove_active=0;
			var end;
			var content='';
			var pagination='';
			
			if (jQuery.isEmptyObject(data.value)) {

				content='<h5 class="text-center text-secondary">This month no life event history yet.</h5>';
				$('#ltable').html(content);	
			} 
			else{

				if (life_event_size < life_event_per_page) {

					end=life_event_size;
				}
				else {

					end=life_event_per_page;
				}

				content='<table class="table text-center"> <thead class="thead-dark"><th>Title</th><th>Description</th> <th>Date</th></thead><tbody>';
				for (start=0; start < end; start++) { 
					
					content += '<tr class="thover"> <td>'+life_event[start]['title']+'</td> <td>'+life_event[start]['description']+'</td> <td>'+get_date(life_event[start]['date'])+'</td> </tr>';
				}
				//console.log(data.value['total']);
				
				content+='</tbody></table><br>';

				content+='<nav aria-label="Page navigation example"> <ul class="pagination justify-content-center">';

				if(life_event_size > life_event_per_page){

					var k=1;
					for(var j=0; j< Math.ceil(life_event_size/life_event_per_page); j++){

						content += '<li class="page-item"><button class="page-link page'+k+'" id="lpag" ldata-id="'+k+'">'+k+'</button></li>';
						k++;
					}
				}

				content+= '</ul> </nav>';
				//console.log(content);
				$('#ltable').html(content);
				$(".page1").css({"background-color":"#007BFF","color":"#fff"});
			}			
		}
	})
}


function view_life_event(){

	$('#cat').on('change', function() {

		helper_life_event();
	}); 

	$('#lper_page').on('change', function() {

		helper_life_event();
	});
}



function pagination_view_life_event(){

	$(document).on('click','#lpag',function(){

		//console.log("Page No: "+ $(this).attr('data-id'));

		var page=$(this).attr('ldata-id');
		life_event_remove_active=life_event_add_active;
		life_event_add_active=page;
		$("#ltable > table").html("");

		end=page*life_event_per_page;
		
		if (end>life_event_size) {
				end=life_event_size;
		}
		var start=(page*life_event_per_page)-life_event_per_page;
		// echo ' Start '.$start;
		var content= '<table class="table text-center"> <thead class="thead-dark"> <tr><th>Title</th><th>Description</th><th>Date</th> </tr> </thead><tbody>';

		for (start; start < end; start++) { 
			
			content += '<tr class="thover"> <td>'+life_event[start]['title']+'</td> <td>'+life_event[start]['description']+'</td> <td>'+get_date(life_event[start]['date'])+'</td> </tr>';
		}

		content+='</tbody></table>';
		$("#ltable > table").html(content);

		//var id=".page"+page;

		$(".page"+life_event_remove_active).css({"background-color":"#fff","color":"#007BFF"});
		$(".page"+life_event_add_active).css({"background-color":"#007BFF","color":"#fff"});
	
	})
}



function home_content(){

	//console.log("Before ajax");
	window.counter=0;

	$.ajax({

		url: 'helper/get_life_event.php',
		method: 'post',
		data: {day:2},
		success: function(data){
			//console.log(data);
			data = $.parseJSON(data);
			//console.log(data);
			if (jQuery.isEmptyObject(data)) {

				content='<h5 class="text-center text-primary" style="font-family: fantasy;">There is no event today.</h5>';
			} 
			else {

				var end = data.length;
				counter=end;

				content='<table class="table text-center"><thead><th>Title</th><th>Description</th><th>Date</th></thead><tbody>';
				for (start=0; start < end; start++) { 
					
					data[start]['date']=get_month(data[start]['date']);
					content += '<tr class="thover"> <td>'+data[start]['title']+' <span class="badge badge-danger">Today</span> </td><td>'+data[start]['description']+'</td><td>'+data[start]['date']+'</td> </tr>';
				}
				//console.log(data.value['total']);
				
				content+='</tbody></table>';
			}
			
			$("#today").html(content);
		}
	})
	//console.log(counter);

	$.ajax({

		url: 'helper/get_life_event.php',
		method: 'post',
		data: {up:2},
		success: function(data){
			//console.log(data);
			data = $.parseJSON(data);

			//console.log(data.tomorrow[0]);

			if (jQuery.isEmptyObject(data)) {

				content='<h5 class="text-center text-primary" style="font-family: fantasy;">There is no upcoming event.</h5>';
			} 
			else {

				var end = data.tomorrow.length;
				counter+=end;

				content='<table class="table text-center"><thead><th>Title</th><th>Description</th><th>Date</th></thead><tbody>';
				for (start=0; start < end; start++) { 
					
					content += '<tr class="thover"> <td>'+data.tomorrow[start]['title']+' <span class="badge badge-warning">Tomorrow</span> </td><td>'+data.tomorrow[start]['description']+'</td><td>'+get_month(data.tomorrow[start]['date'])+'</td> </tr>';
				}
				
				end = data.upcoming.length;
				counter+=data.upcoming.length;

				for (start=0; start < end; start++) { 
					
					content += '<tr class="thover"> <td>'+data.upcoming[start]['title']+' <span class="badge badge-primary">Upcoming</span> </td><td>'+data.upcoming[start]['description']+'</td><td>'+get_month(data.upcoming[start]['date'])+'</td> </tr>';
				}
				
				content+='</tbody></table>';
			}
			
			$("#upcoming").html(content);


			$.ajax({

				url: 'helper/get_income.php',
				method: 'post',
				data: {home_income:counter},
				success: function(data){
					//console.log(data);
					data = $.parseJSON(data);

					//console.log(data);

					if (jQuery.isEmptyObject(data)) {

						content='<h5 class="text-center text-primary" style="font-family: fantasy;">There is income history</h5>';
					} 
					else {

						content='<table class="table text-center"><thead><th>Title</th><th>Description</th><th>Amount</th><th>Date</th></thead><tbody>';
				
						for (start=0; start < data.length; start++) { 

							content += '<tr class="thover"> <td>'+data[start]['title']+' </td><td>'+data[start]['description']+'</td><td>'+data[start]['amount']+' Tk</td><td>'+get_month(data[start]['date'])+'</td> </tr>';
							
						}
						
						content+='</tbody></table>';
					}
					
					$("#home_income").html(content);
				}
			})


			$.ajax({

				url: 'helper/get_expense.php',
				method: 'post',
				data: {home_income:counter},
				success: function(data){
					//console.log(data);
					data = $.parseJSON(data);

					//console.log(data);

					if (jQuery.isEmptyObject(data)) {

						content='<h5 class="text-center text-primary" style="font-family: fantasy;">There is no expense history yet.</h5>';
					} 
					else {

						content='<table class="table text-center"><thead><th>Title</th><th>Amount</th><th>Description</th><th>Date</th></thead><tbody>';

						for (start=0; start < data.length; start++) { 
							
							content += '<tr class="thover"> <td>'+data[start]['title']+' </td><td>'+data[start]['amount']+' <span>৳</span></td><td>'+data[start]['description']+'</td><td>'+get_month(data[start]['date'])+'</td> </tr>';
							
						}
						
						content+='</tbody></table>';
					}
					
					$("#home_expense").html(content);
				}
			})
		}
	})
}


function get_month(data){

	//console.log(data);
	var month;
	var date=data.split('-');

	if (date[1]=='01'){

		month = 'Jan';

	} else if(date[1]=='02'){

		month = 'Feb';

	} else if(date[1]=='03'){

		month = 'Mar';

	} else if(date[1]=='04'){

		month = 'Apr';

	} else if(date[1]=='05'){

		month = 'May';

	} else if(date[1]=='06'){

		month = 'Jun';

	} else if(date[1]=='07'){

		month = 'Jul';

	} else if(date[1]=='08'){

		month = 'Aug';

	} else if(date[1]=='09'){

		month = 'Sep';

	} else if(date[1]=='10'){

		month = 'Oct';

	} else if(date[1]=='11'){

		month = 'Nov';

	} else {

		month = 'Dec';

	}

	return date[2]+' '+month+', '+date[0];
}

function get_date(data){

	data=data.split('-');

	return data[2]+'-'+data[1]+'-'+data[0];
}


function clock(){

	function showTime(){
		// to get current time/ date.
		var date = new Date();
		// to get the current hour
		var h = date.getHours();
		// to get the current minutes
		var m = date.getMinutes();
		//to get the current second
		var s = date.getSeconds();
		// AM, PM setting
		var session = "AM"; 

		//conditions for times behavior 
		if ( h == 0 ) {
			h = 12;
		}

		if( h >= 12 ){
			session = "PM";
		}

		if ( h > 12 ){
			h = h - 12;
		}

		m = ( m < 10 ) ? m = "0" + m : m;
		s = ( s < 10 ) ? s = "0" + s : s;

		//putting time in one variable
		var time = h + ":" + m + ":" + s + " " + session;
		//putting time in our div

		$('#clock').html(time); 
		//to change time in every seconds
		setTimeout( showTime, 1000 );
	}
	showTime();
}