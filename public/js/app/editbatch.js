$(document).ready(function(){

	var batchid = $('#batchid').val();

	$('#saturday').on('click', function(){ $('.sat').slideToggle(); });/*END OF FUNCTION*/

	$('#sunday').on('click', function(){ $('.sun').slideToggle(); });/*END OF FUNCTION*/

	
	$.ajax({
		type: 'POST',
		url: 'controllers/BatchController.php',
		data: {
			'action': 'get_saturday_by_batchid',
			'id': batchid
		},
		success: function(e){
			var data = JSON.parse(e);
			if(data['status'] == 1){
				$('#saturday').click();
				$('#satCapacity').val(data['capacity']);
				$('#lblsatcapacity').addClass('active');
			}
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/BatchController.php',
		data: {
			'action': 'get_sunday_by_batchid',
			'id': batchid
		},
		success: function(e){
			var data = JSON.parse(e);
			if(data['status'] == 1){
				$('#sunday').click();
				$('#sunCapacity').val(data['capacity']);
				$('#lblsuncapacity').addClass('active');
			}
		}
	});

	$('#saturday').on('click', function(){
		if(!document.getElementById('saturday').checked){
			$.ajax({
				type: 'POST',
				url: 'controllers/BatchController.php',
				data: {
					'action': 'count_enrollees_by_section',
					'section': 'Saturday',
					'batchid': batchid
				},
				success: function(e){
					var count = e;
					if(count != 0){
						toastr.warning('Cannot deactivate Saturday section since one or more participants are already enrolled in this section');
						$('#saturday').click();
					}
				}
			});
		}
	});

	$('#sunday').on('click', function(){
		if(!document.getElementById('sunday').checked){
			$.ajax({
				type: 'POST',
				url: 'controllers/BatchController.php',
				data: {
					'action': 'count_enrollees_by_section',
					'section': 'Sunday',
					'batchid': batchid
				},
				success: function(e){
					var count = e;
					console.log(count);
					if(count != 0){
						toastr.warning('Cannot deactivate Sunday section since one or more participants are already enrolled in this section');
						$('#sunday').click();
					}
				}
			});
		}
	});

	$('form').on('submit', function(event){
		var str = $('form').serialize();
		event.preventDefault();
		
		if($('#dateStart').val() == '' || $('#dateEnd').val() == ''){
			toastr.warning('Please fill in all the fields');
		}else if(!document.getElementById('saturday').checked && !document.getElementById('sunday').checked){
			toastr.warning('Please select at least one section');
		}else if(document.getElementById('saturday').checked && $('#satCapacity').val() == ''){
			toastr.warning('Please enter a maximum capacity for Saturday section');
		}else if(document.getElementById('sunday').checked && $('#sunCapacity').val() == ''){
			toastr.warning('Please enter a maximum capacity for Sunday section');
		}else if($('#sched1').val() == '' || $('#sched2').val() == '' || $('#sched3').val() == ''){
			toastr.warning('Please fill in all the fields');
		}else{
			$.ajax({
				type: 'POST',
				url: 'controllers/BatchController.php',
				data: {
					'action': 'count_enrollees_by_section',
					'section': 'Saturday',
					'batchid': batchid
				},
				success: function(e){
					var count = e;
					if(count > parseInt($('#satCapacity').val())){
						toastr.warning("Cannot change Saturday section capacity lesser than the number of students enrolled in this section");
					}else{
						$.ajax({
							type: 'POST',
							url: 'controllers/BatchController.php',
							data: {
								'action': 'count_enrollees_by_section',
								'section': 'Sunday',
								'batchid': batchid
							},
							success: function(e){
								console.log(e);
								var count = e;
								if(count > parseInt($('#sunCapacity').val())){
									toastr.warning("Cannot change Sunday section capacity lesser than the number of students enrolled in this section");
								}else{
									$.ajax({
										type: 'POST',
										url: 'controllers/BatchController.php',
										data: str,
										success: function(e){
											console.log(e);
											toastr.success('Batch successfully updated');
											setTimeout(function() { 
												window.location = 'batches.php'; 
											}, 500);
										}
									});
								}
							}
						});
					}
				}
			});	
		}
	});
});