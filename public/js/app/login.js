$(document).ready(function(){
	$('#btnsubmit').one('click', function(){
		$('form').on('submit', function(event){
			var str = $('form').serialize();
			event.preventDefault();
			if($('#username').val() == '' || $('#password').val() == ''){
				toastr.warning('Please enter your username and password');
			}else{
				$.ajax({
					type: 'POST',
					url: 'controllers/LoginController.php',
					data: str,
					success: function(e){
						var data 	= JSON.parse(e);
						var id 		= data['accountid'];
						var count 	= data['count'];
						var status 	= data['status'];
						var accesslvl = data['accesslevel'];
						console.log(data);
						switch(count){
						    case '0':
						        toastr.error('Account not found');
						        break;
						    case '1':
						    	if(status == 2){
										toastr.error('Account deactivated');
									}else{
										$.ajax({
											type: 'POST',
											url: 'set_session.php',
											data: { 
												id: id,
												status: status,
												accesslvl: accesslvl
											},
											success: function(e){
												window.location = "index.php";
											}
										});
									}
						        break;
						}
					}
				});
			}
		})
	}); /*END OF FUNCTION*/

	function eventFire(el, etype){
	  if (el.fireEvent) {
	    el.fireEvent('on' + etype);
	  } else {
	    var evObj = document.createEvent('Events');
	    evObj.initEvent(etype, true, false);
	    el.dispatchEvent(evObj);
	  }
	}/*END OF FUCNTION*/

	function runScript(e) {
	    if (e.keyCode == 13) {
	        eventFire(document.getElementById('btnsubmit'), 'click');
	    }
	}

});