$(document).ready(function(){
	$('#frmupdate_userprofile').on('submit', function(event){
		var str = $('#frmupdate_userprofile').serialize();
		event.preventDefault();

		if($('#firstname').val() == "" || $('#lastname').val() == ""){
			toastr.warning('Please fill in all the fields');
		}else{
			$.ajax({
				type: 'POST',
				url: 'controllers/UserController.php',
				data: str,
				success: function(e){
					toastr.success('Profile successfully updated');
					setTimeout(function() { 
						window.location = 'index.php'; 
					}, 500);
				}
			});
		}
	});

});