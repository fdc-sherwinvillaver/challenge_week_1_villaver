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
<?php require_once('models/Enrollment.php'); ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
    <?php include('partials/datatable_styles.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
     <main class="">
        <div class="container-fluid">
        <div class="col-md-3">
        <button class="btn btn-primary col-md-12" data-toggle="modal" data-target="#modalpayment"><i class="fa fa-plus"></i> New payment</button>
        </div>
            <div class="card pad pan">
                <table class="table table-sm">
                    <thead class="">
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Payment for</th>
                            <th>Amount Paid</th>
                            <th>Change</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody class="tbody-md">
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="modalpayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title w-100" id="myModalLabel">Payment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="search" name="names" id="names" class="form-control mdb-autocomplete">
                                <button class="mdb-autocomplete-clear">
                                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                                        <path d="M0 0h24v24H0z" fill="none" />
                                    </svg>
                                </button>
                                <label for="school">Name</small></label>
                            </div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary"><i class="fa fa-check"></i> Pay</button>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
    </main>
    <!--/Main layout-->
</body>
    <?php include('partials/scripts.php'); ?>
    <?php include('partials/datatable_scripts.php'); ?>
    <script src="public/js/app/transact.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);

            $('table').DataTable();
         });
    </script>
</html>