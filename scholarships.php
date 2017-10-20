<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }

    require_once('models/Scholarship.php');
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
                        <a class="btn btn-primary btn-lg btn-block" href="newscholarship.php">
                            <i class="fa fa-plus left"></i> New Scholarship
                        </a>
                        <div class="mt-2">
                            <small>Scholarship categories:</small>
                            <ul class="striped">
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
                                        <th><small>Scholarship Name</small></th>
                                        <th><small>Discount</small></th>
                                        <th><small>Status</small></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-md">
                                <?php 
                                    $scholarship = new Scholarship;
                                    foreach ($scholarship->get_scholarships() as $s) {
                                        echo "<tr>";
                                            echo "<td>";
                                                echo $s['scholarshipid'];
                                            echo "</td>";
                                            echo "<td><small>";
                                                echo "<a href='editscholarship.php?id=".$s['scholarshipid']."''>".$s['scholarshipName'];
                                            echo "</td></small>";
                                            echo "<td>";
                                                echo $s['discount'];
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<div class='switch'>
                                                    <label>
                                                      <input type='checkbox'";
                                                      if($s['status'] == 1){
                                                        echo "checked";
                                                      }
                                                echo " onclick='togglestatus(".$s['scholarshipid'].")'>
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
    <script src="public/js/app/scholarship.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            toastr.info("To update a scholarship click on the name");

            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);

            $('table').DataTable();
         });
    </script>
</html>