<?php 
	require_once('../models/User.php');

	if(isset($_POST['action'])){
		$user = new User;
		$action = $_POST['action'];
		switch ($action) {
			case 'new_user':
				print $user->new_user($_POST);
			break;
			case 'count_user':
				print $user->count_user();
			break;
			case 'validate_username':
				print $user->validate_username($_POST['username']);
			break;
			case 'edit_user':
				print $user->edit_user($_POST);
			break;
			case 'toggle_status':
				print $user->toggle_status($_POST['id']);
			break;
			case 'get_username':
				print $user->get_username($_POST['accountid']);
			break;
			case 'get_userdata':
				print json_encode($user->get_userdata($_POST['id']));
			break;
			case 'update_userprofile':
				print $user->update_userprofile($_POST);
			break;
			case 'count_active':
				print $user->count_active();
			break;
			case 'count_inactive':
				print $user->count_inactive();
			break;
			case 'count_superadmin':
				print $user->count_superadmin();
			break;
			case 'count_admin':
				print $user->count_admin();
			break;
			case 'get_count':
				print $user->get_count();
			break;
		}

	}
 ?>