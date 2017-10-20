var payments = new Array();
var scholarships = new Array();

$(document).ready(function(){

	var counter = 0;

	$.ajax({
		type: 'POST',
		url: 'controllers/BatchController.php',
		data: {
			'action': 'count_batch'
		},
		success: function(e){
			var count = e;
			$('#batchno').val("Batch "+count);
		}
	});

	$('#btnnewbatch').on('click', function(){
		$.ajax({
			type: 'POST',
			url: 'controllers/BatchController.php',
			data: {
				'action': 'count_active_batch'
			},
			success: function(e){
				var count = e;
				if(count != 0){
					toastr.warning('Cannot create new batch. One is currently active');
				}else{
					window.location='newbatch.php';
				}
			}
		});
	});

	$('#saturday').on('click', function(){
		$('.sat').slideToggle();
	});/*END OF FUNCTION*/

	$('#sunday').on('click', function(){
		$('.sun').slideToggle();
	});/*END OF FUNCTION*/

	$('#frmbatch').on('submit', function(event){
		var str = $('#frmbatch').serialize();
		event.preventDefault();

		if (counter == 0){
			if($('#dateStart').val() == '' || $('#dateEnd').val() == ''){
			toastr.warning('Please fill in all the fields');
			}else if(!document.getElementById('saturday').checked && !document.getElementById('sunday').checked){
				toastr.warning('Please select at least one section');
			}else if(document.getElementById('saturday').checked && $('#satCapacity').val() == ''){
				toastr.warning('Please enter a maximum capacity for Saturday section');
			}else if(document.getElementById('saturday').checked && isNaN($('#satCapacity').val())){
				toastr.warning('Maximum capacity given for Saturday section is invalid');
			}else if(document.getElementById('sunday').checked && $('#sunCapacity').val() == ''){
				toastr.warning('Please enter a maximum capacity for Sunday section');
			}else if(document.getElementById('sunday').checked && isNaN($('#sunCapacity').val())){
				toastr.warning('Maximum capacity given for Sunday section is invalid');
			}else{
				document.getElementById('frmbatch').submit();
				counter = 1;
			}
		}
	});/*END OF FUNCTION*/

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
					data: str,
					success: function(e){
						var batchid = e;
						$.ajax({
							type: 'POST',
							url: 'controllers/BatchController.php',
							data: {
								payments: payments,
								batchid: batchid,
								action: 'set_batchpayments'
							},
							success: function(e){
								toastr.success('Batch successfully created');
								setTimeout(function() { 
									window.location = 'batches.php'; 
								}, 500);
							}
						});
					}
				});
				counter = 1;
			}
		}
	});

	$('#frmresults').on('submit', function(event){
		var str = $('#frmresults').serialize();
		event.preventDefault();
		
		if(counter == 1){
			$.ajax({
				type: 'POST',
				url: 'controllers/BatchController.php',
				data: str,
				success: function(e){
					toastr.success('Results successfully set');
					setTimeout(function() { 
						window.location = "participants.php"; 
					}, 500);
				}
			});
			counter = 1;
		}
	});
	/*END OF FUNCTION*/

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

function add_school_disc(){
	$('#modal_school_disc').modal('show');
}

function edit_school_disc(id){
	$.ajax({
		type: 'POST',
		url: 'controllers/scholarshipController.php',
		data: {
			'id': id,
			'action': 'get_scholarship'
		},
		success: function(e){
			var data = JSON.parse(e);
			$('#editschoolname').val(data['value']);
			$('#editschooldiscount').val(data['discount']);
			$('#schooldisc_id').val(id);
		}
	});
	$('#update_school_disc').modal('show');
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

function editdiscount(id){
	$.ajax({
		type: 'POST',
		url: 'controllers/scholarshipController.php',
		data: {
			'id': id,
			'action': 'get_scholarship'
		},
		success: function(e){
			var data = JSON.parse(e);
			$('#scholarshipname').val(data['scholarshipName']);
			$('#discount').val(data['discount']);
			$('#scholarshipid').val(id);
		}
	});
	$('#modal_disc_edit').modal('show');
}

function deactivate_disc(id){
	$('#remove_id').val(id);
	$('#deactivate_disc').modal('show');
}

function setresults(batchid){
	/*$.ajax({
		type: 'POST',
		url: 'controllers/BatchController.php',
		data: {
			'id': batchid,
			'action':'get_saturday_by_batchid',
		},
		success: function(e){
			var data = JSON.parse(e);
			var sectionid = data['sectionid'];
			var status = data['status'];
			$.ajax({
				type: 'POST',
				url: 'controllers/BatchController.php',
				data: {
					'sectionid': sectionid,
					'action': 'count_sectionparticipants'
				},
				success: function(e){
					var count = e;
					if(status != 0 && count == 0){
						toastr.warning('There is no participant to set result for in Saturday Section');
					}
				}
			});
		}
	});
	

	$.ajax({
		type: 'POST',
		url: 'controllers/BatchController.php',
		data: {
			'id': batchid,
			'action':'get_sunday_by_batchid',
		},
		success: function(e){
			var data = JSON.parse(e);
			var sectionid = data['sectionid'];
			var status = data['status'];
			$.ajax({
				type: 'POST',
				url: 'controllers/BatchController.php',
				data: {
					'sectionid': sectionid,
					'action': 'count_sectionparticipants'
				},
				success: function(e){
					var count = e;
					if(status != 0 && count == 0){
						toastr.warning('There is no participant to set result for in Sunday Section');
					}
				}
			});
		}
	});*/
	window.location = "endbatch.php?id="+batchid;
}