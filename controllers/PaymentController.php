<?php 
	require_once('../models/Payment.php');

	if(isset($_POST['action'])){
		$action = $_POST['action'];
		$payment = new Payment;

		switch ($action) {
			case 'new_payment':
				print $payment->new_payment($_POST);
			break;
			case 'toggle_status':
				$payment->toggle_status($_POST['id']);
			break;
			case 'validate_paymentcode':
				print $payment->validate_paymentcode($_POST);
			break;
			case 'get_payment':
				print $payment->get_payment($_POST['paymentid'], $_POST['payer']);
			break;
			case 'get_current_total':
				print $payment->get_current_total($_POST);
			break;
			case 'update_payment':
				print $payment->update_payment($_POST);
			break;
			case 'count_participant':
				print $payment->count_participant();
			break;
			case 'count_reservee':
				print $payment->count_reservee();
			break;
			case 'count_active':
				print $payment->count_active();
			break;
			case 'count_inactive':
				print $payment->count_inactive();
			break;
			case 'get_count':
				print $payment->get_count();
			break;
		}
	}
 ?>