<?php 
	require_once('DB.php');

	class Reservation{

		public function get_affiliations(){
			$db = db();
			$q = "SELECT affiliationname FROM affiliations";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}
		
		public function reserve($activty, $aff, $date, $start, $end){
			$db = db();
			$q1 = "SELECT * FROM reservations WHERE reservationdate = '$date'";
			$res1 = mysqli_query($db, $q1);
			$d = mysqli_num_rows($res1);
			if($d == 2){
				return json_encode(array('message' => 'failed','count' => $d));
			}
			else{
				$q = "INSERT INTO reservations (activity, affiliationname, reservationdate, timestart, timeend) VALUES ('$activty','$aff','$date','$start','$end')";
				$res = mysqli_query($db, $q);
				return json_encode(array('message' => 'success'));
			}
		}

		public function get_reservations(){
			$db = db();
			$q = "SELECT activity as 'title', CONCAT(reservationdate,'T',timestart) as 'start', CONCAT(reservationdate,'T',timeend) as 'end', CONCAT('reservation.php?id=',reservationid) as 'url',reservationdate FROM reservations";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function validate_affiliation($aff){
			$db = db();
			$q  = "SELECT COUNT(*) as 'count' FROM affiliations WHERE affiliationname = '$aff'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}
	}
 ?>