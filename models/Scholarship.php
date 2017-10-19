<?php 
	require_once('DB.php');
	require_once('Batch.php');

	class Scholarship{

		public function new_scholarship($data){
			$db = db();
			$name		= $data['scholarshipname'];
			$discount 	= $data['discount'];
			$status 	= 1;
			$q 			= "INSERT INTO scholarships(scholarshipName, discount, status) VALUES ('$name','$discount','$status')";
			$res 		= mysqli_query($db, $q);
		}

		public function get_scholarships(){
			$db 		= db();
			$q 			= "SELECT * FROM scholarships";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_scholarships_ex_school(){
			$db 		= db();
			$q 	 		= "SELECT * FROM scholarshipS WHERE type != 4 AND status = 1";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_batch_scholarship_ex_school($batchid){
			$db 		= db();
			$q 			= "SELECT t1.*, t2.* FROM batchscholarships t1 INNER JOIN scholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t1.batchid = '$batchid' AND t2.type != 4";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_scholarships_by_school(){
			$db 		= db();
			$q 			= "SELECT * FROM scholarships WHERE type = 4 AND status = 1";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_batchscholarship($id, $batchid){
			$db 		= db();
			$q 			= "SELECT t1.*,t2.* FROM batchscholarships t1 INNER JOIN scholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t1.scholarshipid ='$id' AND batchid = '$batchid'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_batch_scholarships_by_school($batchid){
			$db 		= db();
			$q 			= "SELECT t1.*, t2.* FROM batchscholarships t1 INNER JOIN scholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t1.batchid = '$batchid' AND t2.type = 4 AND t1.status = 1";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_scholarship($id){
			$db 		= db();
			$q 			= "SELECT * FROM scholarships WHERE scholarshipid = '$id'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_batch_scholarship($id){
			$db 		= db();
			$q 			= "SELECT t1.*,t2.* FROM batchscholarships t1 INNER JOIN scholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE bscholarshipid = '$id'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_active_scholarships(){
			$db 		= db();
			$q 			= "SELECT * FROM scholarships WHERE status = 1";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function toggle_status($id){
			$db 		 = db();
			$q 			 = "SELECT status FROM scholarships WHERE scholarshipid = '$id'";
			$res 		 = mysqli_query($db, $q);
			$d 			 = mysqli_fetch_assoc($res);
			$status 	 = $d['status'];

			unset($q);
			unset($res);

			if($status == 0){
				$q 		 = "UPDATE scholarships SET status = '1' WHERE scholarshipid = '$id'";
				$res 	 = mysqli_query($db, $q);
			}else{
				$q 		 = "UPDATE scholarships SET status = '0' WHERE scholarshipid = '$id'";
				$res 	 = mysqli_query($db, $q);

				unset($q);
				unset($res);

				$batches 	 = new Batch();
				foreach ($batches->get_active_batches() as $batch) {
					$batchid = $batch['batchid'];
					$q = "UPDATE batchscholarships SET status = '0' WHERE scholarshipid = '$id' AND batchid = '$batchid'";
					$res 	= mysqli_query($db, $q);
				}
			}
		}

		public function get_scholarship_by_honors($id){
			$db 		= db();
			$q  	 	= "SELECT MAX(t2.bscholarshipid),t1.*,t2.* FROM scholarships t1 INNER JOIN batchscholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t2.batchid = '$id' AND t1.type = '1' AND t1.status = '1' AND t2.status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_scholarship_by_job($id){
			$db 		= db();
			$q  	 	= "SELECT MAX(t2.bscholarshipid),t1.*,t2.* FROM scholarships t1 INNER JOIN batchscholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t2.batchid = '$id' AND t1.type = '2' AND t1.status = '1' AND t2.status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_scholarship_by_program($program, $id){
			$db 		= db();
			$q  	 	= "SELECT MAX(t2.bscholarshipid),t1.*,t2.* FROM scholarships t1 INNER JOIN batchscholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t2.batchid = '$id' AND t1.value='$program' AND t1.type = '3' AND t1.status = '1' AND t2.status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_scholarship_by_school($school, $id){
			$db 		= db();
			$q  	 	= "SELECT MAX(t2.bscholarshipid),t1.*,t2.* FROM scholarships t1 INNER JOIN batchscholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t2.batchid = '$id' AND t1.value='$school' AND t1.type = '4' AND t1.status = '1' AND t2.status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_scholarship_by_second_course($id){
			$db 		= db();
			$q  	 	= "SELECT MAX(t2.bscholarshipid),t1.*,t2.* FROM scholarships t1 INNER JOIN batchscholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t2.batchid = '$id' AND t1.type = '5' AND t1.status = '1' AND t2.status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_scholarship_by_religion($religion, $id){
			$db 		= db();
			$q 			= "SELECT MAX(t2.bscholarshipid),t1.*,t2.* FROM scholarships t1 INNER JOIN batchscholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t2.batchid = '$id' AND t1.type='$religion' AND t1.type = '6' AND t1.status = '1' AND t2.status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d;
		}

		public function update_scholarship($data){
			$db = db();
			$id 		= $data['scholarshipid'];
			$sc_name 	= $data['scholarshipname'];
			$discount 	= $data['discount'];
			$q 			= "UPDATE scholarships SET scholarshipName = '$sc_name', discount = '$discount' WHERE scholarshipid = '$id'";
			$res 		= mysqli_query($db, $q);
		}

		public function new_school_scholarship($data){
			$db = db();
			$school 	= $data['schoolname'];
			$disc 		= $data['schooldiscount'];

			$q 			= "SELECT COUNT(*) as 'count' FROM scholarships WHERE type = '4' AND value = '$school' AND status = '0'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			$count 		= $d['count'];

			if($count == 0){
				$query 	= "INSERT INTO scholarships(scholarshipName,type,value,discount,status) VALUES('School discount', '4', '$school', '$disc', '1')";
				$result = mysqli_query($db, $query);
			}else{
				$query 	= "SELECT * FROM scholarships WHERE type = '4' AND value = '$school' AND status = '0'";
				$result = mysqli_query($db, $query);
				$datum 	= mysqli_fetch_assoc($result);
				$scholarshipid = $datum['scholarshipid'];

				unset($query);
				unset($result);

				$query 	= "UPDATE scholarships SET value = '$school', discount = '$disc', status = '1' WHERE scholarshipid = '$scholarshipid'";
				$result = mysqli_query($db, $query);
			}
			
		}

		public function validate_school($school){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM scholarships WHERE type = '4' AND value = '$school'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function validate_school_on_edit($id, $school){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM scholarships WHERE type = '4' AND value = '$school' AND scholarshipid != '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function edit_school_scholarship($data){
			$db = db();
			$value = $data['editschoolname'];
			$disc  = $data['editschooldiscount'];
			$id	   = $data['schooldisc_id'];
			$q = "UPDATE scholarships SET value = '$value', discount = '$disc' WHERE scholarshipid = '$id'";
			$res = mysqli_query($db, $q);
		}

		public function deactivate_disc($data){
			$db = db();
			$id = $data['remove_id'];
			$q 	= "UPDATE scholarships SET status = 0 WHERE scholarshipid = '$id'";
			$res = mysqli_query($db, $q);
		}

		public function get_count(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM scholarships";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_active(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM scholarships WHERE status = 1";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_inactive(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM scholarships WHERE status = 0";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}
	}
 ?>