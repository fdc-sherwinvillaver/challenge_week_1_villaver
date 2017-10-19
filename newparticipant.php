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
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
     <main>
        <div class="div-55-center mt-3">
            <form method="POST" action="enrollment.php">
                <div class="card pad pan">
                <h4 class='text-left blue-text'>New Participant</h4>
                <div class="col-md-12" style="margin-top:7rem;">
                    <div class="avatar">
                        <a data-toggle="tooltip" data-placement="top" title="Click image to change" id="aimg">
                            <img src="public/images/no_image.jpg" id="photo" class="rounded-circle waves-effect cropped" data-toggle="modal" data-target="#modalCrop">
                        </a>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="md-form">
                            <input type="text" id="participantno" name="participantno" class="form-control" readonly value=" ">
                            <label for="participantno" class="active">Participant No.</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="text" id="firstname" name="firstname" class="form-control">
                            <label for="firstname">First Name</label>
                        </div>
                    </div>
                    <!--Second column-->
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="text" id="middlename" name="middlename" class="form-control">
                            <label for="middlename">Middle Name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="md-form">
                            <input type="text" id="lastname" name="lastname" class="form-control">
                            <label for="lastname">Last Name</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="md-form">
                            <input type="text" name="bdate_submit" class="datepicker" id="bdate">
                            <label for="bdate">Birthdate</label>
                        </div>
                    </div>
                     <div class="col-md-12">
                        <div class="md-form">
                            <input type="text" name="religion" id="religion" class="form-control">
                            <label for="religion">Religion</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="md-form">
                             <select class="mdb-select" name="gender" id="gender">
                                <option disabled selected>Select Gender</option>
                                 <option>Male</option>
                                 <option>Female</option>
                             </select>
                         </div>
                    </div>
                    <div class="col-md-6">
                         <div class="md-form">
                             <select class="mdb-select" name="civilstatus" id="civilstatus">
                                <option disabled selected>Select Civil Status</option>
                                 <option>Single</option>
                                 <option>Married</option>
                                 <option>Divorced</option>
                             </select>
                         </div>
                    </div>
                </div>
                </div>
                <div class="card pan pad">
                    <div class="form-sm">
                        <center><p class="blue-text">Address</p></center>
                    </div>
                    <div class="row">
                        <!--Second column-->
                        <div class="col-md-4">
                            <div class="md-form">
                                <input type="text" name="barangay" id="barangay" class="form-control">
                                <label for="barangay">Barangay</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form">
                                <input type="text" name="city" id="city" class="form-control">
                                <label for="city">City</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form">
                                <input type="text" name="province" id="province" class="form-control">
                                <label for="province">Province</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card pan pad">
                    <div class="form-sm">
                        <center><p class="blue-text">Contact     Information</p></center>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="text" name="phone" id="phone" class="form-control">
                                <label for="phone">Phone</label>
                            </div>
                        </div>
                        <!--Second column-->
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" name="email" id="email" class="form-control">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" name="facebook" id="facebook" class="form-control">
                                <label for="facebook">Facebook Email</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card pan pad">
                    <div class="form-sm">
                        <center><p class="blue-text">Educational Background</p></center>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="md-form">
                                 <select class="mdb-select" name="program" id="program">
                                    <option disabled selected>Select Program</option>
                                     <option>BSED</option>
                                     <option>BEED</option>
                                 </select>
                             </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" name="major" id="major" class="form-control">
                                <label for="major">Major</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" name="semesterGraduated" id="semesterGraduated" class="form-control">
                                <label for="semesterGraduated">Semester Graduated</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="md-form">
                                <input type="text" name="yearGraduated" id="yearGraduated" class="form-control">
                                <label for="yearGraduated">Year Graduated</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="search" name="school" id="school" class="form-control mdb-autocomplete">
                                <button class="mdb-autocomplete-clear">
                                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                                        <path d="M0 0h24v24H0z" fill="none" />
                                    </svg>
                                </button>
                                <label for="school">School</small></label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="md-form">
                                <select class="mdb-select" name="honors" id="honors">
                                    <option disabled selected>Latin Honors</option>
                                     <option>Cum Laude</option>
                                     <option>Magna Cum Laude</option>
                                     <option>Suma Cum Laude</option>
                                 </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card pad pan">
                    <div class="row">
                        <div class="md-form form-sm">
                            <input type="checkbox" id="secCourse">
                            <label for="secCourse">DPE/CPE/2nd Courser</label>
                        </div>
                        <div class="col-md-12 edu" style='display:none;'>
                            <div class="md-form">
                                <input type="text" name="secondprogram" id="secondprogram" class="form-control">
                                <label for="secondprogram">Second Program</label>
                            </div>
                        </div>
                        <div class="col-md-12 edu" style='display:none;'>
                            <div class="md-form">
                                <input type="text" id="secondschool" name="secondschool" class="form-control">
                                <label for="secondschool">School</label>
                            </div>
                        </div>
                        <input type="hidden" name="seccourse_status" id="seccourse_status" value="0">
                    </div>
                </div>
                <div class="card pad pan">
                    <div class="row">
                        <div class="md-form form-sm">
                            <input type="checkbox" id="isEmployed">
                            <label for="isEmployed">Is Employed</label>
                        </div>
                        <div class="col-md-12 job" style='display:none;'>
                            <div class="md-form">
                                <input type="text" id="position" name="position" class="form-control">
                                <label for="position">Position</label>
                            </div>
                        </div>
                        <div class="col-md-12 job" style='display:none;'>
                            <div class="md-form">
                                <input type="text" id="company" name="company" class="form-control">
                                <label for="company">Company</label>
                            </div>
                        </div>
                        <input type="hidden" name="job_status" id="job_status" value="0">
                    </div>
                </div>
                <div class="card pad pan">
                    <div class="row">
                        <div class="col-md-12">
                             <div class="md-form">
                                 <select class="mdb-select" name="section" id="section">
                                 <?php 
                                    $participant = new Participant;
                                    foreach ($participant->getBatches() as $batches) {
                                        $batchid = $batches['batchid'];
                                        foreach ($participant->get_sections_by_batchid($batchid) as $section) {
                                            $sectionid      = $section['sectionid'];
                                            $batchno        = $batches['batchno'];
                                            $sectionName    = $section['section'];
                                            $dateStart      = strtotime($batches['dateStart']);
                                            $dateEnd        = strtotime($batches['dateEnd']);

                                            echo "<option value=".$sectionid.">";
                                                echo $batchno.": ".$sectionName." (".date('jS F Y',$dateStart)." - ".date('jS F Y',$dateEnd).")";
                                            echo "</option>";
                                        }
                                    }
                                 ?>
                                     <option value="0"> Reservation </option>
                                 </select>
                                 <label for="section">Enroll in:</label>
                             </div>
                        </div>
                        <input type="hidden" name="x" value="new">
                        <input type="hidden" name="action" value="enroll_participant">
                        <input type="hidden" name="profimg" id="profimg">
                        <div class="col-md-12">
                            <input type="hidden" name="action" value="enroll_participant">
                            <button type='submit' class="btn btn-outline-info waves-effect ml-auto float-right" id='btnnext'>Next <i class="fa fa-arrow-right"></i></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="modalCrop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <!--Content-->
                <div class="modal-content">
                    <!--Body-->
                    <div class="modal-body">
                        <div class="imageBox">
                            <div class="thumbBox"></div>
                            <div class="spinner" style="display: none">Loading...</div>
                        </div>
                    </div>
                    <!--Footer-->
                    <div class="modal-footer">
                        <div class="action">
                            <input type="file" id="file" style="float:left; width: 250px">
                            <button class="btn btn-floating blue" id="btnZoomIn">+</button>
                            <button class="btn btn-floating blue" id="btnZoomOut">-</button>
                            <button type="submit" class="btn btn-sm blue" id="btnCrop" data-dismiss="modal">Crop</button>
                        </div>
                    </div>
                </div>
                <!--/.Content-->
            </div>
        </div>
    </main>
    <!--/Main layout-->

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="myModalLabel">Ooops..</h4>
                </div>
                <!--Body-->
                <div class="modal-body">
                    <center>
                        <p>There is no active batch</p>
                    </center>
                    <center><a type="button" class="btn btn-warning" href="batches.php">Manage Batches</button></a>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                </div>
            </div>
            <!--/.Content-->
        </div>
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
    <script type="text/javascript" src="public/js/cropbox-min.js"></script>
    <script type="text/javascript">
        var options =
            {
                imageBox: '.imageBox',
                thumbBox: '.thumbBox',
                spinner: '.spinner',
                imgSrc: 'public/images/no_image.jpg'
            }
            var cropper = new cropbox(options);
            document.querySelector('#file').addEventListener('change', function(){
                var reader = new FileReader();
                reader.onload = function(e) {
                    options.imgSrc = e.target.result;
                    cropper = new cropbox(options);
                }
                reader.readAsDataURL(this.files[0]);
            })
            document.querySelector('#btnCrop').addEventListener('click', function(){
                var img = cropper.getDataURL();
                // document.querySelector('.cropped').innerHTML += '<img src="'+img+'">';
                $('.cropped').attr('src', img);
                $('#profimg').val(img);
                // document.querySelector('.cropped').attr('src', img);
            })
            document.querySelector('#btnZoomIn').addEventListener('click', function(){
                cropper.zoomIn();
            })
            document.querySelector('#btnZoomOut').addEventListener('click', function(){
                cropper.zoomOut();
            })
    </script>
    <script type="text/javascript">
        $('.datepicker').pickadate({
          format: 'dd mmm, yyyy',
          formatSubmit: 'yyyy-mm-dd',
          });
    </script>
</html>