<!DOCTYPE html>
<html lang="en">
<?php require_once('models/Participant.php');
  session_start();
  if(!isset($_SESSION['id'])){
      header("location: login.php");
  }else if($_SESSION['status'] == 0){
      header("location: firstlogin.php");
  }
 $db=db();
 $personid=$_GET["personid"];
 $query="SELECT * FROM person INNER JOIN participants ON person.personid= participants.personid INNER JOIN sectionparticipants on participants.participantid= sectionparticipants.participantid INNER JOIN sections ON sectionparticipants.sectionid = sections.sectionid INNER JOIN batches ON sections.batchid = batches.batchid INNER JOIN education on participants.educationid = education.educationid INNER JOIN jobs on jobs.jobid = participants.jobid WHERE person.personid=$personid";
 $display = mysqli_query($db, $query);
 $row = mysqli_fetch_array($display);?>
 
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
    <main>
        <div class="div-80-center mb-3">

        
        <button class="btn red btn-back" data-toggle="tooltip" data-placement="bottom" title="Go back to participant's list"><a class="text-white" href="batchparticipants.php?id=<?php echo $row['batchid']; ?>"><i class="fa fa-arrow-left"></i></a></button>
            <br>
                <div class="card pad pan profile">
                    <div class="avatar">
                            <img src="<?php echo $row['photo']?>" id="prof" class="rounded-circle waves-effect">
                    </div>
                    <h3><?php echo $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];?></h3>
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
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtfirstname" class="form-control" placeholder="<?php echo $row['firstname']?>" readonly>
                                       <label for="txtfirstname" class="">First Name</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtmiddlename" class="form-control" placeholder="<?php echo $row['middlename']?>" readonly>
                                       <label for="txtmiddlename" class="">Middle Name</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtlastname" class="form-control" placeholder="<?php echo $row['lastname']?>" readonly>
                                       <label for="txtlastname" class="">Last Name</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtbarangay" class="form-control" placeholder="<?php echo $row['barangay']?>" readonly>
                                       <label for="txtbarangay" class="">Barangay</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtcity" class="form-control" placeholder="<?php echo $row['city']?>" readonly>
                                       <label for="txtcity" class="">City</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtprovince" class="form-control" placeholder="<?php echo $row['province']?>" readonly>
                                       <label for="txtrovince" class="">Province</label>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="md-form">
                                    <input type="text" id="txtbirthdate" class="form-control" placeholder="<?php echo date("d M, Y", strtotime($row['birthdate']))?>" readonly>
                                    <label for="txtbirthdate">Birthdate</label>
                                  </div>
                                </div>
                                <div class="col-md-2">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtage" class="form-control" placeholder="<?php echo $row['age']?>" readonly>
                                      <label for="txtage" class="">Age</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtcivil" class="form-control" placeholder="<?php echo $row['civilstatus']?>" readonly>
                                      <label for="txtcivil" class="">Civil Status</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtreligion" class="form-control" placeholder="<?php echo $row['religion']?>" readonly>
                                       <label for="txtreligion" class="">Religion</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtcontact" class="form-control" placeholder="<?php echo $row['phone']?>" readonly>
                                      <label for="txtcontact" class="">Contact Number</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                  <div class="md-form form-sm">
                                      <input type="text" id="txtemail" class="form-control" placeholder="<?php echo $row['email']?>" readonly>
                                      <label for="txtemail" class="">Email Address</label>
                                  </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="md-form form-sm">
                                      <input type="text" id="txtfacebook" class="form-control" placeholder="<?php echo $row['facebook']?>" readonly>
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
                <div class="md-form form-sm col-md-6">
                                <input type="text" id="txtprogram" class="form-control" placeholder="<?php echo $row['program']?>" readonly>
                                <label for="txtprogram" class="">Program</label>
                                </div>
                                <div class="md-form form-sm col-md-6">
                                <input type="text" id="txtprogram" class="form-control" placeholder="<?php echo $row['major']?>" readonly>
                                <label for="txtprogram" class="">Major</label>
                                </div>
                                <div class="md-form form-sm col-md-5">
                                    <input type="text" id="txtschoolgrad" class="form-control" placeholder="<?php echo $row['school']?>" readonly>
                                     <label for="txtschoolgrad" class="">School Graduated</label>
                                </div>
                                <div class="md-form form-sm col-md-3">
                                    <input type="text" id="txtyeargrad" class="form-control" placeholder="<?php echo $row['yearGraduate']?>" readonly>
                                     <label for="txtyeargrad" class="">Year Graduated</label>
                                </div>
                            <?php if ($row['honors']!=""){?>
                                <div class="md-form form-sm col-md-4">
                                    <input type="text" id="txtresearch" class="form-control" placeholder="<?php echo $row['honors']?>" readonly>
                                     <label for="txtresearch" class="">Honors</label>
                                </div>
                            <?php } ?>
                <div class="md-form form-sm col-md-6">
                    <input type="text" id="txtfacebook" class="form-control" placeholder="<?php echo $row['company']?>" readonly>
                     <label for="form1" class="">Company Name</label>
                </div>
                <div class="md-form form-sm col-md-6">
                    <input type="text" id="txtfacebook" class="form-control" placeholder="<?php echo $row['position']?>" readonly>
                     <label for="form1" class="">Position</label>
                </div>
        </div>

    </div>
    <!--/.Panel 3-->
    <div class="tab-pane fade" id="panel4" role="tabpanel">
        <br>
        <div class="card-block row">
            <table class="table table-hover ledger">
              <thead class="mdb-color darken-3">
                <tr class="text-white">
                  <th colspan="2">Date</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Balance</th>
                  <th>Type</th>
                  <th colspan="3">Remarks</th>
                  <th colspan="2">Term</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td colspan="2">11/13/2014 6:15:20 PM</td>
                  <td>28542.96</td>
                  <td>0.00</td>
                  <td>28542.96</td>
                  <td>BAL</td>
                  <td colspan="3">Assessment for Review AY 2017</td>
                  <td colspan="2">Batch 1 : 2017</td>
                </tr>
                <tr>
                  <td colspan="2">11/13/2014 6:15:20 PM</td>
                  <td>28542.96</td>
                  <td>0.00</td>
                  <td>28542.96</td>
                  <td>BAL</td>
                  <td colspan="3">Assessment for Review AY 2017</td>
                  <td colspan="2">Batch 1 : 2017</td>
                </tr>
                <tr>
                  <td colspan="2">11/13/2014 6:15:20 PM</td>
                  <td>28542.96</td>
                  <td>0.00</td>
                  <td>28542.96</td>
                  <td>BAL</td>
                  <td colspan="3">Assessment for Review AY 2017</td>
                  <td colspan="2">Batch 1 : 2017</td>
                </tr>
              </tbody>
            </table>
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
            <i class="fa fa-pencil"></i>
        </a>
        <ul>
            <li><a id="btnEdit" class="btn-floating black"  data-toggle="tooltip" data-placement="left" title="Edit Information"><i class="fa fa-pencil-square-o"></i></a></li>
            <li><a class="btn-floating black"  data-toggle="tooltip" data-placement="left" title="View Balance"><i class="fa fa-money"></i></a></li>
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
      document.getElementById('btnEdit').onclick= function(){
        location.href="editaccount.php?personid=<?php echo $row['personid']; ?>";
      };
  </script>
</html>