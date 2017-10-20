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
<?php require('models/Batch.php'); ?>
<?php require('models/Enrollment.php'); ?>
<?php require('models/Payment.php'); ?>
<?php require('models/Scholarship.php'); ?>
<?php 
    $batches        = new Batch; 
    $batchinfo      = $batches->get_batch($_GET['id']);
    $batchid        = $batchinfo['batchid'];
    $enr            = new Enrollment;
    $saturday       = $enr->getSaturday($batchid)['sectionid'];
    $satcurcap      = $enr->getCurrentCapacity($saturday);
    $satcapacity    = $enr->getSaturday($batchid)['capacity'];
    $sunday         = $enr->getSunday($batchid)['sectionid'];
    $suncurcap      = $enr->getCurrentCapacity($sunday);
    $suncapacity    = $enr->getSunday($batchid)['capacity'];
    $ps             = $batches->get_paymentschedule_by_batchid($batchid);

    $pment          = new Payment;
    $scholar        = new Scholarship;
?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
     <main class="">
        <div class="container-fluid mb-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="card pad pan">
                        <h3 class="blue-text"><?php echo $batchinfo['batchno'] ?></h3>
                        <small><?php echo date("M d, Y", strtotime($batchinfo['dateStart']))." to ".date("M d, Y", strtotime($batchinfo['dateEnd'])) ?></small>
                        <br>
                        <small><b>Participants Enrolled:</b></small>
                        <ul class="striped">
                            <li><span class="bullet grey"></span>Saturday <span class="float-right"><?php echo $satcurcap ?></span></li>
                            <li><span class="bullet grey"></span>Sunday <span class="float-right"><?php echo $suncurcap ?></span></li>
                        </ul>
                        <div class="col-md-12">
                            <small class="grey-text float-right">Date Created: <?php echo date("M d, Y", strtotime($batchinfo['datestamp'])) ?></small><br>
                            <small class="grey-text float-right">Created By: </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card pad pan">
                        <h3 class="blue-text">Payments and Scholarships</h3>
                        <small><b>Payment Schedule:</b></small>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <center><i class="fa fa-calendar grey-text"></i> <?php echo date("M d, Y", strtotime($ps['date1'])) ?></center>
                            </div>
                            <div class="col-md-4">
                                <center><i class="fa fa-calendar grey-text"></i> <?php echo date("M d, Y", strtotime($ps['date2'])) ?></center>
                            </div>
                            <div class="col-md-4">
                                <center><i class="fa fa-calendar grey-text"></i> <?php echo date("M d, Y", strtotime($ps['date3'])) ?></center>
                            </div>
                        </div>
                    </div>
                    <div class="card pad pan">
                        <div class="row">
                            <div class="col-md-6">
                                <small><b>Payments for BSED:</b></small>
                                <ul class="striped mt-1">
                                    <?php 
                                        foreach ($batches->get_batch_bsed_payables($batchid) as $pbsed) {
                                            $payment = $pment->get_payment($pbsed['paymentid']);
                                            echo "<li>";
                                                echo $payment['payment']."<span class='float-right'>₱".$pbsed['updated_amount']."</span>";
                                            echo "</li>";
                                        }
                                     ?>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <small><b>Payments for BEED:</b></small>
                                <ul class="striped mt-1">
                                    <?php 
                                        foreach ($batches->get_batch_beed_payables($batchid) as $pbeed) {
                                            $payment = $pment->get_payment($pbeed['paymentid']);
                                            echo "<li>";
                                                echo $payment['payment']."<span class='float-right'>₱".$pbeed['updated_amount']."</span>";
                                            echo "</li>";
                                        }
                                     ?>
                                </ul>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="float-right">Total: ₱<?php echo $batches->get_bsed_payment_total($batchid); ?></span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="float-right">Total: ₱<?php echo $batches->get_beed_payment_total($batchid); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card pad pan">
                        <small><b>Scholarships offered:</b></small>
                        <ul class="striped mt-1">
                            <?php 
                                foreach ($batches->get_batch_scholarships($batchid) as $sc) {
                                    $scholarship = $scholar->get_scholarship($sc['scholarshipid']);
                                    echo "<li>";
                                        if ($scholarship['value'] == '') {
                                            echo "• ".$scholarship['scholarshipName']."<span class='float-right'>".$sc['updated_discount']."</span>";
                                        }else{
                                            echo "<small>".$scholarship['scholarshipName']."</small><br>"."<span class='float-right'>".$sc['updated_discount']."</span>";
                                            echo "• ".$scholarship['value'];
                                        }
                                    echo "</li>";
                                }
                             ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script type="text/javascript" src="public/js/app/editbatch.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
        // Sidenav Initialization
        $(".button-collapse").sideNav();
        var el = document.querySelector('.custom-scrollbar');
        Ps.initialize(el);
     });
    </script>
</html>