<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <main class="">
	    <div class="div-55-center mt-3">
            <form method="POST" id="frmnewaffiliation">
                <div class="card pad pan">
	                <h4 class='text-left blue-text'>New Affiliation</h4>
	                <div class="row mt-3">
	                    <div class="col-md-12">
	                        <div class="md-form">
	                            <input type="text" id="affname" name="affname" class="form-control" required>
	                            <label for="firstname">Affiliation Name</label>
	                        </div>
	                    </div>
	                </div>
                </div>
                <div class="card pad pan">
	                <div class="form-sm">
                        <center><p class="blue-text">Contact Person</p></center>
                    </div>
	                <div class="row mt-3">
	                    <div class="col-md-4">
	                        <div class="md-form">
	                            <input type="text" id="firstname" name="firstname" class="form-control" required>
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
	                            <input type="text" id="lastname" name="lastname" class="form-control" required>
	                            <label for="lastname">Last Name</label>
	                        </div>
	                    </div>
	                    <div class="col-md-12">
                            <div class="md-form">
                                <input type="text" name="phone" id="phone" class="form-control" required>
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
                        <div class="col-md-12">
			            	<input type="hidden" name="action" value="newaffiliation">
		                    <center><button type='submit' class="float-right btn btn-outline-info waves-effect ml-auto" id='btnsubmit'>Create Affiliation</button></center>
		                </div>
	                </div>
                </div>
            </form>
        </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/affiliation.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
	    // Sidenav Initialization
	    $(".button-collapse").sideNav();
	    var el = document.querySelector('.custom-scrollbar');
	    Ps.initialize(el);

	    $('.timepicker').pickatime({
		    twelvehour: true
		});
	 });
    </script>
    <script type="text/javascript">
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd;
        } 
        if(mm<10){
            mm='0'+mm;
        }
        
        $('.datepicker').pickadate({
          format: 'dd mmm, yyyy',
          formatSubmit: 'yyyy-mm-dd',
          min: new Date(yyyy, mm, dd),
        });
    </script>
</html>