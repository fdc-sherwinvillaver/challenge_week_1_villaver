<?php 
	require_once('../models/Batch.php');

	if(isset($_POST['action'])){
		$batch = new Batch;
		$action = $_POST['action'];
		switch ($action) {
			case 'get_bsed_payment_total':
				print $batch->get_bsed_payment_total();
			break;
			case 'get_beed_payment_total':
				print $batch->get_beed_payment_total();
			break;
			case 'new_batch':
				print $batch->new_batch($_POST);
			break;
			case 'count_batch':
				print $batch->count_batch();
			break;
			case 'get_saturday_by_batchid':
				print json_encode($batch->get_saturday_by_batchid($_POST['id']));
			break;
			case 'get_sunday_by_batchid':
				print json_encode($batch->get_sunday_by_batchid($_POST['id']));
			break;
			case 'count_enrollees_by_section':
				print $batch->count_enrollees_by_section($_POST);
			break;
			case 'update_batch':
				print $batch->update_batch($_POST);
			break;
			case 'deactivate_payable':
				print $batch->deactivate_payable($_POST);
			break;
			case 'get_payable_total':
				print $batch->get_payable_total($_POST['batchid'], $_POST['payer']);
			break;
			case 'activate_payable':
				print $batch->activate_payable($_POST);
			break;
			case 'set_batchpayments':
				print $batch->set_batchpayments($_POST);
			break;
			case 'set_paymentschedule':
				print $batch->set_paymentschedule($_POST);
			break;
			case 'update_batchpayments':
				print $batch->update_batchpayments($_POST);
			break;
			case 'get_batch_payments':
				print json_encode($batch->get_batch_payments($_POST['batchid']));
			break;
			case 'get_batch_scholarships':
				print json_encode($batch->get_batch_scholarships($_POST['batchid']));
			break;
			case 'update_paymentschedule':
				print $batch->update_paymentschedule($_POST);
			break;
			case 'get_batch_status':
				print $batch->get_batch_status($_POST['batchid']);
			break;
			case 'get_batch_by_section_id':
				print json_encode($batch->get_batch_by_section_id($_POST['sectionid']));
			break;
			case 'set_result':
				print $batch->set_result($_POST);
			break;
			case 'count_sectionparticipants':
				print $batch->count_sectionparticipants($_POST['sectionid']);
			break;
			case 'count_active_batch':
				print $batch->count_active_batch();
			break;
			case 'validate_batch':
				print $batch->validate_batch();
			break;
			case 'edit_batchscholarship':
				print $batch->edit_batchscholarship($_POST);
			break;
			case 'count_enrolled_paticipants_per_batch':
				print $batch->count_enrolled_paticipants_per_batch($_POST['batchid']);
			break;
			case 'deactivate_disc_on_edit':
				print $batch->deactivate_disc_on_edit($_POST);
			break;
			case 'validate_school_on_edit':
				print $batch->validate_school_on_edit($_POST);
			break;
			case 'edit_school_scholarship_on_edit':
				print $batch->edit_school_scholarship_on_edit($_POST);
			break;
		}

	}
 ?>