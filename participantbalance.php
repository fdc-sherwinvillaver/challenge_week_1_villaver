<!DOCTYPE html>
<html lang="en">
<?php require_once('models/Participant.php'); ?>
<?php require_once('models/Batch.php'); ?>
<?php require_once('models/Payment.php');
  require_once('models/Scholarship.php');
  session_start();
  if(!isset($_SESSION['id'])){
      header("location: login.php");
  }else if($_SESSION['status'] == 0){
      header("location: firstlogin.php");
  }
  $participant = new Participant;
  $batch       = new Batch;
  $payment     = new Payment;
  $scholarship     = new Scholarship;

  $p_info = $participant->get_student_data($_GET['id']);
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <main>
       <div class='div-50-center'>
           <div class="card pad pan mt-3 mb-3">
           <h4 class="blue-text">Balance</h4>
           <span><?php echo $p_info['lastname'].", ".$p_info['middlename']." ".$p_info['firstname'];?></span>
               <div class="row mt-1">
                   <div class="col-md-12">
                       <ul class="striped">
                           <?php 
                                foreach ($batch->get_all_enrollment_by_participantid($_GET['id']) as $enr) {
                                    echo "<li>";
                                        $batchinfo = $batch->get_batch_by_section_id($enr['sectionid']);
                                        echo "<span class='blue-text'>Enrolled in ".$batchinfo['batchno']."</span><br>";
                                        echo "<small class='grey-text'>";
                                            echo date("M d, Y", strtotime($batchinfo['dateStart']))." to ";
                                            echo date("M d, Y", strtotime($batchinfo['dateEnd']));
                                        echo "</small><br>";
                                        echo "<div class='mt-1 mb-5'>";
                                            echo "<small>";
                                                echo "Payables:";
                                                  echo "<ol>";
                                                    $grosspayable = 0;
                                                      if ($p_info['program'] == 'BSED') {
                                                        foreach ($batch->get_batch_bsed_payables($batchinfo['batchid']) as $payable) {
                                                          echo "<li>";
                                                                    echo $payment->get_payment($payable['paymentid'])['payment'];
                                                                    echo "<span class='float-right'>";
                                                                        echo "₱ ".$payable['updated_amount'];
                                                                    echo "</span>";
                                                                    $grosspayable += $payable['updated_amount'];
                                                          echo "</li>";
                                                        }
                                                      }else if($p_info['program'] == 'BEED'){
                                                        foreach ($batch->get_batch_beed_payables($batchinfo['batchid']) as $payable) {
                                                          echo "<li>";
                                                                    echo $payment->get_payment($payable['paymentid'])['payment'];
                                                                    echo "<span class='float-right'>";
                                                                        echo "₱ ".$payable['updated_amount'];
                                                                    echo "</span>";
                                                                    $grosspayable += $payable['updated_amount'];
                                                          echo "</li>";
                                                        }
                                                      }
                                                      echo "</ol>";
                                                    echo "<span class='float-right'><br>";
                                                        echo "<span class='orange-text'>GROSS PAYABLE: </span>₱ <b>".$grosspayable;
                                                    echo "</b></span><br>";
                                                echo "Discounts:";
                                                echo "<ol>";
                                                $totaldisc = 0;
                                                    foreach ($batch->get_participant_scholarship($enr['sectionparticipantid']) as $sc) {
                                                        echo "<li>";
                                                          echo $sc['scholarship'];
                                                          echo "<span class='float-right'>";
                                                              echo "₱ ".$sc['discount'];
                                                          echo "</span>";
                                                        echo "</li>";
                                                        $totaldisc += $sc['discount'];
                                                    }
                                                    echo "</ol>";
                                                echo "<ol class='float-right'>";
                                                  echo "<li> <span class='green-text'>TOTAL DISCOUNT:</span> ₱ ".$totaldisc."</li>";
                                                  echo "<li> <span>NET PAYABLE: ₱ </span>".floatval($grosspayable-$totaldisc)."</li>";
                                                echo "</ol>";
                                            echo "</small>";
                                        echo "</div>";
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
    <script src="public/js/app/participant.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);
         });
    </script>
    <script>    
      $('.btn-back').on('click', function(){
            window.location = "participants.php";
      });
  </script>
</html>