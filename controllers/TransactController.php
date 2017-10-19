<?php 
	require_once('../models/Transact.php');

	if(isset($_POST['action'])){
		$action = $_POST['action'];
		$transact = new Transact;

		switch ($action) {
			case 'get_participant_data':
				print json_encode($transact->get_participant_data());
				break;
			case 'get_participant_nos':
				print json_encode($transact->get_participant_nos());
				break;
			case 'get_particpant':
				print json_encode($transact->get_particpant($_POST['identifier']));
				break;
		}
	}
 ?>