<?php 
	require_once('../models/Affiliation.php');

	if(isset($_POST['action'])){
		$action = $_POST['action'];
		$aff = new Affiliation;

		switch ($action) {
			case 'newaffiliation':
				print $aff->new_affiliation($_POST);
				break;
			case 'validate_affiliation':
				print $aff->validate_affiliation($_POST['affname']);
				break;
			case 'toggle_status':
				print $aff->toggle_status($_POST['id']);
				break;
		}
	}
 ?>