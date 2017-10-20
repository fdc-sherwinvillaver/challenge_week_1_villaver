<?php 
	require_once('DB.php');
	require_once('Batch.php');

	class Payment{
		
		public function new_payment($data){
			$db = db();
			$payment 	= $data['payment'];
			$amount 	 = $data['amount'];
			$payer  	 = $data['payer'];
			$status 	 = 1;	

			$q 			 = "INSERT INTO payments (payment, amount, payer, status) VALUES ('$payment', '$amount', '$payer', '$status')";
			$res 		 = mysqli_query($db, $q);
			return $paymentid 	 = $db->insert_id;
		}

		public function update_payment($data){
			$db = db();
			$paymentid = $data['paymentid'];
			$payment = $data['payment'];
			$amount = $data['amount'];
			$q  = "UPDATE payments SET payment = '$payment', amount = '$amount' WHERE paymentid = '$paymentid'";
			$res = mysqli_query($db, $q);
		}

		public function set_payer($paymentid, $payer){
			$db 		 = db();
			$count 		 = sizeof($payer);
			for ($i=0; $i < $count; $i++) { 
				$q  		 = "INSERT INTO payers (payer, paymentid) VALUES ('$payer[$i]','$paymentid')";
				$res 		 = mysqli_query($db, $q);

				unset($q);
				unset($res);
			}
		}

		public function toggle_status($id){
			$db 		 = db();
			$q 			 = "SELECT status FROM payments WHERE paymentid = '$id'";
			$res 		 = mysqli_query($db, $q);
			$d 			 = mysqli_fetch_assoc($res);
			$status 	 = $d['status'];

			unset($q);
			unset($res);

			if($status == 0){
				$q 		 = "UPDATE payments SET status = '1' WHERE paymentid = '$id'";
				$res 	 = mysqli_query($db, $q);
			}else{
				$q 		 = "UPDATE payments SET status = '0' WHERE paymentid = '$id'";
				$res 	 = mysqli_query($db, $q);

				unset($q);
				unset($res);

				$batches 	 = new Batch();
				foreach ($batches->get_active_batches() as $batch) {
					$batchid = $batch['batchid'];
					$q = "UPDATE batchpayables SET status = '0' WHERE paymentid = '$id' AND batchid = '$batchid'";
					$res 	= mysqli_query($db, $q);
				}
			}
		}

		public function get_batch_payables($id){
			$db = db();
			$q 			= "SELECT (paymentid), updated_amount FROM batchpayables WHERE batchid = '$id' GROUP BY paymentid";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_payments(){
			$db = db();
			$q 			= "SELECT * FROM payments";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_active_payments(){
			$db = db();
			$q 			= "SELECT * FROM payments WHERE payer = '1' AND status = '1'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_payers($id){
			$db = db();
			$q 			= "SELECT payer FROM payers WHERE paymentid = '$id'";
			$res 		= mysqli_query($db, $q);
			$d 			= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function get_payment($id){
			$db = db();
			$q 	= "SELECT * FROM payments WHERE paymentid = '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d;
		}

		public function get_current_total($data){
			$db = db();
			$id = $data['paymentid'];
			$operator = $data['operator'];
			$q = "SELECT amount FROM payments WHERE paymentid = '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			$amount = (float)$d['amount'];
			$current = (float)$data['current'];
			if ($operator == 'add') {
				return $amount + $current;
			}else{
				return $current - $amount;
			}
		}

		public function count_participant(){
			$db = db();
			$q = "SELECT COUNT(*) AS 'count' FROM payments WHERE payer = 1";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_reservee(){
			$db = db();
			$q = "SELECT COUNT(*) AS 'count' FROM payments WHERE payer = 2";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_active(){
			$db = db();
			$q = "SELECT COUNT(*) AS 'count' FROM payments WHERE status = 1";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_inactive(){
			$db = db();
			$q = "SELECT COUNT(*) AS 'count' FROM payments WHERE status = 0";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_count(){
			$db = db();
			$q = "SELECT COUNT(*) AS 'count' FROM payments";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}
	}
 ?>