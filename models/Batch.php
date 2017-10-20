<?php 
	require_once('DB.php');
	require_once('Participant.php');

	class Batch{
		
		public function getPayments(){
			$db 	= db();
			$q 		= "SELECT * FROM payments";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_batch($id){
			$db 	= db();
			$q 		= "SELECT * FROM batches WHERE batchid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_array($res);
			return $d;
		}

		public function get_batch_by_section_id($id){
			$db 	= db();
			$q 		= "SELECT batchid from sections WHERE sectionid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			$batchid 	= $d['batchid'];

			return $this->get_batch($batchid);
		}

		public function get_saturday_by_batchid($id){
			$db 	= db();
			$q 		= "SELECT COUNT(*) as 'count', sectionid, section, capacity, batchid, status FROM sections WHERE batchid = '$id' AND section ='Saturday'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_sunday_by_batchid($id){
			$db 	= db();
			$q 		= "SELECT COUNT(*) as 'count', sectionid, section, capacity, batchid, status FROM sections WHERE batchid = '$id' AND section ='Sunday'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_total_payment_by_batchid($id){
			$db 	= db();
			$q 		= "SELECT SUM(t2.amount) as 'total_payables' FROM batchpayables t1 INNER JOIN payments t2 ON t1.paymentid=t2.paymentid WHERE t1.batchid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d['total_payables'];
		}

		public function get_payables_by_batchid($data){
			$db 	= db();
			$batchid = $data['batchid'];
			$q 		= "SELECT payableid FROM batchpayables WHERE batchid = '$batchid'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return json_encode($d['payableid']);
		}

		public function add_payment($data){
			$db 	= db();
			$cur 	= $data['current'];
			$id 	= $data['id'];
			$q 		= "SELECT (amount + '$cur') as amount FROM payments WHERE paymentid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d['amount'];
		}

		public function get_batch_by_id($data){
			$db 	= db();
			$batchid =	$data['batchid'];
			$q 		= "SELECT * FROM batches WHERE batchid = '$batchid'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return json_encode($d);
		}

		public function get_section_by_batchid($batchid){
			$db  	= db();
			$q 		= "SELECT * FROM sections WHERE batchid = '$batchid'";
			$res 	= mysqli_query($db, $q);
			$d 	 	= mysqli_fetch_all($res, MYSQLI_ASSOC);;
			return $d;
		}

		public function get_section($id){
			$db 	= db();
			$q 		= "SELECT section FROM sections WHERE sectionid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d['section'];
		}

		public function update_batch($data){
			$db  = db();
			$batchid = $data['batchid'];
			$ds = $data['dateStart_submit'];
			$de = $data['dateEnd_submit'];
			$q   = "UPDATE batches SET dateStart = '$ds', dateEnd = '$de' WHERE batchid = '$batchid'";
			$res = mysqli_query($db, $q);
			$this->update_section($data);
		}

		public function update_section($data){
			$db = db();

			$batchid = $data['batchid'];
			$section 	= 'Saturday';
			$satid = $this->get_sectionid_by_batchid($batchid, $section);
			if(isset($data['saturday'])){
				$capacity 	= $data['satCapacity'];
				$q 			= "UPDATE sections SET capacity = '$capacity', status = '1' WHERE sectionid = '$satid'";
				$res 		= mysqli_query($db, $q);
			}else{
				$section 	= 'Saturday';
				$capacity 	= $data['satCapacity'];
				$q 			= "UPDATE sections SET status = '0' WHERE sectionid = '$satid'";
				$res 		= mysqli_query($db, $q);
			}

			unset($section);
			$section 	= 'Sunday';
			$sunid = $this->get_sectionid_by_batchid($batchid, $section);
			$section 	= 'Sunday';
			if(isset($data['sunday'])){
				$capacity 	= $data['sunCapacity'];
				$q 			= "UPDATE sections SET capacity = '$capacity', status = '1' WHERE sectionid = '$sunid'";
				$res 		= mysqli_query($db, $q);
			}else{
				$capacity 	= $data['sunCapacity'];
				$q 			= "UPDATE sections SET status = '0' WHERE sectionid = '$sunid'";
				$res 		= mysqli_query($db, $q);
			}

		}

		public function activate_payable($data){
			$db = db();
			$batchid = $data['batchid'];
			$payment = $data['payment'];
			$payer = $data['payer'];
			$flag = $this->check_payable($payment, $payer, $batchid);

			if($flag == 0){
				$q = "SELECT * FROM payments WHERE payment = '$payment'";
				$res = mysqli_query($db, $q);
				$d = mysqli_fetch_assoc($res);

				unset($q);
				unset($res);

				$id = $d['paymentid'];
				$payment = $d['payment'];
				$amount = $d['amount'];
				$q = "INSERT INTO batchpayables(payment, amount, payer, batchid, status) VALUES ('$payment','$amount','$payer','$batchid','1')";
				$res = mysqli_query($db, $q);
			}else{
				$q = "UPDATE batchpayables SET status = '1' WHERE payment = '$payment' AND payer = '$payer'";
				$res = mysqli_query($db, $q);
			}
		}

		public function set_batchpayments($data){
			$db 			= db();
			$payments 		= $data['payments'];
			$batchid 		= $data['batchid'];
			for ($i=0; $i < sizeof($payments); $i++) { 
				$length 	= strlen($payments[$i]);
				$id 		= substr($payments[$i], 1, $length-1);
				$paymentinfo = $this->get_payment($id); 
				$payment 	= $paymentinfo['payment'];
				$amount 	= $paymentinfo['amount'];
				$payer 		= $payments[$i][0];

				$q 			= "INSERT INTO batchpayables (paymentid, updated_amount, payer, batchid, status) VALUES('$id', '$amount', '$payer', '$batchid', '1')";
				$res 		= mysqli_query($db, $q);
			}

			$query = "UPDATE batches SET status = '1' WHERE batchid = '$batchid'";
			$result = mysqli_query($db, $query);
		}

		public function set_batchscholarships($batchid){
			$db 			= db();
			foreach ($this->get_active_scholarships() as $sc) {
				$id   = $sc['scholarshipid'];
				$disc = $sc['discount'];
				$q 	 = "INSERT INTO batchscholarships(scholarshipid, updated_discount, batchid, status) VALUES ('$id','$disc','$batchid','1')";
				$res = mysqli_query($db, $q);
			}
		}

		public function get_active_scholarships(){
			$db = db();
			$q = "SELECT * FROM scholarships WHERE status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_scholarships($id){
			$db = db();
			$q = "SELECT * FROM scholarships WHERE scholarshipid = '$id'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_payment($id){
			$db = db();
			$q 	= "SELECT * FROM payments WHERE paymentid = '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_scholarship($id){
			$db = db();
			$q = "SELECT * FROM scholarships WHERE scholarshipid = '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d;
		}

		public function update_batchpayments($data){
			$db = db();
			$batchid = $data['batchid'];
			$query 			= "UPDATE batchpayables SET status = 0 WHERE batchid = '$batchid'";
			$result 		= mysqli_query($db, $query);
			if(isset($data['payments'])){
				$payments = $data['payments'];

				$sat 		= $this->get_saturday_by_batchid($batchid)['sectionid'];
				$sun 		= $this->get_sunday_by_batchid($batchid)['sectionid'];

				for ($i = 0; $i < sizeof($payments); $i++) { 
				$length 	= strlen($payments[$i]);
				$id 		= substr($payments[$i], 1, $length-1);
				$paymentinfo = $this->get_payment($id); 
				$payment 	= $paymentinfo['payment'];
				$amount 	= $paymentinfo['amount'];
				$payer 		= $payments[$i][0];

				if($this->check_payable_if_exists($id, $payer, $batchid) != 0){
					$q 			= "UPDATE batchpayables SET status = '1' WHERE paymentid = '$id' AND payer = '$payer' AND batchid = '$batchid'";
					$res 		= mysqli_query($db, $q);
				}else{
					$q 			= "INSERT INTO batchpayables (paymentid, updated_amount, payer, batchid, status) VALUES('$id', '$amount', '$payer', '$batchid', '1')";
					$res 		= mysqli_query($db, $q);
				}
			}
			}
			$this->refresh_payables($batchid);
		}

		public function get_batchpayableid($batchid, $paymentid){
			$db = db();
			$q  = "SELECT payableid FROM batchpayables WHERE batchid='$batchid' AND paymentid = '$paymentid'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['payableid'];
		}

		public function update_participantpayables($sat, $sun, $payableid, $payer){
			$db = db();
			$d = $this->get_batchparticipants($sat, $sun);
			foreach ($d as $secparticipant) {
				$id = $secparticipant['sectionparticipantid'];
				$program = $this->get_participant_program($id);

				if($program == 'BSED' && $payer == 1){
					if($this->check_participantpayable($id, $payableid) != 0){
						$query = "UPDATE participantpayments SET status = 1 WHERE payableid = '$payableid' AND sectionparticipantid = '$id'";
						$result = mysqli_query($db, $query);
					}else{
						$query = "INSERT INTO participantpayments(sectionparticipantid, payableid, status) VALUES('$id','$payableid','1')";
						$result = mysqli_query($db, $query);
					}
				}else if($program == 'BEED' && $payer == 2){
					if($this->check_participantpayable($id, $payableid) != 0){
						$query = "UPDATE participantpayments SET status = 1 WHERE payableid = '$payableid' AND sectionparticipantid = '$id'";
						$result = mysqli_query($db, $query);
					}else{
						$query = "INSERT INTO participantpayments(sectionparticipantid, payableid, status) VALUES('$id','$payableid','1')";
						$result = mysqli_query($db, $query);
					}
				}
			}
		}

		public function get_payer_by_payableid($payableid){
			$db = db();
			$q 	= "SELECT payer FROM batchpayables WHERE payableid = '$payableid'";
			$res= mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['payer'];
		}

		public function get_participant_program($secparticipantid){
			$db = db();
			$query = "SELECT t3.program FROM sectionparticipants t1 INNER JOIN participants t2 ON t1.participantid=t2.participantid INNER JOIN education t3 ON t2.educationid=t3.educationid WHERE t1.sectionparticipantid='$secparticipantid'";
			$res=mysqli_query($db,$query);
			$d = mysqli_fetch_assoc($res);
			return $d['program'];
		}

		public function check_participantpayable($secparticipantid, $payableid){
			$db = db();
			$q  = "SELECT COUNT(*) as 'count' FROM participantpayments WHERE sectionparticipantid = '$secparticipantid' AND payableid = '$payableid'";
			$res = mysqli_query($db, $q);
			$d  = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function deactivate_participantpayables($sat, $sun){
			$db = db();
			$d = $this->get_batchparticipants($sat, $sun);
			foreach ($d as $secparticipant){
				$id = $secparticipant['sectionparticipantid'];
				$query = "UPDATE participantpayments SET status = 0 WHERE sectionparticipantid = '$id'";
				$result = mysqli_query($db, $query);
			}
		}

		public function update_batchscholarships($data){
			$db 	= db();
			$batchid = $data['batchid'];
			$query = "UPDATE batchscholarships SET status = 0 WHERE batchid = '$batchid'";
			$result = mysqli_query($db, $query);


			if(isset($data['scholarships'])){
				$scholarships = $data['scholarships'];
				for($i=0; $i < sizeof($scholarships); $i++){
					$id = $scholarships[$i];
					$scholarship = $this->get_scholarship($id);
					$discount = $scholarship['discount'];

					if($this->check_scholarship_if_exists($id, $batchid) != 0){
						$q = "UPDATE batchscholarships SET status = '1' WHERE scholarshipid = '$id' AND batchid = '$batchid'";
						$res = mysqli_query($db, $q);
					}else{
						$q = "INSERT INTO batchscholarships(scholarshipid, updated_discount, batchid, status) VALUES('$id', '$discount', '$batchid', '1')";
						$res = mysqli_query($db, $q);
					}
				}
			}
		}

		public function refresh_payables($batchid){
			$db 	= db();
			$q 		= "SELECT SUM(updated_amount) as 'total' FROM batchpayables WHERE batchid = '$batchid' AND status = '1' AND payer = '1'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			$bsedtotal = $d['total'];

			unset($q);
			unset($res);
			unset($d);
			$q 		= "SELECT SUM(updated_amount) as 'total' FROM batchpayables WHERE batchid = '$batchid' AND status = '1' AND payer = '2'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			$beedtotal = $d['total'];

			$sat = $this->get_saturday_by_batchid($batchid)['sectionid'];
			$sun = $this->get_sunday_by_batchid($batchid)['sectionid'];

			print $sat;
			print $sun;

			unset($q);
			unset($res);
			unset($d);

			$q 		= "SELECT * FROM sectionparticipants WHERE sectionid = '$sat' OR sectionid = '$sun'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);

			unset($q);
			unset($res);

			foreach ($d as $secparticipant) {
				$secparticipantid = $secparticipant['sectionparticipantid'];
				$participantid 	  = $secparticipant['participantid'];
				$p 				  = new Participant;
				$participantinfo  = $p->get_student_data($participantid);

				$q = "SELECT SUM(discount) as 'total' FROM participantscholarships WHERE sectionparticipantid = '$secparticipantid'";
				$res = mysqli_query($db, $q);
				$data 	= mysqli_fetch_assoc($res);
				$totaldisc = $data['total'];

				if($participantinfo['program'] == "BSED"){
					$payable = (((float)$bsedtotal - (float)$totaldisc) - 500) / 3;
					$query = "UPDATE participantpayments SET amount = '$payable' WHERE sectionparticipantid = '$secparticipantid'";
					$result = mysqli_query($db, $query);
				}else if($participantinfo['program'] == "BEED"){
					$payable = (((float)$beedtotal - (float)$totaldisc) - 500) / 3;
					$query = "UPDATE participantpayments SET amount = '$payable' WHERE sectionparticipantid = '$secparticipantid'";
					$result = mysqli_query($db, $query);
				}
			}
		}

		public function check_payable_if_exists($id, $payer, $batchid){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM batchpayables WHERE paymentid = '$id' AND payer = '$payer' AND batchid = '$batchid'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function check_scholarship_if_exists($id, $batchid){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM batchscholarships WHERE scholarshipid = '$id' AND batchid = '$batchid'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function deactivate_payable($data){
			$db = db();
			$batchid = $data['batchid'];
			$payment = $data['payment'];
			$payer = $data['payer'];
			$q = "UPDATE batchpayables SET status = '0' WHERE payment = '$payment' AND payer = '$payer' AND batchid = '$batchid'";
			$res = mysqli_query($db, $q);
		}

		public function get_batch_payments($batchid){
			$db = db();
			$q = "SELECT * FROM batchpayables WHERE batchid = '$batchid' AND status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_batch_scholarships($batchid){
			$db = db();
			$q 	= "SELECT * FROM batchscholarships WHERE batchid = '$batchid' AND status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function check_payable($paymentid, $payer, $batchid){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM batchpayables WHERE paymentid = '$paymentid' AND payer = '$payer' AND batchid = '$batchid' AND status = '1'"; 
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function check_scholarship($scholarshipid, $batchid){
			$db = db();
			$q  = "SELECT COUNT(*) as 'count' FROM batchscholarships WHERE batchid = '$batchid' AND scholarshipid = '$scholarshipid' AND status = '1'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_payable_total($batchid, $payer){
			$db = db();
			$q = "SELECT SUM(updated_amount) as 'total' FROM batchpayables WHERE batchid = '$batchid' AND payer = '$payer' AND status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			if($d['total'] == null){
				return '0.00';
			}else{
				return $d['total'];
			}
		}

		public function get_beed_payable_total($batchid, $payer){
			$db = db();
			$q = "SELECT SUM(updated_amount) as 'total' FROM batchpayables WHERE batchid = '$batchid' AND payer = '$payer' AND status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			if($d['total'] == null){
				return '0.00';
			}else{
				return $d['total'];
			}
		}

		public function update_paymentschedule($data){
			$db = db();
			$date1 			= $data['sched1_submit'];
			$date2 			= $data['sched2_submit'];
			$date3 			= $data['sched3_submit'];
			$batchid 		= $data['batchid'];

			$s = $this->find_paymentschedule($batchid);
			if($s == 0){
				$q = "INSERT INTO paymentschedules(date1,date2,date3,batchid) VALUES ('$date1','$date2','$date3','$batchid')";
				$res = mysqli_query($db, $q);
			}else{
				$q 	= "UPDATE paymentschedules SET date1 = '$date1', date2 = '$date2', date3 = '$date3' WHERE batchid = '$batchid'";
				$res = mysqli_query($db, $q);
			}
		}

		public function find_paymentschedule($batchid){
			$db = db();
			$q  = "SELECT COUNT(*) as 'count' FROM paymentschedules WHERE batchid = '$batchid'";
			$res = mysqli_query($db, $q);
			$d  = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function remove_payment($data){
			$db 	= db();
			$cur 	= $data['current'];
			$id 	= $data['id'];
			$q 		= "SELECT ('$cur' - amount) as amount FROM payments WHERE paymentid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d['amount'];
		}

		public function new_batch($data){
			$db 		= db();
			$batchno 	= $data['batchno'];
			$dateStart	= $data['dateStart_submit'];
			$dateEnd 	= $data['dateEnd_submit'];
			$datestamp 	= date("Y-m-d H:i:s");

			$q 			= "INSERT INTO batches (batchno, status, dateStart, dateEnd, datestamp) VALUES ('$batchno', '2', '$dateStart', '$dateEnd', '$datestamp')";
			$res 		= mysqli_query($db, $q);
			$batchid	= $db->insert_id;
			
			$this->new_section($data, $batchid);
			return $batchid;
		}

		public function set_paymentschedule($data){
			$db 			= db();
			$batchid 		= $this->new_batch($data);
			$date1 			= $data['sched1_submit'];
			$date2 			= $data['sched2_submit'];
			$date3 			= $data['sched3_submit'];
			$q 				= "INSERT INTO paymentschedules (date1, date2, date3, batchid) VALUES ('$date1','$date2','$date3', '$batchid')";
			$res 			= mysqli_query($db, $q);
			return $batchid;
		}

		public function new_section($data, $batchid){
			$db 			= db();
			if(isset($data['saturday'])){
				$section 	= 'Saturday';
				$capacity 	= $data['satCapacity'];
				$q 			= "INSERT INTO sections (section, capacity, batchid, status) VALUES ('$section', '$capacity', '$batchid', '1')";
				$res 		= mysqli_query($db, $q);
			}else{
				$section 	= 'Saturday';
				$capacity 	= $data['satCapacity'];
				$q 			= "INSERT INTO sections (section, capacity, batchid, status) VALUES ('$section', '0', '$batchid', '0')";
				$res 		= mysqli_query($db, $q);
			}

			if(isset($data['sunday'])){
				$section 	= 'Sunday';
				$capacity 	= $data['sunCapacity'];
				$q 			= "INSERT INTO sections (section, capacity, batchid, status) VALUES ('$section', '$capacity', '$batchid', '1')";
				$res 		= mysqli_query($db, $q);
			}else{
				$section 	= 'Sunday';
				$capacity 	= $data['sunCapacity'];
				$q 			= "INSERT INTO sections (section, capacity, batchid, status) VALUES ('$section', '0', '$batchid', '0')";
				$res 		= mysqli_query($db, $q);
			}
		}

		public function count_enrollees_by_section($data){
			$db = db();
			$batchid = $data['batchid'];
			$section = $data['section'];

			$sectionid = $this->get_sectionid_by_batchid($batchid, $section);
			$q = "SELECT COUNT(*) as 'count' FROM sectionparticipants WHERE sectionid = '$sectionid'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_sectionparticipants($sectionid){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM sectionparticipants WHERE sectionid = '$sectionid'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_sectionid_by_batchid($id, $section){
			$db = db();
			$q  = "SELECT sectionid from sections WHERE batchid = '$id' AND section = '$section'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['sectionid'];
		}

		public function set_bsed_payables($batchid){
			$db = db();
			foreach ($this->get_bsed_payments() as $bsed) {
				$id 			= $bsed['paymentid'];
				$q 				= "SELECT * from payments WHERE paymentid = '$id'";
				$res 			= mysqli_query($db, $q);
				$d 				= mysqli_fetch_assoc($res);
				$paymentcode 	= $d['paymentcode'];
				$amount 	 	= $d['amount'];

				unset($q);
				unset($res);
				$q 				= "INSERT INTO batchpayables (paymentcode, amount, payer, batchid, status) VALUES ('$paymentcode','$amount', '1','$batchid', '1')";
				$res 			= mysqli_query($db, $q);
				unset($id);
				unset($q);
				unset($res);
			}
		}

		public function set_beed_payables($batchid){
			$db = db();
			foreach ($this->get_beed_payments() as $beed) {
				$id = $beed['paymentid'];
				$q 				= "SELECT * from payments WHERE paymentid = '$id'";
				$res 			= mysqli_query($db, $q);
				$d 				= mysqli_fetch_assoc($res);
				$paymentcode 	= $d['paymentcode'];
				$amount 	 	= $d['amount'];

				unset($q);
				unset($res);
				$q 	= "INSERT INTO batchpayables (paymentcode, amount, payer, batchid, status) VALUES ('$paymentcode','$amount', '2','$batchid', '1')";
				$res 	= mysqli_query($db, $q);
				unset($id);
				unset($q);
				unset($res);
			}
		}

		public function check_existing_payments_by_batchid($id, $paymentcode){
			$db = db();
			$q 		= "SELECT COUNT(*) as 'count' FROM 	batchpayables WHERE paymentcode = '$paymentcode' AND batchid = '$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $id." ".$paymentcode;
		}

		public function count_batch(){
			$db 	= db();
			$q 		= "SELECT COUNT(*) as 'count' FROM batches";
			$res	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d['count']+1;
		}

		public function get_paymentschedule_by_batchid($id){
			$db 	= db();
			$q 		= "SELECT * FROM paymentschedules WHERE batchid='$id'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_payment_by_batchid($batchid, $paymentid){
			$db 	= db();
			$q 		= "SELECT COUNT(*) as 'count' FROM batchpayables WHERE batchid = '$batchid' AND paymentid = '$paymentid'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_bsed_payments(){
			$db 	= db();
			$q 		= "SELECT t1.*, t2.* FROM payers t1 INNER JOIN payments t2 ON t1.paymentid=t2.paymentid WHERE payer = '1' AND status = '1'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_batch_bsed_payables($batchid){
			$db 	= db();
			$q 		= "SELECT * from batchpayables WHERE payer = '1' AND batchid = '$batchid' AND status = '1'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_bsed_payment_total($batchid){
			$db 	= db();
			$q 		= "SELECT SUM(updated_amount) as 'total' FROM batchpayables WHERE batchid = '$batchid' AND status = '1' AND payer = '1'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			if(is_null($d['total'])){
				return '-500';
			}else{
				return (float)$d['total'] - 500;
			}
		}

		/*public function get_bsed_payable_total($id){
			$db = db();
			$q  = "SELECT SUM(amount) as 'total' FROM batchpayables WHERE batchid = '$id' AND status = '1' AND payer = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['total'];
		}*/

		public function get_beed_payments(){
			$db 	= db();
			$q 		= "SELECT t1.*, t2.* FROM payers t1 INNER JOIN payments t2 ON t1.paymentid=t2.paymentid WHERE t2.payer = '2' AND t2.status = '1'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_batch_beed_payables($batchid){
			$db 	= db();
			$q 		= "SELECT * from batchpayables WHERE payer = '2' AND batchid = '$batchid' AND status = '1'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_beed_payment_total($batchid){
			$db 	= db();
			$q 		= "SELECT SUM(updated_amount) as 'total' FROM batchpayables WHERE batchid = '$batchid' AND status = '1' AND payer = '2'";
			$res 	= mysqli_query($db, $q);
			$d 		= mysqli_fetch_assoc($res);
			if(is_null($d['total'])){
				return '-500';
			}else{
				return (float)$d['total'] - 500;
			}
		}

		public function count_payables($batchid, $payer){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM batchpayables WHERE batchid = '$batchid' AND payer = '$payer' AND status = '1'";
			$res = mysqli_query($db, $q);
			$d  = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_batch_status($id){
			$db = db();
			$q  = "SELECT status FROM batches WHERE batchid = '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['status'];
		}

		public function count_participants_by_section($id){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM sectionparticipants WHERE sectionid = '$id'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function set_result($data){
			$db = db();
			$sat = $data['sat'];
			$sun = $data['sun'];
			$results = $data['results'];
			for ($i=0; $i < sizeof($results); $i++) { 
				$result = substr($results[$i], 0, 1);
				$length = strlen($results[$i]);
				$participant = substr($results[$i], $length-1);
				
				$q = "UPDATE sectionparticipants SET result = '$result' WHERE participantid = '$participant' AND (sectionid='$sat' OR sectionid='$sun')";
				$res = mysqli_query($db, $q);
			}
		}

		public function get_batchparticipants($sat, $sun){
			$db = db();
			$q 	= "SELECT * FROM sectionparticipants WHERE sectionid = '$sat' OR sectionid = '$sun'";
			$res= mysqli_query($db, $q);
			$d 	= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function count_participant_with_no_result($sat, $sun){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM sectionparticipants WHERE result = 0 AND (sectionid = '$sat' OR sectionid = '$sun')";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_zero_result($sat, $sun){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM sectionparticipants WHERE sectionid = '$sat' OR sectionid = '$sun'";
			$res = mysqli_query($db,$q);
			$d 	= mysqli_query($res);
			return $d['count'];
		}

		public function get_participant_result($section, $participantid){
			$db = db();
			$q 	= "SELECT result FROM sectionparticipants WHERE sectionid = '$section'  AND participantid = '$participantid'";
			$res = mysqli_query($db, $q);
			$d  = mysqli_fetch_assoc($res);
			return $d['result'];
		}

		public function count_enrolled_paticipants_per_batch($batchid){
			$db = db();
			$count = 0;
			foreach ($this->get_section_by_batchid($batchid) as $section) {
				$sectionid = $section['sectionid'];
				$q = "SELECT COUNT(*)  as 'count' FROM sectionparticipants WHERE sectionid = '$sectionid'";
				$res = mysqli_query($db, $q);
				$d 	= mysqli_fetch_assoc($res);
				$count += $d['count'];
			}
			return $count;
		}

		public function get_active_batches(){
			$db = db();
			$q = "SELECT * FROM batches WHERE status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function count_active_batch(){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM batches WHERE status = '1'";
			$res= mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function validate_batch(){
			$db = db();
			$q  = "SELECT * FROM batches WHERE status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);

			$id 		= $d['batchid'];
			$dateEnd 	= $d['dateEnd'];
			if($dateEnd < date("Y-m-d")){
				$query = "UPDATE batches SET status = 0 WHERE batchid = '$id'";
				$result = mysqli_query($db ,$query);

				$sat = $this->get_saturday_by_batchid($id)['sectionid'];
				$sun = $this->get_sunday_by_batchid($id)['sectionid'];

				unset($query);
				unset($result);

				foreach ($this->get_batchparticipants($sat, $sun) as $p) {
					$sectionparticipantid = $p['sectionparticipantid'];
					$query = "SELECT t1.*,t2.* FROM sectionparticipants t1 INNER JOIN participants t2 ON t1.participantid=t2.participantid WHERE sectionparticipantid = '$sectionparticipantid'";
					$result = mysqli_query($db, $query);
					$data = mysqli_fetch_assoc($result);
					$participantid = $data['participantid'];

					unset($query);
					unset($result);

					$query = "UPDATE participants SET status = 0 WHERE participantid = '$participantid'";
					$result = mysqli_query($db, $query);
				}
			}
		}

		public function get_all_enrollment_by_participantid($id){
			$db = db();
			$q  = "SELECT * FROM sectionparticipants WHERE participantid = '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_participant_payables($participantid){
			$db = db();
			$q = "SELECT * FROM participantpayments WHERE sectionparticipantid = '$participantid' AND status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_total_participant_payables($participantid, $sectionid){
			$db = db();
			$q = "SELECT SUM(t3.updated_amount) as 'total' FROM sectionparticipants t1 INNER JOIN participantpayments t2 ON t1.sectionparticipantid=t2.sectionparticipantid INNER JOIN batchpayables t3 ON t2.payableid=t3.payableid WHERE t1.participantid='$participantid' AND t1.sectionid = '$sectionid' AND t2.status = 1";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			if (is_null($d['total'])) {
				return '0.00';
			}else{ return $d['total']; }
		}

		public function get_participant_scholarship($participantid){
			$db = db();
			$q = "SELECT * FROM participantscholarships WHERE sectionparticipantid = '$participantid'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_total_participant_scholarship($participantid, $sectionid){
			$db = db();
			$batchid = $this->get_batch_by_section_id($sectionid)['batchid'];
			$q = "SELECT SUM(t3.updated_discount) as 'total' FROM participantscholarships t1 INNER JOIN sectionparticipants t2 ON t1.sectionparticipantid=t2.sectionparticipantid INNER JOIN batchscholarships t3 ON t1.bscholarshipid=t3.bscholarshipid WHERE t2.sectionid = '$sectionid' AND t2.participantid = '$participantid' AND t1.status = 1";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			if (is_null($d['total'])) {
				return '0.00';
			}else{ return $d['total']; }
		}

		public function edit_batchscholarship($data){
			$db 		= db();
			$disc 		= $data['discount'];
			$batchid 	= $data['batchid'];
			$id 	 	= $data['scholarshipid'];
			$q  		= "UPDATE batchscholarships SET updated_discount = '$disc' WHERE batchid = '$batchid' AND scholarshipid = '$id'";
			$res 		= mysqli_query($db, $q);
		}

		public function deactivate_disc_on_edit($data){
			$db 		= db();
			$id 		= $data['remove_id'];
			$batchid 	= $data['batchid'];
			$q 			= "UPDATE batchscholarships SET status = 0 WHERE scholarshipid = '$id' AND batchid = '$batchid'";
			$res 		= mysqli_query($db, $q);
		}

		public function validate_school_on_edit($data){
			$db 	 	= db();
			$id 		= $data['id'];
			$batchid 	= $data['batchid'];
			$school 	= $data['school'];
			$q 			= "SELECT COUNT(*) as 'count' FROM batchscholarships t1 INNER JOIN scholarships t2 ON t1.scholarshipid=t2.scholarshipid WHERE t1.batchid = '$batchid' AND t2.value = '$school' AND t1.status = '1' AND t1.scholarshipid != '$id'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function edit_school_scholarship_on_edit($data){
			$db 		= db();
			$batchid 	= $data['batchid'];
			$disc 		= $data['schooldisc_id'];
		}
	}
 ?>