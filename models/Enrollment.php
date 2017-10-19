<?php 
	require_once('DB.php');
	require_once('Batch.php');

	class Enrollment{
		public function countBatch(){
			$db 	= db();
			$q 		= "SELECT (SELECT (COUNT(*) + 1) AS count FROM batches) AS result1, (SELECT COUNT(*) FROM batches WHERE status = '2') AS result2, (SELECT COUNT(*) FROM batches WHERE status = '1') AS result3, (SELECT COUNT(*) FROM batches WHERE status = '0') AS result4";
			$res	= mysqli_query($db, $q);
			$data	= mysqli_fetch_assoc($res);
			return json_encode($data);
		}

		/*public function get_school_discount(){
			$db = db();
			$q = "SELECT * FROM scholarships WHERE type = '4'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return json_encode($d); 
		}*/

		public function checkAnyReservation(){
			$db 	= db();
			$q 		= "SELECT COUNT(*) AS 'count' FROM batches WHERE status = '2'";
			$res 	= mysqli_query($db, $q);
			$data 	= mysqli_fetch_assoc($res);
			return $data['count'];
		}

		public function checkAnyActive(){
			$db 	= db();
			$q 		= "SELECT COUNT(*) AS 'count' FROM batches WHERE status = '1'";
			$res 	= mysqli_query($db, $q);
			$data 	= mysqli_fetch_assoc($res);
			return $data['count'];
		}

		public function newBatch($data){
			$db 		= db();
			$datestamp 	= date("Y-m-d H:i:s");
			$batchno 	= $data['batchno'];
			$q 			= "INSERT INTO batches(status, batchno, datestamp) VALUES ('2', '$batchno', '$datestamp')";
			$res 		= mysqli_query($db, $q);
			$batchid 	= $db->insert_id;
			unset($q);
			unset($res);

			$satcapacity 	= $data['satcapacity'];
			$q 				= "INSERT INTO sections (section, capacity, batchid) VALUES ('Saturday', '$satcapacity', '$batchid')";
			$res			= mysqli_query($db, $q);
			unset($q);
			unset($res);

			$suncapacity 	= $data['suncapacity'];
			$q 				= "INSERT INTO sections (section, capacity, batchid) VALUES ('Sunday', '$suncapacity', '$batchid')";
			$res 			= mysqli_query($db, $q);
		}

		public function getBatch(){
			$db         = db();
            $q          = "SELECT * FROM batches ORDER BY datestamp DESC";
            $res        = mysqli_query($db, $q);
            $batches    = mysqli_fetch_all($res, MYSQLI_ASSOC);
            return $batches;
		}

		public function checkSaturday($batchid){
			$db 		= db();
			$q 			= "SELECT section as 'sat' FROM sections WHERE batchid = '$batchid' AND section = 'Saturday'";
			$res 		= mysqli_query($db, $q);
			$q 			= mysqli_fetch_assoc($res);
			return $q;
		}

		public function getSaturday($batchid){
			$db 		= db();
			$q 			= "SELECT sectionid, capacity FROM sections WHERE batchid = '$batchid' AND section = 'Saturday'";
			$res 		= mysqli_query($db, $q);
			$data 		= mysqli_fetch_assoc($res);
			return $data;
		}

		public function getSunday($batchid){
			$db 		= db();
			$q 			= "SELECT sectionid, capacity FROM sections WHERE batchid = '$batchid' AND section = 'Sunday'";
			$res 		= mysqli_query($db, $q);
			$data 		= mysqli_fetch_assoc($res);
			return $data;
		}

		public function getCurrentCapacity($sectionid){
			$db 		= db();
			$q 			= "SELECT COUNT(*) as 'count' FROM sectionparticipants WHERE sectionid = '$sectionid'";
			$res 		= mysqli_query($db, $q);
			$current 	= mysqli_fetch_assoc($res);

			unset($q);
			unset($res);

			$q 			= "SELECT * FROM sections WHERE sectionid = '$sectionid'";
			$res 		= mysqli_query($db, $q);
			$total 		= mysqli_fetch_assoc($res);

			if ($total['status'] == '0') {
				return "N/A ";
			}else{
				return $current['count']." out of ".$total['capacity'];
			}
		}

		public function setAsOngoing($data){
			$batchid	= $data['batchid'];
			$db 		= db();
			$q 			= "UPDATE batches SET status = '1' WHERE batchid='$batchid'";
			$res 		= mysqli_query($db, $q);
		}

		public function enroll_participant($data){
			$db 			= db();
			$sectionid 		= $data['section'];
			$participantid 	= $this->create_participant($data);
			$q 				= "INSERT INTO sectionparticipants(sectionid, participantid) VALUES('$sectionid','$participantid')";
			$res 			= mysqli_query($db, $q);
			$secparticipantid = $db->insert_id;
			$payable 		= $data['totalpayment'];
			$payments 		= $data['payments'];

			$batch = new Batch;
			$batchid = $batch->get_batch_by_section_id($sectionid)['batchid'];
			$this->set_participant_payments($payable, $secparticipantid, $batchid);
			if(isset($data['scholarships'])){
				$scholarships 	= $data['scholarships'];
				return $this->set_participant_scholarships($scholarships, $secparticipantid);
			}
		}

		public function set_participant_payments($payable, $id, $batchid){
			$db 			= db();
			$batch 			= new Batch;
			$psched 		= $batch->get_paymentschedule_by_batchid($batchid);
			for ($i=1; $i < 4; $i++) {
				$due_date = $psched['date'.$i];
				$q 		  = "INSERT INTO participantpayments(sectionparticipantid, amount, due_date, status) VALUES ('$id', '$payable', '$due_date', '1')";
				$res 	  = mysqli_query($db, $q);
			}
		}

		public function set_participant_scholarships($scholarships, $id){
			$db 			= db();
			$length 		= sizeof($scholarships);
			for ($i=0; $i < $length; $i++) { 
				$scholarshipid = $scholarships[$i];
				$query 	= "SELECT * FROM scholarships WHERE scholarshipid = '$scholarshipid'";
				$result = mysqli_query($db, $query);
				$data   = mysqli_fetch_assoc($result);
				$name = $data['scholarshipName'];
				$disc = $data['discount'];
				$q 	= "INSERT INTO participantscholarships(sectionparticipantid, scholarship, discount, status) VALUES ('$id', '$name', '$disc', '1')";
				$res = mysqli_query($db, $q);
			}
		}

		public function create_participant($data){
			$db 		= db();
			$secCourse 	= $data['secCourse'];
			$isEmployed = $data['isEmployed'];
			$religion 	= $data['religion'];
			$cstatus 	= $data['cstatus'];
			$datestamp 	= date("Y-m-d H:i:s");

			$personid 	= $this->create_person($data);
			$participantno = $data['participantno'];
			$edu 	 	= $this->create_education($data);
			$sec 		= $this->create_sec_course($data);
			$job 		= $this->create_job($data);

			$q 			= "INSERT INTO participants(participantno, personid, educationid, seccourse_status, seccourseid, job_status, jobid, religion, civilstatus, datestamp, status) VALUES ('$participantno','$personid','$edu', '$secCourse', '$sec', '$isEmployed', '$job','$religion','$cstatus','$datestamp', '1')";
			$res 		= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function create_person($data){
			$db = db();

			$firstname 	= $data['firstname'];
			$middlename = $data['middlename'];
			$lastname 	= $data['lastname'];
			$gender 	= $data['gender'];
			$birthdate 	= $data['birthdate'];
			$age 		= date_diff(date_create($data['birthdate']), date_create('today'))->y;
			$email 		= $data['email'];
			$facebook 	= $data['facebook'];
			$phone 		= $data['phone'];
			$barangay   = $data['barangay'];
			$city		= $data['city'];
			$province 	= $data['province'];
			$photo 		= $data['image'];
			$q  		= "INSERT INTO person(firstname, middlename, lastname, gender, birthdate, age, email, facebook, phone, barangay, city, province, photo) VALUES ('$firstname','$middlename', '$lastname', '$gender', '$birthdate', '$age', '$email', '$facebook', '$phone', '$barangay', '$city', '$province', '$photo')";
			$res 		= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function create_education($data){
			$db 		= db();
			$program 	= $data['program'];
			$major 	 	= $data['major'];
			$semGraduate = $data['semgrad'];
			$yearGraduate = $data['yrgrad'];
			$school 	= $data['school'];
			$honors 	= $data['honors'];
			$q 			= "INSERT INTO education(program, major, semGraduate, yearGraduate, school, honors) VALUES('$program','$major','$semGraduate','$yearGraduate','$school','$honors')";
			$res 		= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function create_sec_course($data){
			$db 	 	= db();
			$secondprogram = $data['sec'];
			$secondschool = $data['secschool'];

			$q 		= "INSERT INTO secondcourses(secondprogram, secondschool) VALUES ('$secondprogram', '$secondschool')";
			$res 	= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function create_job($data){
			$db = db();
			$position = $data['position'];
			$company = $data['company'];

			$q 		= "INSERT INTO jobs(position, company) VALUES ('$position','$company')";
			$res 	= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function enroll_retaker($data){
			$db = db();
			$section = $data['section'];
			$p_id 	= $data['id'];
			$q 		= "INSERT INTO sectionparticipants(sectionid, participantid) VALUES ('$section','$p_id')";
			$res 	= mysqli_query($db, $q);
			$secparticipantid = $db->insert_id;
			$payments 		= $data['payments'];
			$scholarships 	= $data['scholarships'];
			$payable 		= $data['totalpayment'];

			$batch = new Batch;
			$batchid = $batch->get_batch_by_section_id($section)['batchid'];
			$this->set_participant_payments($payable, $secparticipantid, $batchid);
			$this->set_participant_scholarships($scholarships, $secparticipantid);

			$query = "UPDATE participants SET status = '1' WHERE participantid = '$p_id'";
			$result = mysqli_query($db, $query);
		}
	}
 ?>