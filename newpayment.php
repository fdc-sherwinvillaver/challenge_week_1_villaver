<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <main class="">
	    <div class="div-55-center">
	    	<div class="card pad mt-3">
	    	<h4 class="blue-text">New Payable</h4>
	    	<form id="frmnewpayment">
                <div class="row mt-3">
                	<div class="col-md-6">
		                <div class="md-form">
		                    <input type="text" id="payment" name="payment" class="form-control">
		                    <label for="paymentname" class="">Payable</label>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="md-form">
		                    <input type="text" id="amount" name="amount" class="form-control">
		                    <label for="amount" class="">Amount</label>
		                </div>
		            </div>
		            <div class="col-md-12">
		                <select class="mdb-select" name="payer" id="payer">
	                        <option value="" disabled selected>Click to select...</option>
	                        <option value="1">Participant</option>
	                        <option value="2">Reservee</option>
	                    </select>
	                    <label for="payer">Payable for</label>
		            </div>
		            <div class="col-md-12">
		            	<input type="hidden" name="action" value="new_payment">
	                    <center><button type='submit' class="btn btn-outline-info waves-effect ml-auto" id='btnsubmit'>Create Payable</button></center>
	                </div>
                </div>
            </form>
            </div>	
	    </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/payment.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
	    // Sidenav Initialization
	    $(".button-collapse").sideNav();
	    var el = document.querySelector('.custom-scrollbar');
	    Ps.initialize(el);
	 });
    </script>
</html>