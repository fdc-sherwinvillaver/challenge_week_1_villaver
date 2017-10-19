$(document).ready(function(){

	refresh_categories();
	var counter = 0;

	$('#frmnewpayment').on('submit', function(event){
		var str = $('#frmnewpayment').serialize();
		event.preventDefault();
		if(counter == 0){
			if($('#payment').val() == '' || $('#amount').val() == ''){
				toastr.warning('Please fill in all the fields');
			}else if(isNaN($('#amount').val())){
				toastr.warning('Please enter a valid amount');
			}else if(typeof $('#payer').val() == 'object'){
				toastr.warning('Please select a payer');
			}else{
				$.ajax({
					type: 'POST',
					url: 'controllers/PaymentController.php',
					data: str,
					success: function(e){
						toastr.success('Payable successfully created');
						setTimeout(function() { 
							window.location = 'payments.php'; 
						}, 500);
					}
				});
				counter = 1;
			}
		}
	});/*END OF FUNCTIOn*/

	$('#frmupdatepayment').on('submit', function(event){
		var str = $('#frmupdatepayment').serialize();
		event.preventDefault();
		if(counter == 0){
			if($('#amount').val() == "" || $('#payment').val() == ""){
				toastr.warning('Please fill in all the fields');
			}else if(isNaN($('#amount').val())){
				toastr.warning('Please enter a valid amount');
			}else{
				$.ajax({
					type: 'POST',
					url: 'controllers/PaymentController.php',
					data: str,
					success: function(e){
						toastr.success('Payable successfully updated');
						setTimeout(function() { 
							window.location = 'payments.php'; 
						}, 500);
					}
				});
				counter = 1;
			}
		}
	});

});

function togglestatus(id){
	$.ajax({
		type: 'POST',
		url: 'controllers/PaymentController.php',
		data: {
			'id': id,
			'action': 'toggle_status'
		},
		success: function(e){
			refresh_categories();
		}
	});
}

function countAllSelectedPayer(){
	var count = $("#payer :selected").length - 1;
	return count;
}

function refresh_categories(){
	$.ajax({
		type: 'POST',
		url: 'controllers/PaymentController.php',
		data: {
			'action': 'count_participant'
		},
		success: function(e){
			document.getElementById('countparticipant').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/PaymentController.php',
		data: {
			'action': 'count_reservee'
		},
		success: function(e){
			document.getElementById('countreservee').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/PaymentController.php',
		data: {
			'action': 'count_active'
		},
		success: function(e){
			document.getElementById('countactive').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/PaymentController.php',
		data: {
			'action': 'count_inactive'
		},
		success: function(e){
			document.getElementById('countinactive').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/PaymentController.php',
		data: {
			'action': 'get_count'
		},
		success: function(e){
			document.getElementById('count').innerHTML = e;
		}
	});
}