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
<?php require('models/Payment.php'); ?>
<?php require('models/Scholarship.php'); ?>
<?php $batches          = new Batch; ?>
<?php $payment          = new Payment; ?>
<?php $scholarships     = new Scholarship; ?>
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
                  <h4 class="blue-text">Batch Payables</h4>
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
                                        foreach ($payment->get_active_payments() as $p) {
                                            echo "<tr class='text-center'>";
                                            echo "<th scope='row'><small>".$p['payment']."</small></th>";
                                            echo "<td><small>".$p['amount']."</small></td>";
                                            echo "<td><small>
                                                    <input type='checkbox' id='bsed".$p['paymentid']."' onclick='togglepayments(\"bsed".$p['paymentid']."\",\"".$p['paymentid']."\",\"1\")'";
                                            echo ">
                                                    <label for='bsed".$p['paymentid']."'></label>
                                                </small></td>";
                                            echo "<td><small>
                                                    <input type='checkbox' id='beed".$p['paymentid']."' onclick='togglepayments(\"beed".$p['paymentid']."\",\"".$p['paymentid']."\",\"2\")'";
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
                           <small>BSED payment total: </small>₱ <span id="bsedtotal">0.00</span>
                         </span>
                     </div>
                     <div>
                        <span class="float-right blue-text">
                            <small>BEED payment total: </small>₱ <span id="beedtotal">0.00</span>
                        </span>
                     </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="card pad pan">
                    <h6 cass="text-left"><b>Payment Schedule</b></h6>
                    <hr>
                    <div class="md-form">
                        <input type="text" name='sched1' id="sched1" class="form-control datepicker pan">
                        <label for="sched1date">Schedule 1</label>
                        <input type="hidden" name="sched1">
                    </div>
                    <div class="md-form">
                        <input type="text" name='sched2' id="sched2" class="form-control datepicker pan">
                        <label for="sched1date">Schedule 2</label>
                        <input type="hidden" name="sched2">
                    </div>
                    <div class="md-form">
                        <input type="text" name='sched3' id="sched3" class="form-control datepicker pan">
                        <label for="sched1date">Schedule 3</label>
                        <input type="hidden" name="sched3">
                    </div>
                    <input type="hidden" name="batchno" id="batchno" value="<?php echo $_POST['batchno']; ?>">
                    <input type="hidden" name="dateStart_submit" id="dateStart_submit" value="<?php echo $_POST['dateStart_submit']; ?>">
                    <input type="hidden" name="dateEnd_submit" id="dateEnd_submit" value="<?php echo $_POST['dateEnd_submit']; ?>">
                    <input type="hidden" name="saturday" id="saturday" value="<?php echo $_POST['saturday']; ?>">
                    <input type="hidden" name="satCapacity" id="satCapacity" value="<?php echo $_POST['satCapacity']; ?>">
                    <input type="hidden" name="sunday" id="sunday" value="<?php echo $_POST['sunday']; ?>">
                    <input type="hidden" name="sunCapacity" id="sunCapacity" value="<?php echo $_POST['sunCapacity']; ?>">
                    <input type="hidden" name="action" value="set_paymentschedule">
                    <center><button type='submit' class="btn btn-outline-info waves-effect ml-auto" id="btnsubmit">Set payments</button></center>
               </div>
            </div>
          </div>
      </div>
      </form>
    </main>
    <!--/Main layout-->
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/batch.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
      // Sidenav Initialization
      $(".button-collapse").sideNav();
      var el = document.querySelector('.custom-scrollbar');
      Ps.initialize(el);
   });
    </script>
    <script type="text/javascript">
        var bsedpaymentcounter = 0;
        var beedpaymentcounter = 0;

        var bsedpaymenttotal = 0;
        var beedpaymenttotal = 0;
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
    </script>
</html>