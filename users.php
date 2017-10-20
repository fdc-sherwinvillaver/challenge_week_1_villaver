<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }

    require_once('models/User.php');
    $u = new User;
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
                        <a class="btn btn-primary btn-lg btn-block" href="newuser.php">
                            <i class="fa fa-plus left"></i> New User
                        </a>
                        <div class="mt-2">
                            <small>User categories:</small>
                            <ul class="striped">
                                <li><span class="bullet orange"></span> Super Admin <span class="badge bg-primary float-right" id='countsuperadmin'></span></li>
                                <li><span class="bullet blue"></span> Admin <span class="badge bg-primary float-right" id='countadmin'></span></li>
                                <li><span class="bullet green"></span> Active <span class="badge bg-primary float-right" id='countactive'></span></li>
                                <li><span class="bullet red"></span> Inactive <span class="badge bg-primary float-right" id='countinactive'></span></li>
                                <li><span class="bullet purple"></span> Count <span class="badge bg-primary float-right" id='count'></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content card">
                        <h4 class="blue-text pad">Users</h4>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th><small>Name</small></th>
                                        <th><small>Username</small></th>
                                        <th><small>Access Level</small></th>
                                        <th><small>Status</small></th>
                                    </tr>
                                </thead>
                                <tbody class='tbody-md'>
                                        <?php foreach ($u->get_users($_SESSION['id']) as $user){
                                            $userid         = $user['userid'];
                                            $accountid      = $user['accountid'];
                                            $username       = $user['username'];
                                            $accesslvl      = $user['accesslevel'];
                                            $lastname       = $user['lastname'];
                                            $firstname      = $user['firstname'];
                                            $middlename     = $user['middlename'];
                                            $image          = $user['photo'];
                                            $status         = $user['status'];
                                            echo "<tr>";
                                                echo "<td><div class='avatar-placeholder'><img class='avatar-32 img-center' src='".$image."'></div></td>";
                                                echo "<td>";
                                                    if ($status == 0) {
                                                        echo "<small>No data available</small>";
                                                    }else{
                                                        echo "<a href='edituser.php?id=".$userid."'>".$lastname.", ".$firstname." ".$middlename."</a>";
                                                    }
                                                echo "</td>";
                                                echo "<td>";
                                                    echo $username;
                                                echo "</td>";
                                                echo "<td>";
                                                    if($accesslvl == '1'){
                                                        echo "Super Admin";
                                                    }else{
                                                        echo "Admin";
                                                    }
                                                echo "</td>";
                                                echo "<td>";
                                                    if ($status == 0) {
                                                        echo "<small>Must log in first to activate</small>";
                                                    }else{
                                                        echo "<div class='switch'>
                                                            <label>
                                                              <input type='checkbox'";
                                                              if($status == 1){
                                                                echo "checked";
                                                              }
                                                        echo " onclick='togglestatus(\"".$accountid."\")'>
                                                              <span class='lever'></span>
                                                            </label>
                                                          </div>";
                                                    }
                                                echo "</td>";
                                            echo "</tr>";
                                        } ?>
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
    <script src="public/js/app/user.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);

            $('table').DataTable();
            refresh_categories();
         });
    </script>
</html>