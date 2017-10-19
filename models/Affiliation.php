<?php 
	require_once('DB.php');

	class Affiliation{

		public function new_affiliation($data){
			$db = db();
			$affname 	= $data['affname'];
			
			$personid = $this->create_person($data);
			$q 	= "INSERT INTO affiliations(affiliationname, personid, status) VALUES('$affname','$personid', '1')";
			$res = mysqli_query($db, $q);
		}

		public function create_person($data){
			$db = db();
			$firstname 	= $data['firstname'];
			$middlename = $data['middlename'];
			$lastname 	= $data['lastname'];
			$phone 		= $data['phone'];
			$facebook 	= $data['facebook'];
			$email 		= $data['email'];

			$q = "INSERT INTO person(firstname, middlename, lastname, email, facebook, phone) VALUES ('$firstname','$middlename','$lastname','$email','$facebook','$phone')";
			$res = mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function validate_affiliation($affiliation){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM affiliations WHERE affiliationname = '$affiliation'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_affiliations(){
			$db = db();
			$q = "SELECT t1.*,t2.* FROM affiliations t1 INNER JOIN person t2 ON t1.personid = t2.personid";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_affiliation($id){
			$db = db();
			$q = "SELECT t1.*, t2.* FROM affiliations t1 INNER JOIN person t2 ON t1.personid = t2.personid WHERE t1.affiliationid = '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d;
		}

		public function toggle_status($id){
			$db 		 = db();
			$q 			 = "SELECT status FROM affiliations WHERE affiliationid = '$id'";
			$res 		 = mysqli_query($db, $q);
			$d 			 = mysqli_fetch_assoc($res);
			$status 	 = $d['status'];

			unset($q);
			unset($res);

			if($status == 0){
				$q 		 = "UPDATE affiliations SET status = '1' WHERE affiliationid = '$id'";
				$res 	 = mysqli_query($db, $q);
			}else{
				$q 		 = "UPDATE affiliations SET status = '0' WHERE affiliationid = '$id'";
				$res 	 = mysqli_query($db, $q);
			}
		}
	}
 ?>