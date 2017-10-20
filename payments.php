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
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
    <?php include('partials/datatable_styles.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
     <main class="">

        <div class="div-90-center">
            <div class="row">
                <div class="col-md-3"> 
                    <div class="card-body">
                        <a class="btn btn-primary btn-lg btn-block" href="newpayment.php">
                            <i class="fa fa-plus left"></i> New Payable
                        </a>
                        <div class="mt-2">
                            <small>Payment categories:</small>
                            <ul class="striped">
                                <li><span class="bullet orange"></span> Participant payables <span class="badge bg-primary float-right" id='countparticipant'></span></li>
                                <li><span class="bullet blue"></span> Reservee payables <span class="badge bg-primary float-right" id='countreservee'></span></li>
                            	<li><span class="bullet green"></span> Active <span class="badge bg-primary float-right" id='countactive'></span></li>
                                <li><span class="bullet red"></span> Inactive <span class="badge bg-primary float-right" id='countinactive'></span></li>
                                <li><span class="bullet purple"></span> Count <span class="badge bg-primary float-right" id='count'></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 offset-md-1">
                    <div class="tab-content card">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><b><small>Payable</small></b></th>
                                        <th><b><small>Amount</small></b></th>
                                        <th><b><small>Payer</small></b></th>
                                        <th><b><small>Status</small></b></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-md">
                                <?php 
                                    $payments = new Payment;
                                    foreach ($payments->get_payments() as $payment) {
                                        $paymentid = $payment['paymentid'];
                                        $paymentname = $payment['payment'];
                                        $amount      = $payment['amount'];
                                        $status      = $payment['status'];
                                        $payer       = $payment['payer'];
                                        echo "<tr>";
                                        	echo "<td>";
                                        		echo $paymentid;
                                        	echo "</td>";
                                        	echo "<td><small>";
                                        		echo "<a href='editpayment.php?id=".$paymentid."'>".$paymentname;
                                        	echo "</small></td>";
                                        	echo "<td>";
                                        		echo $amount;
                                        	echo "</td>";
                                        	echo "<td><small>";
                                                if ($payer == 1) {
                                                    echo "Participants";
                                                }else{
                                                    echo "Reservee";
                                                }
                                        	echo "</small></td>";
                                            echo "<td>";
                                                echo "<div class='switch'>
                                                    <label>
                                                      <input type='checkbox'";
                                                      if($status == 1){
                                                        echo "checked";
                                                      }
                                                echo " onclick='togglestatus(".$paymentid.")'>
                                                      <span class='lever'></span>
                                                    </label>
                                                  </div>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                 ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!--/Main layout-->
</body>
    <?php include('partials/scripts.php'); ?>
    <?php include('partials/datatable_scripts.php'); ?>
    <script src="public/js/app/payment.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){

            toastr.info("Info: Click payable to update");
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);

            $('table').DataTable();
         });
    </script>
</html>