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
            <div class="card pad pan">
            <h4 class='text-left blue-text'>New User</h4>
            <small>default password: <u>edustudiouser</u></small>
                <form id="frmnewuser">  
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="md-form">
                                <input type="text" id="username" name="username" class="form-control" value=" ">
                                <label for="username" class="active">Username</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <select class="mdb-select" name="accesslevel" id="accesslevel">
                                <option value="0" disabled selected>Click to select...</option>
                                <option value="1">Super Admin</option>
                                <option value="2">Admin</option>
                            </select>
                            <label for="accesslevel">Access level</label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="action" value="new_user">
                        <center><button type='submit' class="btn btn-outline-info waves-effect ml-auto" id='btnsubmit'>Create User</button></center>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <!--/Main layout-->
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/user.js"></script>
    <script type="text/javascript">
        var accountid = '<?php echo $_SESSION['id'] ?>';
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);
            $.ajax({
                type: 'POST',
                url: 'controllers/UserController.php',
                data: {
                    'action': 'count_user'
                },
                success: function(e){
                    var currentyear = (new Date()).getFullYear();
                    $('#username').val(currentyear+"-USER-"+(e));
                }
            });
         });
    </script>
</html>