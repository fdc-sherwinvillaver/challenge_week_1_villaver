$(document).ready(function(){
	var counter = 0;
	var affiliations = new Array();

	$.ajax({
		type: 'POST',
		url: 'controllers/ReservationController.php',
		data: {
			'action': 'get_affiliations'
		},
		success: function(e){
			var data = JSON.parse(e);

			for (var i = 0; i < data.length; i++) {
				affiliations.push(data[i]['affiliationname']);
			}

			$('#affname').mdb_autocomplete({
			    data: affiliations
			});
		}
	});

	$('#frmnewreservation').on('submit', function(event){
		event.preventDefault();
		var str = $('#frmnewreservation').serialize();
		if($('#activity').val() == '' || $('#affname').val() == '' || $('#reservdate').val() == '' || $('#starttime').val() == '' || $('#endtime').val() == ''){
			toastr.warning("Please fill in all the fields");
		}else{
			$.ajax({
				type: 'POST',
				url: 'controllers/ReservationController.php',
				data: {
					'aff': $('#affname').val(),
					'action': 'validate_affiliation'
				}, success: function(e){
					var count = e;
					if(count == 0){
						toastr.warning('Affiliation is not registered');
					}else{
						$.ajax({
							type: 'POST',
							url: 'controllers/ReservationController.php',
							data: str,
							success: function(e){
								// console.log(e);
								var json = JSON.parse(e);

								if(e == "TIME ERROR"){
									toastr.warning('Set starting time and ending time properly');
								}else if(json.message == "success"){
									toastr.success("Reservation successfully set");
									setTimeout(function() { 
										window.location = 'reservations.php'; 
									}, 500);
								}
								else if(json.message == "failed"){
									toastr.error('Reservation on this day is full');
								}
							}
						});
					}
				}
			});
		}
	});
});