<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }
    
    require_once('models/Payment.php');
    $payments = new Payment;
    $payment = $payments->get_payment($_GET['id']);
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <main class="">
    <form id='frmupdatepayment'>
	    <div class="div-55-center">
	    	<div class="card pad mt-3">
        <h4 class="blue-text">Update Payable</h4>
                <div class="row mt-3">
                	<div class="col-md-12">
		                <div class="md-form">
		                    <input type="text" id="payment" name="payment" class="form-control" value='<?php echo $payment['payment'] ?>' autofocus>
		                    <label for="paymentname" class="">Payment Code</label>
		                </div>
		            </div>
		            <div class="col-md-12">
		                <div class="md-form">
		                    <input type="text" id="amount" name="amount" class="form-control" value="<?php 	echo $payment['amount'] ?>">
		                    <label for="amount" class="">Updated Amount</label>
		                </div>
		            </div>
                </div>
                <div class="col-md-12">
                    <input type="hidden" name="paymentid" value="<?php echo $_GET['id'] ?>">
                    <input type="hidden" name="action" value="update_payment">
                    <center><button type='submit' class="btn btn-outline-info waves-effect ml-auto" id='btnsubmit'>Update</button></center>
                </div>
            </div>
	    </div>
	    </form>
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