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
	    	<h4 class="blue-text">Payment</h4>
	    	<form id="payment">
                <div class="row mt-3">
		            <div class="col-md-12">
		                <select class="mdb-select" name="payer" id="payer">
	                        <option value="" disabled selected>Click to select...</option>
	                        <option value="1">Participant</option>
	                        <option value="2">Reservee</option>
	                    </select>
	                    <label for="payer">Payment for</label>
		            </div>
		            <div class="col-md-12" id="div-id" style="display:none">
		            	<div class="row">
		            		<div class="col-md-10">
					            <div class="md-form">
					              <input type="search" name="txtidentification" id="txtidentification" class="form-control mdb-autocomplete">
                                <button class="mdb-autocomplete-clear">
                                    <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24">
                                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z" />
                                        <path d="M0 0h24v24H0z" fill="none" />
                                    </svg>
                                </button>
					              <label for="txtidentification" id="lbidentification"></label>
					           	</div>
					        </div>
					        <div class="col-md-2">
					        	<button type="button" id="btnget" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
					        </div>
		            	</div>
		            </div>
                </div>
            </form>
            </div>
            <div class="card pad mt-1" style="display:none">
            	
            </div>
	    </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/transact.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
	    // Sidenav Initialization
	    $(".button-collapse").sideNav();
	    var el = document.querySelector('.custom-scrollbar');
	    Ps.initialize(el);
	 });
    </script>
</html>