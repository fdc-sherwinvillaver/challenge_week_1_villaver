<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }

    require_once('models/Participant.php');
    $p = new Participant;
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
                        <a class="btn btn-primary btn-lg btn-block" href="newparticipant.php">
                            <i class="fa fa-plus left"></i> New Participant
                        </a>
                        <div class="mt-2">
                            <small>Participant categories:</small>
                            <ul class="striped">
                                <li><span class="bullet green"></span> Currently Enrolled <span class="badge bg-primary float-right" id='countactive'></span></li>
                                <li><span class="bullet red"></span> Inactive <span class="badge bg-primary float-right" id='countinactive'></span></li>
                                <li><span class="bullet purple"></span> Total number of participants <span class="badge bg-primary float-right" id='count'></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 offset-md-1">
                    <div class="tab-content card">
                        <h4 class="blue-text pad">Participants</h4>
                        <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center"><small>Participant No<s/mall></th>
                                        <th class="text-center"><small>Participant</small></th>
                                        <th class="text-center"><small>Action</small></th>
                                    </tr>
                                </thead>
                                <tbody class='tbody-md'>
                                       <?php 
                                            foreach ($p->get_participants() as $participant) {
                                                $id         = $participant['participantid'];
                                                $participantno = $participant['participantno'];
                                                $lastname   = $participant['lastname'];
                                                $firstname  = $participant['firstname'];
                                                $middlename = $participant['middlename'];
                                                $age        = $participant['age'];
                                                $gender     = $participant['gender'];
                                                $barangay   = $participant['barangay'];
                                                $city       = $participant['city'];
                                                $province   = $participant['province'];
                                                $program    = $participant['program'];
                                                $school     = $participant['school'];
                                                $status     = $participant['status'];
                                                $image      = $participant['photo'];
                                                echo "<tr class='text-center'><td><p>";
                                                /*if($status == 1){echo "<span class='bullet green'></span>";}
                                                else {echo "<span class='bullet red'></span>";}*/
                                                echo "<img class='avatar-32' style='display:inline;' src='";
                                                if($image == ''){
                                                    echo 'public/images/no_image.jpg';
                                                } 
                                                else{ 
                                                    echo $image;
                                                }
                                                echo "'>".$participantno."</p></td>";
                                                echo "<td><a href='participantinfo.php?id=".$id."'>".$lastname.", ".$firstname." ".$middlename."</a>
                                                    <small class='grey-text'></small>
                                                </td>";
                                                echo "<td>";
                                                    if($status == 0){
                                                        echo "<a class='blue-text' data-toggle='dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-user-plus'></i> <small>enroll</small></a>";
                                                            echo "<div class='dropdown-menu dropdown-ins' aria-labelledby='userDropdown'>";
                                                            foreach ($p->getBatches() as $batches) {
                                                                $batchid = $batches['batchid'];
                                                                foreach ($p->get_sections_by_batchid($batchid) as $section) {
                                                                    $sectionid      = $section['sectionid'];
                                                                    $batchno        = $batches['batchno'];
                                                                    $sectionName    = $section['section'];
                                                                    $dateStart      = strtotime($batches['dateStart']);
                                                                    $dateEnd        = strtotime($batches['dateEnd']);

                                                                    echo "<small><a class='dropdown-item' onclick='enroll(\"$id\",\"$sectionid\")'>";
                                                                        echo $batchno.": ".$sectionName." (".date('jS F Y',$dateStart)." - ".date('jS F Y',$dateEnd).")";
                                                                    echo "</option></small>";
                                                                }
                                                            }
                                                            echo "</div>";
                                                        }else{
                                                            echo "<small>";
                                                                echo "<p>Participant enrolled</p>";
                                                            echo "</small>";
                                                        }
                                                        echo "<a class='green-text pad' data-toggle='dropdown' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fa fa-money' aria-hidden='true'></i> <small>pay</small></a>";
                                                echo "</td></tr>";
                                            }
                                        ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
        <form id="frmenrollexist" method="POST" action="enrollment.php">
            <input type="hidden" name="id"   id="participantid">
            <input type="hidden" name="firstname"       id="firstname">
            <input type="hidden" name="middlename"      id="middlename">
            <input type="hidden" name="lastname"        id="lastname">
            <input type="hidden" name="bdate_submit"       id="birthdate">
            <input type="hidden" name="religion"        id="religion">
            <input type="hidden" name="gender"          id="gender">
            <input type="hidden" name="civilstatus"     id="civilstatus">
            <input type="hidden" name="barangay"        id="barangay">
            <input type="hidden" name="city"            id="city">
            <input type="hidden" name="province"        id="province">
            <input type="hidden" name="phone"           id="phone">
            <input type="hidden" name="email"           id="email">
            <input type="hidden" name="facebook"        id="facebook">
            <input type="hidden" name="program"         id="program">
            <input type="hidden" name="major"           id="major">
            <input type="hidden" name="semesterGraduated"     id="semGraduate">
            <input type="hidden" name="yearGraduated"    id="yearGraduate">
            <input type="hidden" name="school"          id="school">
            <input type="hidden" name="honors"          id="honors">
            <input type="hidden" name="seccourse_status" id="seccourse_status">
            <input type="hidden" name="secondprogram"   id="secondprogram">
            <input type="hidden" name="secondschool"    id="secondschool">
            <input type="hidden" name="job_status"      id="job_status">
            <input type="hidden" name="position"        id="position">
            <input type="hidden" name="company"         id="company">
            <input type="hidden" name="profimg"         id="profimg">
            <input type="hidden" name="section"         id="section">
            <input type="hidden" name="x"               id="x">
        </form>
    </main>
    <!--/Main layout-->
</body>
    <?php include('partials/scripts.php'); ?>
    <?php include('partials/datatable_scripts.php'); ?>
    <script src="public/js/app/participant.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);

            $('table').DataTable();
         });

         function enroll(id, section){
            $.ajax({
                type: 'POST',
                url: 'controllers/ParticipantController.php',
                data: {
                    'studentid': id,            
                    'action': 'get_student_data',
                },
                success: function(e){
                    var data                        = JSON.parse(e);
                    $('#participantid').val(data['participantid']);
                    $('#firstname').val(data['firstname']);
                    $('#middlename').val(data['middlename']);
                    $('#lastname').val(data['lastname']);
                    $('#birthdate').val(data['birthdate']);
                    $('#religion').val(data['religion']);
                    $('#gender').val(data['gender']);
                    $('#civilstatus').val(data['civilstatus']);
                    $('#barangay').val(data['barangay']);
                    $('#city').val(data['city']);
                    $('#province').val(data['province']);
                    $('#phone').val(data['phone']);
                    $('#email').val(data['email']);
                    $('#facebook').val(data['facebook']);
                    $('#program').val(data['program']);
                    $('#major').val(data['major']);
                    $('#semesterGraduated').val(data['semGraduate']);
                    $('#yearGraduated').val(data['yearGraduate']);
                    $('#school').val(data['school']);
                    $('#honors').val(data['honors']);
                    $('#seccourse_status').val(data['seccourse_status']);
                    $('#secondprogram').val(data['secondprogram']);
                    $('#secondschool').val(data['secondschool']);
                    $('#job_status').val(data['job_status']);
                    $('#position').val(data['position']);
                    $('#company').val(data['company']);
                    $('#profimg').val(data['photo']);
                    $('#section').val(section);
                    $('#x').val('retaker');
                    document.getElementById('frmenrollexist').submit();
                }
            });
        }
    </script>
</html>