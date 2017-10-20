<?php 
require_once('models/User.php');
$user = new User();
$userinfo = $user->get_userdata($_SESSION['id']);
?>
<!--Double navigation-->
<header>
    <!-- Sidebar navigation -->
    <ul id="slide-out" class="side-nav fixed sn-bg-1 custom-scrollbar">
        <!-- Logo -->
        <li>
            <div class="user-box">
                <img <?php if($userinfo['photo'] == ''){ echo "src='public/images/no_image.jpg'";}else{ echo "src='".$userinfo['photo']."'"; } ?> class="img-fluid rounded-circle">
                <p class="user text-center black-text"><?php echo $userinfo['lastname'].", ".$userinfo['firstname']." ".$userinfo['middlename']; ?></p>
            </div>
        </li>
        <!--/. Logo -->
        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-plus-square"></i> Manage<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <?php if($_SESSION['accesslvl'] == 1){
                                echo "<li><a href='users.php' class='waves-effect'>- Users</a></li>";
                                echo "<li><a href='payments.php' class='waves-effect'>- Payables</a></li>";                            
                                echo "<li><a href='scholarships.php' class='waves-effect'>- Scholarships</a></li>";
                            } ?>
                            <li><a href='participants.php' class='waves-effect'>- Participants</a></li>
                            <li><a href='Affiliations.php' class='waves-effect'>- Affiliations</a></li>
                            <li><a href='batches.php' class='waves-effect'>- Batches</a></li>
                        </ul>
                    </div>
                </li>
                <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-paperclip"></i> Transaction<i class="fa fa-angle-down rotate-icon"></i></a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a data-target="#modalenroll" data-toggle="modal" class="waves-effect">- Enrollment</a></li>
                            <li><a href="reservations.php" class="waves-effect">- Reservation</a></li>
                            <li><a href="payment.php" class="waves-effect">- Payment</a></li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" class="collapsible-header waves-effect arrow-r">
                        <i class="fa fa-table" aria-hidden="true"></i> Reports
                    </a>
                </li>
                <li>
                    <a href="#" class="collapsible-header waves-effect arrow-r">
                        <i class="fa fa-pie-chart"></i> Analytics
                    </a>
                </li>
            </ul>
        </li>
        <!--/. Side navigation links -->
        <div class="sidenav-bg mask-strong"></div>
    </ul>
    <!--/. Sidebar navigation -->
    
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">
       
        <!-- SideNav slide-out button -->
        <div class="float-left">
            <a href="#" data-activates="slide-out" class="button-collapse"><i class="fa fa-bars"></i></a>
            
        </div>
        
        <!-- Breadcrumb-->
        <ol class="breadcrumb hidden-lg-down">
            <li class="breadcrumb-item active">
                <a href="index.php">
                    <img src="public/images/logo-bw.png">
                </a>
            </li>
        </ol>
        
        <!--Navbar links-->
        <ul class="nav navbar-nav nav-flex-icons ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                    <span class="hidden-sm-down"><?php echo $userinfo['firstname']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-ins dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="editprofile.php?id=<?php echo $_SESSION['id'] ?>">Update profile</a>
                    <a class="dropdown-item" href="editaccount.php?id=<?php echo $_SESSION['id'] ?>">My account</a>
                    <div class="dropdown-divider"></div>  
                    <a class="dropdown-item" href="logout.php">Log Out</a>
                </div>
            </li>
        </ul>
        <!--/Navbar links-->
        
    </nav>
    <!-- /.Navbar -->
    
</header>
<!--/.Double navigation-->


<div class="modal fade" id="modalenroll" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Enrollment</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="div-90-center">
                    <a type="button" class="btn btn-success" href="newparticipant.php">New participant</a>
                    <a type="button" class="btn btn-primary" href="participants.php">Existing participant</a>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>