<!DOCTYPE html>
<html lang="en">
<?php require_once('models/Participant.php');
  session_start();
  if(!isset($_SESSION['id'])){
      header("location: login.php");
  }else if($_SESSION['status'] == 0){
      header("location: firstlogin.php");
  }
  $participant = new Participant;
  $p = $participant->get_student_data($_GET['id']);
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
    <main>
        <div class="div-80-center mb-3">
        <button class="btn red btn-back" data-toggle="tooltip" data-placement="bottom" title="Go back to participant's list"><i class="fa fa-arrow-left"></i></button>
            <br>
    <div class="card pad pan profile">
        <div class="avatar">
                <img src="<?php if($p['photo'] == ''){ echo "public/images/no_image.jpg"; }else{ echo $p['photo']; }?>" id="prof" class="rounded-circle waves-effect">
        </div>
        <h3><?php echo $p['firstname'].' '.$p['middlename'].' '.$p['lastname'];?></h3>
            <!--First row-->
    <div>
    <ul class="nav md-pills nav-justified pills-secondary">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel2" role="tab">Profile Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">Educational Attainment & Job Info</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel4" role="tab">Ledger</a>
        </li>
    </ul>

    <!-- Tab panels -->
    <div class="tab-content">
        <!--Panel 2-->
        <div class="tab-pane fade in show active" id="panel2" role="tabpanel">
            <br>
            <div class="card-block row">
        <div class="col-md-12 mb-1"><small class="blue-text"><strong>NAME:</strong></small></div>
         <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtfirstname" class="form-control" placeholder="<?php echo $p['firstname']?>" readonly>
                 <label for="txtfirstname" class="">First Name</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtmiddlename" class="form-control" placeholder="<?php echo $p['middlename']?>" readonly>
                 <label for="txtmiddlename" class="">Middle Name</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtlastname" class="form-control" placeholder="<?php echo $p['lastname']?>" readonly>
                 <label for="txtlastname" class="">Last Name</label>
            </div>
        </div>
        <div class="col-md-12 mb-1"><small class="blue-text"><strong>ADDRESS:</strong></small></div>
        <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtbarangay" class="form-control" placeholder="<?php echo $p['barangay']?>" readonly>
                 <label for="txtbarangay" class="">Barangay</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtcity" class="form-control" placeholder="<?php echo $p['city']?>" readonly>
                 <label for="txtcity" class="">City</label>
            </div>
        </div>
        <div class="col-md-4">
        <div class="md-form form-sm">
            <input type="text" id="txtprovince" class="form-control" placeholder="<?php echo $p['province']?>" readonly>
            <label for="txtrovince" class="">Province</label>
        </div>
        </div>
        <div class="col-md-12 mb-1"><small class="blue-text"><strong>BASIC INFORMATION:</strong></small></div>
        <div class="col-md-2">
            <div class="md-form">
                <input type="text" id="txtbirthdate" class="form-control" placeholder="<?php echo date("d M, Y", strtotime($p['birthdate']))?>" readonly>
                <label for="txtbirthdate">Birthdate</label>
            </div>
        </div>
        <div class="col-md-2">
            <div class="md-form form-sm">
                <input type="text" id="txtage" class="form-control" placeholder="<?php echo $p['age']?>" readonly>
                 <label for="txtage" class="">Age</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtcivil" class="form-control" placeholder="<?php echo $p['civilstatus']?>" readonly>
                 <label for="txtcivil" class="">Civil Status</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtreligion" class="form-control" placeholder="<?php echo $p['religion']?>" readonly>
                 <label for="txtreligion" class="">Religion</label>
            </div>
        </div>
        <div class="col-md-12 mb-1"><small class="blue-text"><strong>CONTACT INFORMATION:</strong></small></div>
        <div class="col-md-4">
            <div class="md-form form-sm">
                <input type="text" id="txtcontact" class="form-control" placeholder="<?php echo $p['phone']?>" readonly>
                 <label for="txtcontact" class="">Contact Number</label>
            </div>
        </div>
        <div class="col-md-4">
             <div class="md-form form-sm">
                <input type="text" id="txtemail" class="form-control" placeholder="<?php echo $p['email']?>" readonly>
                 <label for="txtemail" class="">Email Address</label>
            </div>
        </div>
         <div class="col-md-4">
             <div class="md-form form-sm">
                <input type="text" id="txtfacebook" class="form-control" placeholder="<?php echo $p['facebook']?>" readonly>
                 <label for="txtfacebook" class="">Facebook Account</label>
            </div>
        </div>
        </div>
        </div>
    <!--/.Panel 2-->

    <!--Panel 3-->
    <div class="tab-pane fade" id="panel3" role="tabpanel">
        <br>

        <div class="card-block row">
        <div class="col-md-12 mb-1"><small class="blue-text"><strong>EDUCATIONAL BACKGROUND:</strong></small></div>
            <div class="md-form form-sm col-md-6">
                <input type="text" id="txtprogram" class="form-control" placeholder="<?php echo $p['program']?>" readonly>
                <label for="txtprogram" class="">Program</label>
            </div>
            <div class="md-form form-sm col-md-6">
                <input type="text" id="txtprogram" class="form-control" placeholder="<?php echo $p['major']?>" readonly>
                <label for="txtprogram" class="">Major</label>
            </div>
            <div class="md-form form-sm col-md-12">
                <input type="text" id="txtschoolgrad" class="form-control" placeholder="<?php echo $p['school']?>" readonly>
                <label for="txtschoolgrad" class="">School Graduated</label>
            </div>
            <div class="md-form form-sm col-md-6">
                <input type="text" id="txtyeargrad" class="form-control" placeholder="<?php echo $p['yearGraduate']?>" readonly>
                <label for="txtyeargrad" class="">Year Graduated</label>
            </div>
            <div class="md-form form-sm col-md-6">
                <input type="text" id="txtyeargrad" class="form-control" placeholder="<?php echo $p['semGraduate']?>" readonly>
                <label for="txtyeargrad" class="">Year Graduated</label>
            </div>
            <?php if ($p['honors']!=""){?>
                <div class="md-form form-sm col-md-12">
                    <input type="text" id="txtresearch" class="form-control" placeholder="<?php echo $p['honors']?>" readonly>
                    <label for="txtresearch" class="">Honors</label>
                </div>
            <?php } ?>
            <?php 
                if ($p['seccourse_status'] == 1) {
                    echo "<div class='col-md-12 mb-1'><small class='blue-text'><strong>SECOND COURSE:</strong></small></div>
                    <div class='md-form form-sm col-md-6'>
                        <input type='text' id='form1' class='form-control' placeholder='".$p['secondprogram']."' readonly>
                        <label for='form1' class=''>Second Program</label>
                    </div>
                    <div class='md-form form-sm col-md-6'>
                        <input type='text' id='txtfacebook' class='form-control' placeholder='".$p['secondschool']."' readonly>
                        <label for='txtfacebook' class=''>School</label>
                    </div>";
                }
             ?>
            <?php 
                if($p['job_status'] == 1){
                    echo "<div class='col-md-12 mb-1'><small class='blue-text'><strong>JOB INFORMATION:</strong></small></div>
            <div class='md-form form-sm col-md-6'>
                <input type='text' id='txtfacebook' class='form-control' placeholder='".$p['company']."' readonly>
                <label for='form1' class=''>Company Name</label>
            </div>
            <div class='md-form form-sm col-md-6'>
                <input type='text' id='txtfacebook' class='form-control' placeholder='".$p['position']."' readonly>
                <label for='form1' class=''>Position</label>
            </div>";
                }
             ?>
        </div>

    </div>
    <!--/.Panel 3-->
    <div class="tab-pane fade" id="panel4" role="tabpanel">
        <br>
        <div class="card-block row">
            
        </div>
    </div>

</div>
        
                </div>
            </div>
        </div>
    </main>
    <!--/Main layout-->
    
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large blue" data-toggle="tooltip" data-placement="left" title="Option">
            <i class="fa fa-cog"></i>
        </a>
        <ul>
            <li><a id="btnEdit" class="btn-floating red"  data-toggle="tooltip" data-placement="left" title="Edit Information"><i class="fa fa-pencil-square-o"></i></a></li>
            <li><a id='btnbalance' class="btn-floating primary"  data-toggle="tooltip" data-placement="left" title="View Balance"><i class="fa fa-money"></i></a></li>
        </ul>
    </div>

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

         $('.datepicker').pickadate();
    </script>
    <script>
      /*document.getElementById('btnEdit').onclick= function(){
        location.href="editaccount.php?personid=<?php echo $row['personid']; ?>";
      };*/

      $('.btn-back').on('click', function(){
            window.location = "participants.php";
      });

      $('#btnbalance').on('click', function(){
            window.location = 'participantbalance.php?id=<?php echo $p['participantid']; ?>';
      });
  </script>
</html>