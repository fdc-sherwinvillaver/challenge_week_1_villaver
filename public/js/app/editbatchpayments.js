var payments = new Array();
var scholarships = new Array();

$(document).ready(function(){
	var counter = 0;

	$('#btnmodal').tooltip().mouseover();

	$.ajax({
		type: 'POST',
		url: 'controllers/BatchController.php',
		data: {
			'batchid': $('#batchid').val(),
			'action': 'get_batch_payments'
		},
		success: function(e){
			var data = JSON.parse(e);
			for (var i = 0; i < data.length; i++) {
				get_payment(data[i]['paymentid'], data[i]['payer']);
			}
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/BatchController.php',
		data: {
			'batchid': $('#batchid').val(),
			'action': 'get_batch_scholarships'
		},
		success: function(e){
			var data = JSON.parse(e);
			for(var i=0; i < data.length; i++){
				scholarships.push(data[i]['scholarshipid']);
			}
		}
	});

	$('#btnmodal').on('click', function(){ $('.modal').modal('show');});

	$('#frmbatchpayments').on('submit', function(event){
		var str = $('#frmbatchpayments').serialize();
		event.preventDefault();

		if (counter == 0){
			if($('#sched1').val() == '' || $('#sched2').val() == '' || $('#sched3').val() == ''){
				toastr.warning('Please fill in all the fields');
			}else{
				$.ajax({
					type: 'POST',
					url: 'controllers/BatchController.php',
					data: {
						'payments': payments,
						'batchid': $('#batchid').val(),
						'action': 'update_batchpayments'
					},
					success: function(e){
						$.ajax({
							type: 'POST',
							url: 'controllers/BatchController.php',
							data: str,
							success: function(e){
								toastr.success('Batch payables successfully updated');
								setTimeout(function() { 
									window.location = "batches.php";
								}, 500);
							}
						});
					}
				});
				counter = 1;
			}
		}
	});
});

function togglepayments(elem, paymentid, payer){
	if(document.getElementById(elem).checked){
		get_payment(paymentid, payer);
		if(payer == 1){
			bsedpaymentcounter++;
			$.ajax({
				type: 'POST',
				url: 'controllers/PaymentController.php',
				data: {
					'paymentid': paymentid,
					'current': document.getElementById('bsedtotal').innerHTML,
					'operator': 'add',	
					'action': 'get_current_total'
				},
				success: function(e){
					document.getElementById('bsedtotal').innerHTML = parseFloat(e).toFixed(2);
				}
			});
		}else{
			beedpaymentcounter++;
			$.ajax({
				type: 'POST',
				url: 'controllers/PaymentController.php',
				data: {
					'paymentid': paymentid,
					'current': document.getElementById('beedtotal').innerHTML,
					'operator': 'add',	
					'action': 'get_current_total'
				},
				success: function(e){
					document.getElementById('beedtotal').innerHTML = parseFloat(e).toFixed(2);
				}
			});
		}
	}else{
		var index = payer+paymentid;
		payments.splice(payments.indexOf(index), 1);
		if(payer == 1){
			bsedpaymentcounter--;
			$.ajax({
				type: 'POST',
				url: 'controllers/PaymentController.php',
				data: {
					'paymentid': paymentid,
					'current': document.getElementById('bsedtotal').innerHTML,
					'operator': 'minus',	
					'action': 'get_current_total'
				},
				success: function(e){
					document.getElementById('bsedtotal').innerHTML = parseFloat(e).toFixed(2);
				}
			});
		}else{
			beedpaymentcounter--;
			$.ajax({
				type: 'POST',
				url: 'controllers/PaymentController.php',
				data: {
					'paymentid': paymentid,
					'current': document.getElementById('beedtotal').innerHTML,
					'operator': 'minus',	
					'action': 'get_current_total'
				},
				success: function(e){
					document.getElementById('beedtotal').innerHTML = parseFloat(e).toFixed(2);
				}
			});
		}
	}
}

function get_payment(paymentid, payer){
	payments.push(payer+paymentid);
}

function togglescholarships(scholarshipid){
	if(document.getElementById(scholarshipid).checked){
		scholarships.push(scholarshipid);
	}else{
		scholarships.splice(scholarships.indexOf(scholarshipid), 1);
	}
}