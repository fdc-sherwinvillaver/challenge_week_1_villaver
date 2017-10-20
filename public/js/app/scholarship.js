$(document).ready(function(){

	var counter = 0;
	refresh_categories();

	$('#frmnewscholarship').on('submit', function(event){
		event.preventDefault();
		var str = $('#frmnewscholarship').serialize();
		if(counter == 0){
			if($('#scholarshipname').val() == '' || $('#discount').val() == ''){
				toastr.warning('Please fill in all the fields');
			}else if(isNaN($('#discount').val())){
				toastr.warning('Please enter a valid amount to be discounted');
			}else{
				$.ajax({
					type: 'POST',
					url: 'controllers/ScholarshipController.php',
					data: str,
					success: function(e){
						toastr.success('Scholarships successfully created');
						setTimeout(function() { 
							window.location = 'scholarships.php'; 
						}, 500);
					}
				});
				counter = 1;
			}
		}
	});/*END OF FUNCTION*/

	$('#frmupdatescholarship').on('submit', function(event){
		event.preventDefault();
		var str = $('#frmupdatescholarship').serialize();
		if(counter == 0){
			if($('#scholarshipname').val() == '' || $('#discount').val() == ''){
				toastr.warning('Please fill in all the fields');
			}else if(isNaN($('#discount').val())){
				toastr.warning('Please enter a valid amount to be discounted');
			}else{
				$.ajax({
					type: 'POST',
					url: 'controllers/ScholarshipController.php',
					data: str,
					success: function(e){
						toastr.success('Scholarships successfully updated');
						setTimeout(function() { 
							window.location = 'scholarships.php'; 
						}, 500);
					}
				});
				counter = 1;
			}
		}
	});
});
	/*$('.mdb-select li').on('click', function(){
			var str = $(this).prevAll().length;
			if(str == 0){

			}
			else if(str == 3){
				appendValue('Program');
			}else if(str == 4){
				appendValue('School');
			}else if(str == 6){
				appendValue('Religion');
			}else{
				hideValue();
			}
		});
	});*/

/*function appendValue(label){
	$('#div_value').slideDown('fast');
	document.getElementById('lb_value').innerHTML = label;

}

function hideValue(){
	$('#div_value').css('display', 'none');
}*/

function togglestatus(id){
	$.ajax({
		type: 'POST',
		url: 'controllers/ScholarshipController.php',
		data: {
			'id': id,
			'action': 'toggle_status'
		},
		success: function(e){
			refresh_categories();
		}
	});
}

function refresh_categories(){
	$.ajax({
		type: 'POST',
		url: 'controllers/ScholarshipController.php',
		data: {
			'action': 'get_count'
		},
		success: function(e){
			document.getElementById('count').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/ScholarshipController.php',
		data: {
			'action': 'count_active'
		},
		success: function(e){
			document.getElementById('countactive').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/ScholarshipController.php',
		data: {
			'action': 'count_inactive'
		},
		success: function(e){
			document.getElementById('countinactive').innerHTML = e;
		}
	});
}