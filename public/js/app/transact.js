$(document).ready(function(){

	var participants = new Array();
	$(".mdb-select li").on('click', function(){
		/*toastr.warning($(this).prevAll().length);*/
		$("#identification").css('display', 'none');
		if($(this).prevAll().length == 0){

		}
		else if($(this).prevAll().length == 1){
			document.getElementById('lbidentification').innerHTML = "Participant No";

			$.ajax({
				type: 'POST',
				url: 'controllers/TransactController.php',
				data: {
					'action': 'get_participant_nos'
				},
				success: function(e){
					var d = JSON.parse(e);
					for (var i = 0; i < d.length; i++) {
						participants.push(d[i]['participantno']);
					}
					$('.mdb-autocomplete').mdb_autocomplete({
					    data: participants
					});
				}
			});
			$('#div-id').slideDown('fast');
		}else if($(this).prevAll().length == 2){
			document.getElementById('lbidentification').innerHTML = "Affiliation Name";

			$.ajax({
				type: 'POST',
				url: 'controllers/TransactController.php',
				data: {
					'action': 'get_affiliations'
				},
				success: function(e){
						
				}
			});
			$('#div-id').slideDown('fast');
		}
	});/*END OF FUNCTION*/

	$('#btnget').on('click', function(){
		if($('#payer').val() == 1){
			$.ajax({
				type: 'POST',
				url: 'controllers/TransactController.php',
				data: {
					'identifier': $('#txtidentification').val(),
					'action': 'get_particpant'
				},
				success: function(e){
					console.log(e);
					/*if(e == 0){
						toastr.warning('Cannot find participant');
					}else{
						toastr.success('Participant found');
					}*/
				}
			});
			
		}else if($('#payer').val() == 2){
			
		}
	});
});