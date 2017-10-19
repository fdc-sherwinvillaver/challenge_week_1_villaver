<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }

    require_once('models/Participant.php');
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
    <?php include('partials/datatable_styles.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
     <main>
        <div class="div-55-center mt-3">
            <form method="POST" action="enrollment.php" id="frmedituser">
                <div class="card pad pan">
                <h4 class='text-left blue-text'>Update Profile</h4>
                <div class="col-md-12" style="margin-top: 7rem;">
                    <div class="avatar">
                        <a data-toggle="tooltip" data-placement="top" title="Click image to change" id="aimg">
                            <img src="public/images/no_image.jpg" id="photo" class="rounded-circle waves-effect cropped" data-toggle="modal" data-target="#modalCrop">
                        </a>
                    </div>
                </div>
                <div class="row mt-3">
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
                </div>
                </div>
                <div class="card pan pad">
                    <div class="form-sm">
                        <center><p class="blue-text">Change your password</p></center>
                    </div>
                    <div class="row">
                        <!--Second column-->
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="password" name="password" id="password" class="form-control">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="password" name="confirmpassword" id="confirmpassword" class="form-control">
                                <label for="confirmpassword">Confirm Password</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="action" value="enroll_participant">
                        <input type="hidden" name="profimg" id="profimg">
                        <div class="col-md-12">
                            <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?>">
                            <input type="hidden" name="action" value="edit_user">
                            <button type='submit' class="btn btn-outline-info waves-effect ml-auto float-right" id='btnnext'>Update <i class="fa fa-check"></i></button>
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
</body>
    <?php include('partials/scripts.php'); ?>
    <?php include('partials/datatable_scripts.php'); ?>
    <script src="public/js/app/user.js"></script>
    <script type="text/javascript">
        var accountid = '<?php echo $_SESSION['id'] ?>';
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);

            <?php 
                if ($_SESSION['status'] == 0) {
                    echo "toastr.info('This is your first log. Please update your profile to activate your account');";
                }
             ?>
         });
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