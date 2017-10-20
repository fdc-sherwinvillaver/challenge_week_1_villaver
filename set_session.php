<?php 
	session_start();

	if(isset($_POST['id'])){
		$_SESSION['id'] = $_POST['id'];
	}

	if(isset($_POST['status'])){
		$_SESSION['status'] = $_POST['status'];
	}

	if( isset($_POST['accesslvl'])){
		$_SESSION['accesslvl'] = $_POST['accesslvl'];
	}
 ?>