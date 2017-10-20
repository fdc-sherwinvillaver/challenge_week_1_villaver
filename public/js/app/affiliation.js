$(document).ready(function(){
	var counter = 0;
	$("#frmnewaffiliation").on('submit', function(event){
			event.preventDefault();
			var str = $('#frmnewaffiliation').serialize();

			if($('#firstname').val() == '' || $('#lastname').val() == '' || $('#phone').val() == '' ||  $('#affname').val() == ''){
				toastr.warning('Please fill in all the fields');
			}else{
				if (counter == 0) {
					$.ajax({
						type: 'POST',
						url: 'controllers/AffiliationController.php',
						data: {
							'affname': $('#affname').val(),
							'action': 'validate_affiliation'
						},
						success: function(e){
							var count = e;
							if(count != 0){
								toastr.warning('Affiliation already exists');
							}else{
								$.ajax({
									type: 'POST',
									url: 'controllers/AffiliationController.php',
									data: str,
									success: function(e){
										toastr.success('Affiliation successfully created');
										setTimeout(function() { 
											window.location = 'payments.php'; 
										}, 500);
									}
								});
								counter++;
							}
						}
					});
				}
			}
		});
});

function togglestatus(id){
	$.ajax({
		type: 'POST',
		url: 'controllers/AffiliationController.php',
		data: {
			'id': id,
			'action': 'toggle_status'
		}
	});
}