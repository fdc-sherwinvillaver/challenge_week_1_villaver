<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }

    require_once('models/Enrollment.php');
    require_once('models/Batch.php');
    $b = new Batch;
    $b->validate_batch();
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3"> 
                    <div class="card-body">
                        <a class="btn btn-primary btn-lg btn-block" id="btnnewbatch">
                            <i class="fa fa-plus left"></i> New Batch
                        </a>
                        <div class="mt-2">
                            <small>Batch categories:</small>
                            <ul class="striped">
                                <li><span class="bullet green"></span> Active <span class="badge bg-primary float-right" id='bongoing'>0</span></li>
                                <li><span class="bullet red"></span> Inactive <span class="badge bg-primary float-right" id='bconcluded'>0</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content card pan">
                    <h4 class="blue-text pad">Batch list</h4>
                            <table>
                                <thead>
                                    <tr>
                                        <th id='t-head'></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-md">
                                <?php 
                                    $batches = new Enrollment;
                                    foreach ($batches->getBatch() as $batch) {
                                        $batchid        = $batch['batchid'];
                                        $saturday       = $batches->getSaturday($batchid)['sectionid'];
                                        $satcapacity    = $batches->getSaturday($batchid)['capacity'];
                                        $sunday         = $batches->getSunday($batchid)['sectionid'];
                                        $suncapacity    = $batches->getSunday($batchid)['capacity'];
                                        switch ($batch['status']) {
                                            case '1' || '2':
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo "<div class='card'>";
                                                             echo "<div class='card-block'>";
                                                                echo "<h6 class='card-title'>";
                                                                if($batch['status'] == 1){
                                                                    echo "<span class='bullet green'></span>";
                                                                }else if($batch['status'] == 2){
                                                                    echo "<span class='bullet yellow'></span>";
                                                                }
                                                                echo "<strong class='blue-text'>".$batch['batchno']."</strong></h6>";
                                                                echo "<a class='activator' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i cursor='hand' class='fa fa-ellipsis-v'></i></a>";
                                                                echo "<div class='dropdown-menu dropdown-ins dropdown-menu-right' aria-labelledby='userDropdown'>
                                                                        <a class='dropdown-item' href='editbatch.php?id=".$batchid."'>Update</a>";
                                                                     if($_SESSION['accesslvl'] == 1){
                                                                        echo "<a class='dropdown-item' href='editbatchpayments.php?id=".$batchid."'>Edit Payments</a>";
                                                                     }
                                                                echo "<a class='dropdown-item' href='batchparticipants.php?id=".$batchid."'>Manage participants</a>";
                                                                echo "</div>";
                                                                echo "<span class='item-details float-right'>".date("M d, Y", strtotime($batch['dateStart']))." to ".date("M d, Y", strtotime($batch['dateEnd']))."</span>";
                                                                echo "<span class='item-details'>Participants Enrolled [ Sat: ".$batches->getCurrentCapacity($saturday)."</span> | ";
                                                                echo "<span class='item-details'>Sun: ".$batches->getCurrentCapacity($sunday)."]</span>";
                                                            echo "</div>";
                                                        echo "</div>";
                                                    echo "</td>";
                                                echo "</tr>";
                                            break;
                                            case '0':
                                                echo "<tr>";
                                                    echo "<td>";
                                                        echo "<div class='card'>";
                                                             echo "<div class='card-block'>";
                                                                echo "<h6 class='card-title'>";
                                                                echo "<span class='bullet red'></span>";
                                                                echo "<strong class='grey-text'>".$batch['batchno']."</strong></h6>";
                                                                echo "<a class='activator' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i cursor='hand' class='fa fa-ellipsis-v'></i></a>";
                                                                echo "<div class='dropdown-menu dropdown-ins dropdown-menu-right' aria-labelledby='userDropdown'>
                                                                        <a class='dropdown-item' href='batchinfo.php?id=".$batchid."'>View batch info</a>";
                                                                echo "</div>";
                                                                echo "<span class='item-details float-right'>".date("M d, Y", strtotime($batch['dateStart']))." to ".date("M d, Y", strtotime($batch['dateEnd']))."</span>";
                                                                if($b->count_participant_with_no_result($saturday, $sunday) != 0){
                                                                    echo "<span class='item-details'>(Results has not yet been set)<a href='set_results.php?id=".$batch['batchid']."'> Set Results</a></span>";
                                                                }else{
                                                                    echo "<span class='item-details'><a href='results.php?id=".$batch['batchid']."'>View Results</a></span>";
                                                                }
                                                        echo "</div>";
                                                    echo "</td>";
                                                echo "</tr>";
                                            break;
                                        }
                                    }
                                 ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header">
                        <h4 class="modal-title w-100" id="myModalLabel">Enroll</h4>
                    </div>
                    <!--Body-->
                    <div class="modal-body">
                        <div class="div-55-center">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalpayments">New</button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalpayments">Existing</button>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
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
    <script src="public/js/app/batch.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            $('table').DataTable();

            $('#t-head').click();
         });
    </script>
    <script type="text/javascript">
     $(document).ready(function(){
        // Sidenav Initialization
        $(".button-collapse").sideNav();
        var el = document.querySelector('.custom-scrollbar');
        Ps.initialize(el);
     });
    </script>
</html>