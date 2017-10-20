<!DOCTYPE html>
<html lang="en">
<?php require_once('models/Affiliation.php');
  session_start();
  if(!isset($_SESSION['id'])){
      header("location: login.php");
  }else if($_SESSION['status'] == 0){
      header("location: firstlogin.php");
  }
  $aff = new Affiliation;
  $affinfo = $aff->get_affiliation($_GET['id']);
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <main>
        <div class="div-50-center mb-3">
            <div class="card pad pan">
            <a class='activator' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i cursor='hand' class='orange-text fa fa-pencil'></i></a>
                <h4 class="blue-text"><?php echo $affinfo['affiliationname'] ?></h4>
                <div><hr></div>
                <small>Contact Person:</small>
                <small><?php echo $affinfo['lastname'].", ".$affinfo['firstname']." ".$affinfo['middlename'] ?></small>
                <div class="row mt-1">
                    <div class="col-md-4">
                        <center><i class="fa fa-phone"></i></center>
                        <center><small><?php echo $affinfo['phone']; ?></small></center>
                    </div>
                    <div class="col-md-4">
                        <center><i class="fa fa-facebook-square"></i></center>
                        <center><small><?php echo $affinfo['facebook'] ?></small></center>
                    </div>
                    <div class="col-md-4">
                        <center><i class="fa fa-envelope"></i></center>
                        <center><small><?php echo $affinfo['email'] ?></small></center>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
    <script>
      /*document.getElementById('btnEdit').onclick= function(){
        location.href="editaccount.php?personid=<?php echo $row['personid']; ?>";
      };*/

      $('.btn-back').on('click', function(){
            window.location = "participants.php";
      });

      $('#btnbalance').on('click', function(){
            window.location = 'participantbalance.php?id=<?php echo $p['participantid']; ?>';
      });
  </script>
</html>