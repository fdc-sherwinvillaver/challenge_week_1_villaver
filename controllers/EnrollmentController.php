<?php 
	require_once('../models/Enrollment.php');
	$enroll = new Enrollment;
	
	if(isset($_POST['action'])){

		$action = $_POST['action'];

		switch ($action) {	
			case 'enroll_participant':
				print $enroll->enroll_participant($_POST);
			break;
			case 'enroll_retaker':
				print $enroll->enroll_retaker($_POST);
			break;
			case 'participantscholarships':
				print json_encode($_POST);
			break;
		}
	}
 ?>