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
	    	<h4 class="blue-text">New Reservation</h4>
	    	<form id="frmnewreservation">
                <div class="row mt-3">
                	<div class="col-md-12">
		                <div class="md-form">
		                    <input type="text" id="activity" name="activity" class="form-control">
		                    <label for="paymentname" class="">Activity</label>
		                </div>
		            </div>
		            <div class="col-md-12">
                        <div class="md-form">
                            <input type="search" name="affname" id="affname" class="form-control mdb-autocomplete">
                            <button class="mdb-autocomplete-clear">
                                <svg fill="#000000" height="24" viewBox="0 0 24 24" width="24">
                                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z">
                                    <path d="M0 0h24v24H0z" fill="none">
                                </svg>
                            </button>
                            <label for="affname">Affiliation</small></label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="md-form">
                            <input type="text" name="reservdate_submit" id="reservdate" value="<?php echo $_GET['date']; ?>" hidden>
                            <input type="text" value="<?php echo $_GET['date']; ?>" disabled>
                            <label for="reservdate" class="active">Reservation Date</label>                              
                        </div>
                    </div>
		            <div class="col-md-6">
		                <div class="md-form">
						    <input type="text" id="starttime" name="starttime" class="form-control timepicker">
						    <label for="input_starttime">Start Time</label>
						</div>
		            </div>
		            <div class="col-md-6">
		                <div class="md-form">
						    <input type="text" id="endtime" name="endtime" class="form-control timepicker">
						    <label for="input_starttime">End Time</label>
						</div>
		            </div>
		            <div class="col-md-12">
		            	<input type="hidden" name="action" value="reserve">
	                    <center><button type='submit' class="float-right btn btn-outline-info waves-effect ml-auto" id='btnsubmit'>Reserve</button></center>
	                </div>
                </div>
            </form>
            </div>	
	    </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/reservation.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
	    // Sidenav Initialization
	    $(".button-collapse").sideNav();
	    var el = document.querySelector('.custom-scrollbar');
	    Ps.initialize(el);

	    $('.timepicker').pickatime({
		    twelvehour: false
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