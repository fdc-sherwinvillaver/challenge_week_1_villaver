<?php 
	require_once('DB.php');

	class Transact{

		public function get_participant_data(){
			$db = db();
			$q = "SELECT t1.*,t2.*,t3.* FROM sectionparticipants t1 INNER JOIN participants t2 on t1.participantid=t2.participantid INNER JOIN person t3 ON t2.personid=t3.personid";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_participant_nos(){
			$db = db();
			$q = "SELECT participantno FROM participants";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_particpant($identifier){
			$db = db();
			if($this->count_participantno_result($identifier) == 0){
				return 0;
			}else{
				$q = "SELECT * FROM participants WHERE participantno = '$identifier'";
				$res = mysqli_query($db, $q);
				$d = mysqli_fetch_assoc($res);
				return $d;
			}
		}

		public function count_participantno_result($identifier){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM participants WHERE participantno = '$identifier'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}
	}
 ?>