<?php 
	require_once('DB.php');

	class Participant{
		public function getSections(){
			$db 		= db();
			$q 			= "SELECT t1.sectionid, t1.section, t2.batchno,t2.status, t2.dateStart, t2.dateEnd FROM sections t1 INNER JOIN batches t2 ON t1.batchid = t2.batchid WHERE t2.status = '2' OR t2.status = '1' AND t1.status = '1'";
			$res 		= mysqli_query($db, $q);
			$data    	= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $data;
		}

		public function getBatches(){
			$db 		= db();
			$q 			= "SELECT * FROM batches WHERE status = '1' OR status = '2'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_sections_by_batchid($batchid){
			$db 		= db();
			$q 			= "SELECT * FROM sections WHERE batchid = '$batchid' AND status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function countBatch(){
			$db 		= db();
			$q 			= "SELECT COUNT(*) as 'count' FROM batches";
			$res 		= mysqli_query($db, $q);
			$data		= mysqli_fetch_assoc($res);
			return $data['count'];
		}

		public function get_payment_schedules($id){
			$db 		= db();
			$q 			= "SELECT * from paymentschedules WHERE batchid = '$id'";
			$res 		= mysqli_query($db, $q);
			$q 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $q;
		}

		public function create_person($data){
			$db 		= db();
			$firstname 	= $data['firstname'];
			$middlename = $data['middlename'];
			$lastname 	= $data['lastname'];
			$gender 	= $data['gender'];
			$birthdate 	= $data['birthdate'];

			$q 			= "INSERT INTO person (firstname, middlename, lastname, gender, birthdate,) VALUES ('$firstname', '$middlename', '$lastname', '$gender', '$birthdate')";
			$res 		= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function set_education($data){
			$db 			= db();
			$program 		= $data['program'];
			$major 			= $data['major'];
			$semGraduate 	= $data['semesterGraduated'];
			$yearGraduate 	= $data['yearGraduated'];
			$school 		= $data['school'];
			$honors 		= $data['honors'];

			$q 				= "INSERT INTO education (program, major, semGraduate, yearGraduate, school, honors) VALUES ('$program', '$major', '$semGraduate', '$yearGraduate', '$school' , '$honors')";
			$res 			= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function set_second_course($data){
			$db 			= db();
			$secondprogram 	= $data['sec'];
			$secondschool  	= $data['secondschool'];

			$q 				= "INSERT INTO secondcourses (secondprogram, secondschool) VALUES ('$secondprogram', '$secondschool')";
			$res 			= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function set_job($data){
			$db 			= db();
			$position 		= $data['position'];
			$company		= $data['company'];
			$serviceStart 	= $data['serviceStart'];
			$serviceEnd 	= $data['serviceEnd'];
			$expertise 		= $data['expertise'];

			$q 				= "INSERT INTO jobs (position, company, serviceStart, serviceEnd, expertise) VALUES ('$position','$company','$serviceStart','$serviceEnd','$expertise')";
			$res 			= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function new_participant($data){
			$personid		= $this->create_person($data);
			$educationid 	= $this->set_education($data);
			$seccourseid 	= "";
			$jobid 			= "";

			if($data['isEmployed'] == 'on'){
				$jobid 		= $this->set_job($data);
			}

			if($data['secCourse'] == 'on'){
				$seccourseid = $this->set_second_course($data);
			}

			$db 			= db();
			$participantno  = $data['participantno'];
			$religion 		= $data['religion'];
			$civilstatus 	= $data['civilstatus'];
			$datestamp 		= date("Y-m-d H:i:s");

			$q 				= "INSERT INTO participants (participantno, personid, educationid, seccourseid, jobid, religion, civilstatus, datestamp) VALUES('$participantno', '$personid','$educationid','$seccourseid','$jobid','$religion','$civilstatus', '$datestamp')";
			$res 			= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function enroll_participant($data){
			$db 			= db();
			$participantid 	= $this->new_participant($data);
			$sectionid 		= $data['section'];
			$q 				= "INSERT INTO sectionparticipants (sectionid, participantid) VALUES ('$sectionid','$participantid')";
			$res 			= mysqli_query($db, $q);
		}

		public function get_batch_by_sectionid($id){
			$db 			= db();
			$q 				= "SELECT batchid from sections WHERE sectionid = '$id'";
			$res 			= mysqli_query($db, $q);
			$d 				= mysqli_fetch_assoc($res);
			return $d['batchid'];
		}

		public function get_payables_by_batchid($id){
			$db 			= db();
			$q  			= "SELECT * FROM payables WHERE batchid = '$id'";
			$res 			= mysqli_query($db, $q);
			$d 				= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_payable($id){
			$db 			= db();
			$q 				= "SELECT * FROM payments WHERE paymentid = '$id'";
			$res 			= mysqli_query($db, $q);
			$q 				= mysqli_fetch_assoc($res);
			return $q;
		}

		public function get_total_payables($id){
			$db 			= db();
			$q 				= "SELECT SUM(t1.amount) as 'total' FROM payments t1 INNER JOIN payables t2 ON t1.paymentid=t2.paymentid WHERE t2.batchid = '$id'";
			$res 			= mysqli_query($db, $q);
			$q 				= mysqli_fetch_assoc($res);
			return $q['total'];
		}

		public function get_participants(){
			$db 			= db();
			$q 				= "SELECT t1.*,t2.*,t3.*,t4.* FROM participants t1 INNER JOIN person t2 ON t1.personid=t2.personid INNER JOIN education t3 ON t1.educationid=t3.educationid INNER JOIN jobs t4 ON t1.jobid=t4.jobid";
			$res 			= mysqli_query($db, $q);
			$d 				= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_student_data($id){
			$db 	= db();
			$q 		= "SELECT t1.*,t2.*,t3.*,t4.*,t5.* FROM participants t1 INNER JOIN person t2 ON t1.personid=t2.personid INNER JOIN education t3 ON t1.educationid=t3.educationid INNER JOIN jobs t4 ON t1.jobid=t4.jobid INNER JOIN secondcourses t5 ON t1.seccourseid=t5.seccourseid WHERE participantid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_section_participants($id){
			$db 	= db();
			$q 		= "SELECT * FROM sectionparticipants WHERE sectionid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_participant_data2($id){
			$db = db();
			$q = "SELECT t1.*,t2.*,t3.*,t4.*,t5.* FROM sectionparticipants t1 INNER JOIN participants t2 ON t1.participantid=t2.participantid INNER JOIN person t3 ON t2.personid=t3.personid INNER JOIN sections t4 ON t1.sectionid=t4.sectionid INNER JOIN batches t5 ON t4.batchid=t5.batchid WHERE t1.participantid='$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d;
		}

		public function participant_no(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM participants";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count']+1;
		}

		public function count_active(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM participants WHERE status = 1";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_inactive(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM participants WHERE status = 0";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}
	}
 ?>