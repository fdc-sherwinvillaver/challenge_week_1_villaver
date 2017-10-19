var scholarships = new Array();
$(document).ready(function(){
var totalpayment = parseFloat(parseFloat(total) / 3).toFixed(2);
	$('#btnsc').on('click', function(){
		var t = total;
		var totaldisc = 0;
		var str = $('#frmsc').serialize();

		$.ajax({
			type: 'POST',
			url: 'controllers/EnrollmentController.php',
			data: str,
			success: function(e){
				var data = JSON.parse(e);
				var arr = Object.values(data);

				$('#participantscholarships').empty();
				scholarships = [];
				if(arr.length > 1){
					$('#nodisc').hide();
						for (var i = 0; i < arr.length -1; i++) {
						var id = arr[i];
						scholarships.push(id);					
						$.ajax({
							type: 'POST',
							url: 'controllers/ScholarshipController.php',
							data: {
								'id': id,
								'action': 'get_scholarship'
							},
							success: function(e){
								var d = JSON.parse(e);
								totaldisc += parseFloat(d['discount']);
								$('#paymenttotal').empty();
								var x = parseFloat(t) - parseFloat(totaldisc);
								$('#paymenttotal').append("<strong>TOTAL: </strong>"+x+"</span>");
								totalpayment = parseFloat(parseFloat(x) / 3).toFixed(2);
								/*<li>"+d['scholarshipName']+"<span class='float-right'>"+d['discount']+"</span></li>*/
								$('#participantscholarships').append("<li>"+d['scholarshipName']+"<span class='float-right'>"+d['discount']+"</span></li>");
							}
						});
					}
				}else{
					$('#nodisc').show();
					totalpayment = total;
				}
			}
		});
	});
	
	$('#btnsubmit').on('click', function(){
		if(x == 'new'){
			$.ajax({
				type: 'POST',
				url: 'controllers/EnrollmentController.php',
				data: {
					'payments': 	payments,
					'totalpayment': totalpayment,
					'participantno': participantno,
					'scholarships': scholarships,
		            'firstname': 	firstname,
		            'middlename': 	middlename,
		            'lastname': 	lastname,
		            'gender': 		gender,
		            'birthdate': 	birthdate,
		            'cstatus': 		cstatus,
		            'religion': 	religion,
		            'barangay': 	barangay,
		            'city': 		city,
		            'province': 	province,
		            'phone': 		phone,
		            'email': 		email,
		            'program': 		program,
		            'major': 		major,
		            'school': 		school,
		            'semgrad': 		semgrad,
		            'yrgrad': 		yrgrad,
		            'secCourse': 	secCourse,
		            'sec': 			sec,
		            'secschool': 	secschool,
		            'isEmployed': 	isEmployed,
		            'position': 	position,
		            'company': 		company,
		            'honors': 		honors,
		            'section': 		section,
		            'facebook': 	facebook,
		            'image': 		image,
		            'action': 		'enroll_participant'
				},
				success: function(e){
					console.log(totalpayment);
					toastr.success('Participant successfully enrolled');
					setTimeout(function() { 
						window.location = "batches.php"; 
					}, 500);
				}
			});
		}else{
			$.ajax({
				type: 'POST',
				url: 'controllers/EnrollmentController.php',
				data: {
					'id': id,
					'payments': 	payments,
					'totalpayment': totalpayment,
					'scholarships': scholarships,
					'section': section,
					'action': 'enroll_retaker'
				},
				success: function(e){
					toastr.success('Participant successfully enrolled');
					setTimeout(function() { 
						window.location = "batches.php"; 
					}, 500);
				}
			});
		}
	});
});
/*END OF FUNCTION*/