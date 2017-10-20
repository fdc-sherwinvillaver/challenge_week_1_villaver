<?php
 	require_once('../models/Participant.php');
 	$participant = new Participant;

	if(isset($_POST['action'])){
		$action = $_POST['action'];

		switch ($action) {
			case 'count_batch':
				print $participant->countBatch();
			break;
			case 'enroll_participant':
				print $participant->enroll_participant($_POST);
			break;
			case 'get_payables_by_batchid':
				print $participant->get_payables_by_batchid($_POST['batchid']);
			break;
			case 'get_payable':
				print $participant->get_payable($_POST['payableid']);
			break;
			case 'get_total_payables':
				print $participant->get_total_payables($_POST['batchid']);
			break;
			case 'get_student_data':
				print json_encode($participant->get_student_data($_POST['studentid']));
			break;
			case 'participant_no':
				print $participant->participant_no();
			break;
			case 'count_active':
				print $participant->count_active();
			break;
			case 'count_inactive':
				print $participant->count_inactive();
			break;
			case 'get_count':
				print $participant->participant_no() - 1;
			break;
		}
	}
 ?>