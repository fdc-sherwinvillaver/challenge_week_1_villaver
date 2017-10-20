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
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
     <main>
        <div class="div-55-center mt-3">
            <div class="card pad pan">
            <h4 class='text-left blue-text'>My Account</h4>
                <div class="row mt-3">
                    <div class="md-form col-md-12">
                        <input class="form-control" type="text" name="user" id="user" value=" ">
                        <label for="user" class="active">Username</label>
                    </div>
                </div>
                <div class="div-center-40">
                    <center><button id="btnsubmitresult" class="btn btn-outline-info waves-effect ml-auto float-right"><i class="fa fa-check"></i> Update Account</button></center>
                </div>
            </div>
        </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/user.js"></script>
    <script type="text/javascript">
        var accountid = '<?php echo $_SESSION['id'] ?>';
    </script>
    <script type="text/javascript">
     $(document).ready(function(){
        // Sidenav Initialization
        $(".button-collapse").sideNav();
        var el = document.querySelector('.custom-scrollbar');
        Ps.initialize(el);

        $.ajax({
            type: 'POST',
            url: 'controllers/UserController.php',
            data: {
                'accountid': accountid,
                'action': 'get_username'
            },
            success: function(e){
                $('#user').val(e);
            }
        });
     });
    </script>
</html>