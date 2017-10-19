$(document).ready(function(){
	var schools = new Array();
	refresh_categories();

	$('#school').bind('input', function() { 
	    $('#schooldisc').remove();
	});


	$.ajax({
		type: 'POST',
		url: 'controllers/ParticipantController.php',
		data: {
			'action': 'count_batch'
		},
		success: function(e){
			var count = e;
			if(count == '0'){
				$('#modal').modal({
				  backdrop: 'static',
				  keyboard: false
				}, 'show');
			}else{
				$('#aimg').tooltip().mouseover();
			}
		}
	});
	/*END OF FUNCTION*/

	$.ajax({
		type: 'POST',
		url: 'controllers/ParticipantController.php',
		data: {
			'action': 'participant_no'
		},
		success: function(e){
			if(e.length == 1){
				$('#participantno').val("P-000"+e);
			}else if(e.length == 2){
				$('#participantno').val("P-00"+e);
			}else if(e.length == 3){
				$('#participantno').val("P-0"+e);
			}
		}
	});

	$('#secCourse').on('click', function(){
		$('.edu').slideToggle();
		if(document.getElementById('secCourse').checked){
			$('#seccourse_status').val('1');
		}else{
			$('#seccourse_status').val('0');
		}
	});
	/*END OF FUNCTION*/

	$('#isEmployed').on('click', function(){
		$('.job').slideToggle();
		if(document.getElementById('isEmployed').checked){
			$('#job_status').val('1');
		}else{
			$('#job_status').val('0');
		}
	});
	/*END OF FUNCTION*/

	$('#btnmodal').on('click', function(){
		window.location = "batches.php";
	});
	/*END OF FUNCTION*/

	$('form').on('submit', function(event){
		var images = $('#aimg img').attr('src');

		if($('#firstname').val() == "" || $('#lastname').val() == "" || (typeof $("#gender").val() == "object") || $('#bdate').val() == "" || $('#religion').val() == "" || (typeof $('#civilstatus').val() == "object") || $('#barangay').val() == "" || $('#city').val() == "" || $('#province').val() == "" || $('#phone').val() == "" || $('#email').val()== "" || $('#facebook').val() == "" || (typeof $('#program').val() == "object") || $('#major').val() == "" || $('#semesterGraduated').val() == "" || $('#yearGraduated').val() == "" || $('#school').val() == ""){
			toastr.warning('Please fill in all the fields');
			return false;
		}else if(document.getElementById('secCourse').checked && ($('#secondprogram').val() == "" || $('#secondschool').val() == "")){
			toastr.warning('Please fill in all the fields');
			return false;
		}else if(document.getElementById('isEmployed').checked && ($('#position').val() == "" || $('#company').val() == "")){
			toastr.warning('Please fill in all the fields');
			return false;
		}else if($('#section').val() == ''){
			toastr.warning('Please select a section');
			return false;
		}
	});
});

function refresh_categories(){
	$.ajax({
		type: 'POST',
		url: 'controllers/ParticipantController.php',
		data: {
			'action': 'count_active'
		},
		success: function(e){
			document.getElementById('countactive').innerHTML = e;
		}
	});
	
	$.ajax({
		type: 'POST',
		url: 'controllers/ParticipantController.php',
		data: {
			'action': 'count_inactive'
		},
		success: function(e){
			document.getElementById('countinactive').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/ParticipantController.php',
		data: {
			'action': 'get_count'
		},
		success: function(e){
			document.getElementById('count').innerHTML = e;
		}
	});
}