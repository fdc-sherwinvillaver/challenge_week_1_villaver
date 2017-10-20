<?php 
	require_once('../models/User_Account.php');

	if(isset($_POST['action'])){
		$action = $_POST['action'];

		switch ($action) {
			case 'login':
				$account = new UserAccount;
				print $account->logIn($_POST);
				break;
		}
	}
 ?>