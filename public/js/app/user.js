$(document).ready(function(){

	$('#frmnewuser').on('submit', function(event){
		event.preventDefault();
		var str = $('#frmnewuser').serialize();
		if($('#username').val() == '' ||  (typeof $('#accesslevel').val() == 'object')){
			toastr.warning('Please fill in all the fields');
		}else{
			$.ajax({
				type: 'POST',
				url: 'controllers/UserController.php',
				data: {
					'username': $('#username').val(),
					'action': 'validate_username'
				},
				success: function(e){
					if(e == 1){
						toastr.warning('Username not available');
					}else{
						$.ajax({
							type: 'POST',
							url: 'controllers/UserController.php',
							data: str,
							success: function(e){
								toastr.success('User successfully created');
								setTimeout(function() { 
									window.location = 'users.php'; 
								}, 500);
							}
						});
					}
				}
			});
		}
	});

	$('#frmedituser').on('submit', function(event){
		event.preventDefault();
		var images = $('#aimg img').attr('src');
		var str = $('#frmedituser').serialize()+'&=image'+images;

		if($('#firstname').val() == "" || $('#lastname').val() == "" || $('#password').val() == "" || $('#confirmpassword').val() == ""){
			toastr.warning('Please fill in all the fields');
		}else if($('#password').val().length < 8){
			toastr.warning('Password must be at least 8 characters long');
		}else if($("#password").val() != $('#confirmpassword').val()){
			toastr.warning('Passwords do not match');
		}else{
			$.ajax({
				type: 'POST',
				url: 'controllers/UserController.php',
				data: {
					'username': $('#username').val(),
					'accountid': accountid,
					'action': 'validate_username_except_owner'
				},
				success: function(e){
					if(e == 1){
						toastr.warning('Username not available');
					}else{
						$.ajax({
							type: 'POST',
							url: 'controllers/UserController.php',
							data: str,
							success: function(e){
								$.ajax({
									type: 'POST',
									url: 'set_session.php',
									data: { 
										status: '1',
									},
									success: function(e){
										toastr.success('Profile successfully updated');
										setTimeout(function() { 
											window.location = 'index.php'; 
										}, 500);
									}
								});
							}
						});
					}
				}
			});
		}
	});
});

function togglestatus(id){
	$.ajax({
		type: 'POST',
		url: 'controllers/UserController.php',
		data: {
			'id': id,
			'action': 'toggle_status'
		},
		success: function(e){
			refresh_categories();
		}
	});
}

function refresh_categories(){
	$.ajax({
		type: 'POST',
		url: 'controllers/UserController.php',
		data: {
			'action': 'count_superadmin'
		},
		success: function(e){
			document.getElementById('countsuperadmin').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/UserController.php',
		data: {
			'action': 'count_admin'
		},
		success: function(e){
			document.getElementById('countadmin').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/UserController.php',
		data: {
			'action': 'count_active'
		},
		success: function(e){
			document.getElementById('countactive').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/UserController.php',
		data: {
			'action': 'count_inactive'
		},
		success: function(e){
			document.getElementById('countinactive').innerHTML = e;
		}
	});

	$.ajax({
		type: 'POST',
		url: 'controllers/UserController.php',
		data: {
			'action': 'get_count'
		},
		success: function(e){
			document.getElementById('count').innerHTML = e;
		}
	});
}