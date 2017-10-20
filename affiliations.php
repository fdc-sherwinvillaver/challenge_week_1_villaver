<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }

    require_once('models/Affiliation.php');
    $aff = new Affiliation;
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
                        <a class="btn btn-primary btn-lg btn-block" href="newaffiliation.php">
                            <i class="fa fa-plus left"></i> New Affiliation
                        </a>
                        <div class="mt-2">
                            <small>Affiliation categories:</small>
                            <ul class="striped">
                            	<li><span class="bullet green"></span> Active <span class="badge bg-primary float-right" id='bongoing'>0</span></li>
                                <li><span class="bullet red"></span> Inactive <span class="badge bg-primary float-right" id='bconcluded'>0</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content card">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center"><b><small>Affiliation</small></b></th>
                                        <th class="text-center"><b><small>Contact Person</small></b></th>
                                        <th class="text-center"><b><small>Status</small></b></th>
                                    </tr>
                                </thead>
                                <tbody class="tbody-sm">
                                <?php 
                                    $x = 0;
                                    foreach ($aff->get_affiliations() as $affiliation) {
                                        $x++;
                                        echo "<tr class='text-center'>";
                                            echo "<td>";
                                                echo $x;
                                            echo "</td>";
                                            echo "<td>";
                                                echo "<a href='affiliationinfo.php?id=".$affiliation['affiliationid']."'>".$affiliation['affiliationname']."</a>";
                                            echo "</td>";
                                            echo "<td><small>";
                                                echo $affiliation['lastname'].", ".$affiliation['firstname']." ".$affiliation['middlename'];
                                            echo "</small></td>";
                                            echo "<td>";
                                                echo "<div class='switch'>
                                                    <label>
                                                      <input type='checkbox'";
                                                      if($affiliation['status'] == 1){
                                                        echo "checked";
                                                      }
                                                echo " onclick='togglestatus(".$affiliation['affiliationid'].")'>
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
    <script src="public/js/app/affiliation.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){

            toastr.info("Info: Click affiliation for more info");
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);

            $('table').DataTable();
         });
    </script>
</html>