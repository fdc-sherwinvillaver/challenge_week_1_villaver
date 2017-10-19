<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }

    require_once('models/User.php');
    $user = new User;
    $userinfo = $user->get_userdata($_SESSION['id']);
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
     <main>
        <div class="div-55-center mt-3">
            <form method="POST" id="frmupdate_userprofile">
                <div class="card pad pan">
                    <h4 class='text-left blue-text'>Update Profile</h4>
                    <div class="col-md-12" style="margin-top: 7rem;">
                        <div class="avatar">
                            <a data-toggle="tooltip" data-placement="top" title="Click image to change" id="aimg">
                                <img src="<?php if($userinfo['photo'] == ''){echo 'public/images/no_image.jpg';}else{ echo $userinfo['photo']; } ?>" id="photo" class="rounded-circle waves-effect cropped" data-toggle="modal" data-target="#modalCrop">
                            </a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <div class="md-form">
                                <input type="text" id="firstname" name="firstname" class="form-control" value="<?php echo $userinfo['firstname'] ?>">
                                <label for="firstname" class="active">First Name</label>
                            </div>
                        </div>
                        <!--Second column-->
                        <div class="col-md-4">
                            <div class="md-form">
                                <input type="text" id="middlename" name="middlename" class="form-control" value="<?php echo $userinfo['middlename'] ?>">
                                <label for="middlename" class="active">Middle Name</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="md-form">
                                <input type="text" id="lastname" name="lastname" class="form-control" value="<?php echo $userinfo['lastname'] ?>">
                                <label for="lastname" class="active">Last Name</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="profimg" id="profimg" value="<?php echo $userinfo['photo']; ?>">
                        <div class="col-md-12">
                            <input type="hidden" name="personid" value="<?php echo $userinfo['personid'] ?>">
                            <input type="hidden" name="action" value="update_userprofile">
                            <button type='submit' class="btn btn-outline-info waves-effect ml-auto float-right" id='btnupdate'>Update <i class="fa fa-check"></i></button>
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
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/editprofile.js"></script>
    <script type="text/javascript">
        var id = '<?php echo $_SESSION['id'] ?>';
    </script>
    <script type="text/javascript">
     $(document).ready(function(){
        // Sidenav Initialization
        $(".button-collapse").sideNav();
        var el = document.querySelector('.custom-scrollbar');
        Ps.initialize(el);
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