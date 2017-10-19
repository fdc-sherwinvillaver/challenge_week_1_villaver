<?php 
	require_once('../models/Reservation.php');

	if(isset($_POST['action'])){
		$action = $_POST['action'];
		$reserv = new Reservation;

		switch ($action) {
			case 'get_affiliations':
				print json_encode($reserv->get_affiliations());
			break;
			case 'reserve':
				$activity = $_POST['activity'];
				$affname = $_POST['affname'];
				$date = $_POST['reservdate_submit'];
				$starttime = $_POST['starttime'].":00";
				$endtime = $_POST['endtime'].":00";
				
				$datastarttime = $date." ".$starttime;
				$dateendtime = $date." ".$endtime;
				if($datastarttime > $dateendtime){
					print "TIME ERROR";
				}else{
					print $reserv->reserve($activity, $affname, $date, $starttime, $endtime);
					// print "SUCCESS";
				}
			break;
			case 'get_reservations':
				print json_encode($reserv->get_reservations());
			break;
			case 'validate_affiliation':
				print $reserv->validate_affiliation($_POST['aff']);
			break;
		}
	}
 ?>