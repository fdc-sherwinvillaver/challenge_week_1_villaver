<?php 
	require_once('../models/Scholarship.php');

	if(isset($_POST['action'])){
		$action = $_POST['action'];
		$scholarship = new Scholarship;

		switch ($action) {
			case 'new_scholarship':
				print $scholarship->new_scholarship($_POST);
			break;
			case 'toggle_status':
				print $scholarship->toggle_status($_POST['id']);
			break;
			case 'get_scholarship':
				print json_encode($scholarship->get_scholarship($_POST['id']));
			break;
			case 'update_scholarship':
				print $scholarship->update_scholarship($_POST);
			break;
			case 'new_school_scholarship':
				print $scholarship->new_school_scholarship($_POST);
			break;
			case 'validate_school':
				print $scholarship->validate_school($_POST['school']);
			break;
			case 'validate_school_on_edit':
				print $scholarship->validate_school_on_edit($_POST['id'], $_POST['school']);
			break;
			case 'edit_school_scholarship':
				print $scholarship->edit_school_scholarship($_POST);
			break;
			case 'deactivate_disc':
				print $scholarship->deactivate_disc($_POST);
			break;
			case 'get_batchscholarship':
				print json_encode($scholarship->get_batchscholarship($_POST['id'], $_POST['batchid']));
			break;
			case 'update_scholarship':
				print $scholarship->update_scholarship($_POST);
			break;
			case 'get_count':
				print $scholarship->get_count();
			break;
			case 'count_active':
				print $scholarship->count_active();
			break;
			case 'count_inactive':
				print $scholarship->count_inactive();
			break;
		}
	}
 ?>