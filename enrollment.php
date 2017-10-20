<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }

    require_once('models/Batch.php');
    require_once('models/Scholarship.php');

    $batches = new Batch;
    $batchid = $batches->get_batch_by_section_id($_POST['section'])['batchid'];

    $sc      = new Scholarship;
    $scs     = $sc->get_active_scholarships();
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php');?>
</head>
<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
     <main class="">
     <div class="div-85-center">
         <div class="row mt-3">
             <div class="col-md-5">
                <div class="col-md-12">
                    <section class="invoice row mb-r">
                          <div class="col-2"><img src="<?php if($_POST['profimg'] == ''){ echo 'public/images/no_image.jpg';}else{ echo $_POST['profimg']; }  ?>" class="rounded-circle mt-0 img-center testimonial"></div>
                        <div class="col-10 text-right">
                                <h4 class="h4-responsive"><strong><span class="blue-text"><?php echo $batches->get_batch_by_section_id($_POST['section'])['batchno'] ?></span></strong></h4>
                                <p><?php echo $batches->get_section($_POST['section']); ?> Section</p>
                            </div>

                            <div class="col-md-12">
                                <div class="row invoice-data">
                                    <div class="col-6">
                                        <img src="">
                                        <h6><strong><?php echo $_POST['lastname'].", ".$_POST['firstname']." ".$_POST['middlename'] ?>, 19</strong></h6>
                                        <p><?php echo $_POST['gender'].", ".$_POST['civilstatus']; ?></p>
                                    </div>

                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <small class="blue-text"><b>Current Location</b></small>
                                            <div>
                                            <?php echo $_POST['barangay'].", ".$_POST['city']; ?>,
                                            <?php echo $_POST['province']; ?>
                                                 <hr>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <small class="blue-text"><b>Contact Information</b></small>
                                            <div>
                                            <i class="fa fa-phone"></i> <?php echo $_POST['phone']; ?><br>
                                            <i class="fa fa-envelope-o"></i> <?php echo $_POST['email']; ?><br>
                                            <i class="fa fa-facebook-square"></i> <?php echo $_POST['facebook']; ?>
                                                 <hr>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <small class="blue-text"><b>Educational Background</b></small>
                                            <div>
                                            Studied <?php echo "<b>".$_POST['program']."</b>"; ?> major in <?php echo "<b>".$_POST['major']."</b>"; ?> at <?php echo "<b>".$_POST['school']."</b>"; ?>
                                                 <hr>
                                            </div>
                                        </div>
                                        <?php 
                                            if($_POST['seccourse_status'] == '1'){
                                                echo "<div class='table-responsive'>
                                                    <small><b>Second Course</b></small>
                                                    <div>
                                                    <small>Took <b>".$_POST['secondprogram']."</b> at ". "<b>".$_POST['secondschool']."</b></small>
                                                         <hr>   
                                                    </div>
                                                </div>";
                                            }

                                            if($_POST['job_status'] == '1'){
                                                echo "<div class='table-responsive mb-1'>
                                                    <small><b>Job</b></small>
                                                    <div>
                                                    <small><b>".$_POST['position']."</b> at <b>".$_POST['company']."</b><br></small>
                                                    </div>
                                                </div>";
                                            }
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                </div>
            </div>
            <div class="col-md-7">
            <section class="invoice row mb-r">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <small class="blue-text"><b> Payments</b></small>
                                <div>
                                    <?php 
                                        $batches = new Batch;
                                        $payments = Array();
                                        if ($_POST['program'] == 'BSED') {
                                            foreach ($batches->get_batch_bsed_payables($batchid) as $bsed) {
                                                $paymentinfo = $batches->get_payment($bsed['paymentid']);
                                                echo "<small>".$paymentinfo['payment']."</small> ";
                                                    echo "<span class='float-right'>";
                                                        echo "₱ ".$paymentinfo['amount'];
                                                    echo "</span>";
                                                echo "</br>";
                                                array_push($payments, $bsed['paymentid']);
                                            }
                                        }else if($_POST['program'] == 'BEED'){
                                            foreach ($batches->get_batch_beed_payables($batchid) as $beed) {
                                                 $paymentinfo = $batches->get_payment($beed['paymentid']);
                                                echo "<small>".$paymentinfo['payment']."</small> ";
                                                    echo "<span class='float-right'>";
                                                        echo "₱ ".$paymentinfo['amount'];
                                                    echo "</span>";
                                                echo "</br>";
                                                array_push($payments, $beed['paymentid']);
                                            }
                                        }
                                     ?>
                                     <hr>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <small class="blue-text"><b> Downpayment</b></small>
                                <span class="float-right">₱500</span>
                                <hr>
                            </div>  
                            <div class="table-responsive">
                                <small class="blue-text"><b> Scholarship/Discount</b></small>
                                <a data-toggle="modal" data-target="#basicExample" class="float-right"><small>Add Scholarship/Discount</small> <i class="fa fa-plus-circle green-text"></i></a>
                                <ul class="striped" id='participantscholarships'>
                                    
                                </ul>
                                <div id="nodisc"><p class="text-center grey-text">No discount.</p></div>
                                <div id="ptotal">
                                    <?php
                                    $total;
                                    if($_POST['program'] == 'BSED') {
                                        $total = $batches->get_bsed_payment_total($batchid);
                                    }else if($_POST['program'] == 'BEED'){
                                        $total = $batches->get_beed_payment_total($batchid);
                                        }
                                     ?>
                                     <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 float-md-right ml-auto">
                            <span class="float-right" id="paymenttotal">
                            <strong>TOTAL: </strong>
                                <?php  echo " ₱ ".$total;?>
                            </span>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="action" value="enroll_participant">
                            <button type='button' class="btn btn-outline-info waves-effect ml-auto float-right" id='btnsubmit'>Enroll <i class="fa fa-check"></i></button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
         </div>
     </div>
    </main>

    <div class="modal fade" id="basicExample" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content">
            <form id="frmsc">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Available Scholarship/Discount</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <small>Scholarship <span class="float-right">Discount</span></small>
                        <ul class="striped">
                        <?php 
                            foreach ($scs as $scholarship) {
                                echo "<li>";
                                    echo "<div class='form-group'>
                                            <input type='checkbox' name='sc".$scholarship['scholarshipid']."' id='sc".$scholarship['scholarshipid']."' value='".$scholarship['scholarshipid']."'>
                                            <label for='sc".$scholarship['scholarshipid']."'>".$scholarship['scholarshipName']."</label>
                                            <span class='float-right'>₱".$scholarship['discount']."</span>
                                        </div>";
                                echo "</li>";
                            }
                         ?>
                    </ul>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <input type="hidden" name="action" value="participantscholarships">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnsc" class="btn btn-primary" data-dismiss="modal">Add</button>
                </div>
                </form>
            </div>
            <!--/.Content-->
        </div>
    </div>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/enrollment.js?9-23_10:01PM"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);
         });

        var total       = <?php echo $total ?>;
        var scholarships = <?php echo json_encode($sc) ?>;
        var payments    = <?php echo json_encode($payments) ?>;
        var participantno = "<?php echo $_POST['participantno'] ?>";
        var firstname   = "<?php echo $_POST['firstname']           ?>";
        var middlename  = "<?php echo $_POST['middlename']          ?>";
        var lastname    = "<?php echo $_POST['lastname']            ?>";
        var gender      = "<?php echo $_POST['gender']              ?>";
        var birthdate   = "<?php echo $_POST['bdate_submit']        ?>";
        var cstatus     = "<?php echo $_POST['civilstatus']         ?>";
        var religion    = "<?php echo $_POST['religion']            ?>";
        var barangay    = "<?php echo $_POST['barangay'];           ?>";
        var city        = "<?php echo $_POST['city']                ?>";
        var province    = "<?php echo $_POST['province']            ?>";
        var phone       = "<?php echo $_POST['phone']               ?>";
        var email       = "<?php echo $_POST['email']               ?>";
        var program     = "<?php echo $_POST['program']             ?>";
        var major       = "<?php echo $_POST['major']               ?>";
        var school      = "<?php echo $_POST['school']              ?>";
        var semgrad     = "<?php echo $_POST['semesterGraduated']   ?>";
        var yrgrad      = "<?php echo $_POST['yearGraduated']       ?>";
        var secCourse   = "<?php echo $_POST['seccourse_status']    ?>";
        var sec         = "<?php echo $_POST['secondprogram']       ?>";
        var secschool   = "<?php echo $_POST['secondschool']        ?>";
        var isEmployed  = "<?php echo $_POST['job_status']          ?>";
        var position    = "<?php echo $_POST['position']            ?>";
        var company     = "<?php echo $_POST['company']             ?>";
        <?php if(isset($_POST['honors'])){
            echo "var honors =\"".$_POST['honors']."\";";
        }else{
            echo "var honors ='-';";
        } ?>
        var section     = "<?php echo $_POST['section']             ?>";
        var facebook    = "<?php echo $_POST['facebook']            ?>";
        var x           = "<?php echo $_POST['x']                   ?>";
        var image       = "<?php echo $_POST['profimg']             ?>";
        <?php if (isset($_POST['id'])){
            print "var id=".$_POST['id'].";";
        } ?>
    </script>
</html>