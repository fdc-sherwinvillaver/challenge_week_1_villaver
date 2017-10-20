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
	    <div class="div-55-center">
	    	<div class="card pad mt-3">
			<h4 class="text-left blue-text">New Scholarship</h4>	    		
	    	<form id="frmnewscholarship">
                <div class="row mt-3">
                	<div class="col-md-6">
		                <div class="md-form">
		                    <input type="text" id="scholarshipname" name="scholarshipname" class="form-control">
		                    <label for="scholarshipname" class="">Scholarship Name</label>
		                </div>
		            </div>
		            <div class="col-md-6">
		                <div class="md-form">
		                    <input type="text" id="discount" name="discount" class="form-control">
		                    <label for="discount" class="">Discount</label>
		                </div>
		            </div>
		            <div class="col-md-12">
		            	<input type="hidden" name="action" value="new_scholarship">
	                    <center><button type='submit' class="btn btn-outline-info waves-effect ml-auto" id='btnsubmit'>Create Scholarship</button></center>
	                </div>
                </div>
            </form>
            </div>	
	    </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/scholarship.js"></script>
    <script type="text/javascript">
         // Sidenav Initialization
        $(".button-collapse").sideNav();
        var el = document.querySelector('.custom-scrollbar');
        Ps.initialize(el);
    </script>
</html>