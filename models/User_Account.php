<?php 
	require_once('DB.php');

	class UserAccount{
		public function logIn($data){
			$db 		= db();
			$username 	= $data['username'];
			$password 	= $data['password'];
			$q 			= "SELECT COUNT(*) as count, accountid, accesslevel, status from useraccounts WHERE username = '$username' AND password = '$password'";
			$res 		= mysqli_query($db, $q);
			$d			= mysqli_fetch_assoc($res);
			return json_encode($d);
		}
	}
 ?>