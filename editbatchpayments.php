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
      $batches = new Batch;
      $bi = $batches->get_batch($_GET['id']);

    require_once('models/Payment.php');
      $payment = new Payment;

    require_once('models/Scholarship.php');
      $scholarships     = new Scholarship;
      $ps = $batches->get_paymentschedule_by_batchid($_GET['id']);
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
     <main class="">
     <form id="frmbatchpayments">
      <div class="div-55-center">
          <div class="row">
            <div class="col-md-12">
                <div class="card pad pan mt-3">
                  <h4 class="blue-text">Update Batch Payables</h4>
                    <div class="FixedHeightContainer mt-3">
                      <div class="Content">
                        <div class="table-responsive">
                            <table class="table table-sm">
                              <thead class="mdb-color darken-3">
                                <tr class="white-text">
                                  <th class="text-center">Payment</th>
                                  <th class="text-center">Amount</th>
                                  <th class="text-center">BSED</th>
                                  <th class="text-center">BEED</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    <?php 
                                    $payments = Array();
                                        foreach ($payment->get_active_payments() as $p) {
                                            echo "<tr class='text-center'>";
                                            echo "<th scope='row'><small>".$p['payment']."</small></th>";
                                            echo "<td><small>".$p['amount']."</small></td>";
                                            echo "<td><small>
                                                    <input type='checkbox' id='bsed".$p['paymentid']."' onclick='togglepayments(\"bsed".$p['paymentid']."\",\"".$p['paymentid']."\",\"1\")'";
                                                    if ($batches->check_payable($p['paymentid'], '1', $_GET['id']) != 0) {
                                                        echo "checked";
                                                        array_push($payments, $payment->get_payment($p['paymentid'], '1'));
                                                    }
                                            echo ">
                                                    <label for='bsed".$p['paymentid']."'></label>
                                                </small></td>";
                                            echo "<td><small>
                                                    <input type='checkbox' id='beed".$p['paymentid']."' onclick='togglepayments(\"beed".$p['paymentid']."\",\"".$p['paymentid']."\",\"2\")'";
                                                    if ($batches->check_payable($p['paymentid'], '2', $_GET['id']) != 0) {
                                                        echo "checked";
                                                        array_push($payments, $payment->get_payment($p['paymentid'], '2'));
                                                    }
                                            echo ">
                                                    <label for='beed".$p['paymentid']."'></label>
                                                </small></td>";
                                            echo "</tr>";
                                        }
                                     ?>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                    <div>
                         <span class="float-right blue-text">
                         <hr> 
                           <small>BSED payment total: </small>₱ <span id="bsedtotal"><?php echo $batches->get_payable_total($_GET['id'], '1'); ?></span>
                         </span>
                     </div>
                     <div>
                        <span class="float-right blue-text">
                            <small>BEED payment total: </small>₱ <span id="beedtotal"><?php echo $batches->get_payable_total($_GET['id'], '2'); ?></span>
                        </span>
                     </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card pad pan">
                    <h6 cass="text-left"><b>Payment Schedule</b></h6>
                    <hr>
                    <div class="md-form">
                        <input type="text" name='sched1' id="sched1" class="form-control datepicker pan" value="<?php echo date("d M, Y", strtotime($ps['date1'])); ?>">
                        <label for="sched1">Schedule 1</label>
                        <input type="hidden" name="sched1">
                    </div>
                    <div class="md-form">
                        <input type="text" name='sched2' id="sched2" class="form-control datepicker pan" value="<?php echo date("d M, Y", strtotime($ps['date2'])); ?>">
                        <label for="sched2">Schedule 2</label>
                        <input type="hidden" name="sched1">
                    </div>
                    <div class="md-form">
                        <input type="text" name='sched3' id="sched3" class="form-control datepicker pan" value="<?php echo date("d M, Y", strtotime($ps['date3'])); ?>">
                        <label for="sched3">Schedule 3</label>
                        <input type="hidden" name="sched3">
                    </div>
                    <input type="hidden" name="payments" id="payments">
                    <input type="hidden" name="scholarships" id="scholarships">
                    <input type="hidden" name="batchid" id="batchid" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="action" value="update_paymentschedule">
                    <center><button type='submit' class="btn btn-outline-info waves-effect ml-auto mb-2" id="btnsubmit">Update payments</button></center>
               </div>
            </div>
          </div>
      </div>
      </form>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/editbatchpayments.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
      // Sidenav Initialization
      $(".button-collapse").sideNav();
      var el = document.querySelector('.custom-scrollbar');
      Ps.initialize(el);
   });
    </script>
    <script type="text/javascript">
          var today = new Date();
          var dd = today.getDate();
          var mm = today.getMonth();
          var yyyy = today.getFullYear();
          if(dd<10){
              dd='0'+dd;
          } 
          if(mm<10){
              mm='0'+mm;
          }
          
          $('.datepicker').pickadate({
          format: 'dd mmm, yyyy',
          formatSubmit: 'yyyy-mm-dd',
          min: new Date(yyyy, mm, dd),
          });

        var bsedpaymentcounter = <?php echo $batches->count_payables($_GET['id'], '1'); ?>;
        var beedpaymentcounter = <?php echo $batches->count_payables($_GET['id'], '2'); ?>;

        var bsedpaymenttotal = <?php echo $batches->get_payable_total($_GET['id'], '1'); ?>;
        var beedpaymenttotal = <?php echo $batches->get_payable_total($_GET['id'], '2'); ?>;
    </script>
</html>