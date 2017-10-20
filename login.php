<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(isset($_SESSION['id'])){
        header("location: index.php");
    }
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <main class="">
        <div class="div-40-center">
            <!--Card-->
            <div class="card pad space">
                <!--Bacground color-->
                <div class="card-up indigo lighten-1">
                </div>
                <div class="card-body">
                    <div class="div-90-center">
                    <img src="public/images/logo.png" class="img-center">
                    <p class="txt-center"><i><i class="fa fa-quote-left" aria-hidden="true"></i> Art of Learning. Heart for L</i> <i class="fa fa-quote-right" aria-hidden="true"></i></p>
                        <form method="POST">
                           <div class="md-form">
                                <input type="text" id="username" name="username" class="form-control" onkeypress="return runScript(event)">
                                <label for="username" class="">Username</label>
                            </div>
                            <div class="md-form">
                                <input type="password" id="password" name="password" class="form-control" onkeypress="return runScript(event)">
                                <label for="password" class="">Password</label>
                            </div>
                            <input type="hidden" name="action" value="login">
                            <center>
                                <button class="btn btn-outline-info waves-effect ml-auto" type="submit" id="btnsubmit">Login</button>
                            </center>
                            <div style="padding:1rem;">
                                <center><a href="#">Forgot Password?</a></center>
                            </div>
                       </form>
                    </div>
                </div>

            </div>
            <!--/.Card-->
        </div>
    </main>
</body>
  <?php include('partials/scripts.php'); ?>
  <script type="text/javascript" src="public/js/app/login.js"></script>