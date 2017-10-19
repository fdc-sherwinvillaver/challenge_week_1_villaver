<?php 
	require_once('DB.php');
	class User{

		public function new_user($data){
			$db = db();
			$personid 	= $this->create_empty_person();
			$accountid 	= $this->create_default_user($data);
			$q 			= "INSERT INTO users(accountid,personid) VALUES('$accountid','$personid')";
			$res 		= mysqli_query($db, $q);
		}

		public function create_default_user($data){
			$db = db();
			$username 	= $data['username'];
			$accesslvl	= $data['accesslevel'];
			$q 		   	= "INSERT INTO useraccounts(username,password,accesslevel,status) VALUES ('$username', 'edustudiouser','$accesslvl','0')";
			$res		= mysqli_query($db, $q);
			return $db->insert_id;
		}

		public function create_empty_person(){
			$db = db();
			$q 	= "INSERT INTO person() VALUES()";
			$res = mysqli_query($db, $q);
			return $db->insert_id;
		}
		public function count_user(){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM users";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return (int)$d['count']+1;
		}

		public function validate_username($username){
			$db = db();
			$q 	= "SELECT COUNT(*) as 'count' FROM useraccounts WHERE username = '$username'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function validate_username_except_owner($username, $id){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM useraccounts WHERE username = '$username' AND accountid != '$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function edit_user($data){
			$db = db();
			$accountid 	= $data['userid'];
			$personid 	= $this->get_person_by_accountid($accountid);
			$firstname 	= $data['firstname'];
			$middlename = $data['middlename'];
			if(is_null($middlename)){
				$middlename = "-";
			}
			$lastname 	= $data['lastname'];
			$profimg 	= $data['profimg'];

			$password 	= $data['password'];
			$q 			= "UPDATE person SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', photo = '$profimg' WHERE personid = '$personid'";
			$res 		= mysqli_query($db, $q);

			$query 		= "UPDATE useraccounts SET password = '$password', status = '1' WHERE accountid = '$accountid'";
			$result 	= mysqli_query($db, $query);
		}

		public function get_person_by_accountid($id){
			$db = db();
			$q 	= "SELECT personid FROM users WHERE accountid = '$id'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['personid'];
		}

		public function get_users($id){
			$db = db();
			$q 	= "SELECT t1.*,t2.*,t3.* FROM users t1 INNER JOIN useraccounts t2 ON t1.accountid=t2.accountid INNER JOIN person t3 ON t1.personid=t3.personid WHERE t2.accountid != '$id'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_all($res, MYSQLI_ASSOC);
			return $d;
		}

		public function toggle_status($id){
			$db = db();
			$q 			 = "SELECT status FROM useraccounts WHERE accountid = '$id'";
			$res 		 = mysqli_query($db, $q);
			$d 			 = mysqli_fetch_assoc($res);
			$status 	 = $d['status'];

			unset($q);
			unset($res);

			if($status == 2){
				$q 		 = "UPDATE useraccounts SET status = '1' WHERE accountid = '$id'";
				$res 	 = mysqli_query($db, $q);
			}else{
				$q 		 = "UPDATE useraccounts SET status = '2' WHERE accountid = '$id'";
				$res 	 = mysqli_query($db, $q);
			}
		}

		public function get_username($id){
			$db = db();
			$q  = "SELECT username from useraccounts WHERE accountid = '$id'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['username'];
		}

		public function get_userid_by_accountid($id){
			$db = db();
			$q  = "SELECT userid FROM users WHERE accountid = '$id'";
			$res = mysqli_query($db, $q);
			$d 	= mysqli_fetch_assoc($res);
			return $d['userid'];
		}

		public function get_userdata($id){
			$db = db();
			$userid = $this->get_userid_by_accountid($id);
			$q = "SELECT t1.*,t2.*,t3.* FROM users t1 INNER JOIN useraccounts t2 ON t1.accountid=t2.accountid INNER JOIN person t3 ON t1.personid=t3.personid WHERE userid='$id'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d;
		}

		public function update_userprofile($data){
			$db = db();
			$firstname = $data['firstname'];
			$middlename = $data['middlename'];
			$lastname = $data['lastname'];
			$gender = $data['gender'];
			$birthdate = $data['bdate_submit'];
			$age 		= date_diff(date_create($data['bdate_submit']), date_create('today'))->y;
			$email 		= $data['email'];
			$facebook 	= $data['facebook'];
			$phone 		= $data['phone'];
			$barangay   = $data['barangay'];
			$city		= $data['city'];
			$province 	= $data['province'];
			$photo 		= $data['profimg'];
			$personid 	= $data['personid'];
			$q = "UPDATE person SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', gender = '$gender', birthdate = '$birthdate', age = '$age', email = '$email', facebook = '$facebook', phone = '$phone', barangay = '$barangay', city = '$city', province = '$province', photo = '$photo' WHERE personid = '$personid'";
			$res = mysqli_query($db, $q);
		}

		public function count_active(){
			$db = db();
			$q  = "SELECT COUNT(*) as 'count' FROM useraccounts WHERE  status = '1'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_inactive(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM useraccounts WHERE  status = '0' OR status = '2'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_superadmin(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM useraccounts WHERE accesslevel = '1'";
			$res = mysqli_query($db ,$q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function count_admin(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM useraccounts WHERE accesslevel = '2'";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}

		public function get_count(){
			$db = db();
			$q = "SELECT COUNT(*) as 'count' FROM useraccounts";
			$res = mysqli_query($db, $q);
			$d = mysqli_fetch_assoc($res);
			return $d['count'];
		}
	}
 ?>