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
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
     <main class="">
     <form id="frmbatch" method="POST" action="batchpayments.php">
      <div class="div-55-center">
        <div class="row">
            <div class="col-md-12">
                <div class="card pan pad mt-3">
                <h4 class='blue-text'>New Batch</h4>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="md-form">
                                <label for='batchno' class="active">Batch Number</label>
                                <input type="text" name='batchno' id='batchno' class='form-control' value=' ' readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" name="dateStart" id="dateStart" class="datepicker">
                                <label for="dateStart" class="active">Start Date of Review</label>                              
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" name="dateEnd" id="dateEnd" class="datepicker">
                                <label for="dateEnd" class="active">End Date of Review</label>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="row">
                   <div class="col-md-6">
                       <div class="card pad pan">
                            <div class="row">
                                <div class="md-form form-sm">
                                    <input type="checkbox" name="saturday" id="saturday">
                                    <label for="saturday">Saturday Section</label>
                                </div>
                                <div class="col-md-12 sat" style='display:none;'>
                                    <div class="md-form">
                                        <input type="text" name='satCapacity' id="satCapacity" class="form-control">
                                        <label for="satCapacity">Capacity</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="card pan pad">
                            <div class="row">
                                <div class="md-form form-sm">
                                    <input type="checkbox" name="sunday" id="sunday">
                                    <label for="sunday">Sunday Section</label>
                                </div>
                                <div class="col-md-12 sun" style='display:none;'>
                                    <div class="md-form">
                                        <input type="text" name='sunCapacity' id="sunCapacity" class="form-control">
                                        <label for="sunCapacity">Capacity</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
               </div>
               <div class="card">
                    <input type="hidden" name="action" value="new_batch">
                    <center><button type='submit' class="btn btn-outline-info waves-effect ml-auto float-right" id="btnsubmit">Create New Batch</button></center>
                </div>
            </div>
        </div>
      </div>
      </form>
    </main>

    <div class="modal fade" id="modal_alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Ooops...</h4>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <p>Please set payments for BSED and BEED participants</p>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <div class="div-80-center">
                        <center><button type="button" id="btn_modal_alert" class="btn btn-warning">Manage Payments</button></center>
                    </div>
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
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