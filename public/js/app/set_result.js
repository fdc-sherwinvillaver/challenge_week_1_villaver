var results = new Array();

$(document).ready(function(){
	$('#btnsubmitresult').on('click', function(){
		$.ajax({
			type: 'POST',
			url: 'controllers/BatchController.php',
			data: {
				'batchid': batchid,
				'action': 'count_enrolled_paticipants_per_batch',
			},
			success: function(e){
				var count = e;
				if(results.length != count){
					toastr.warning('Please set results for all participants');
				}else{
					$.ajax({
						type: 'POST',
						url: 'controllers/BatchController.php',
						data: {
							'results': results,
							'sat': sat,
							'sun': sun,
							'action': 'set_result'
						},
						success: function(e){
							toastr.success('Results successfully set');
								setTimeout(function() { 
									window.location = "batches.php"; 
								}, 500);
						}
					});
				}
			}
		});
	});
});

function setresult(participantid, result){
	if(result == 2){
		if(results.indexOf('1'+participantid) != -1){
			results.splice(results.indexOf('1'+participantid), 1);
		}
		
		if(results.indexOf('2'+participantid) == -1){
			results.push('2'+participantid);
		}
	}else if(result == 1){
		if(results.indexOf('2'+participantid) != -1){
			results.splice(results.indexOf('2'+participantid), 1);
		}
		
		if(results.indexOf('1'+participantid) == -1){
			results.push('1'+participantid);
		}
	}
	console.log(results);
}