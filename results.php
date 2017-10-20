<!DOCTYPE html>
<html lang="en">
<?php 
    session_start();
    if(!isset($_SESSION['id'])){
        header("location: login.php");
    }else if($_SESSION['status'] == 0){
        header("location: firstlogin.php");
    }

    require_once('models/Batch.php');
        $batches = new Batch;
    require_once('models/Participant.php');
        $participant = new Participant;
        $batchid = $_GET['id'];
        $sat = $batches->get_saturday_by_batchid($batchid)['sectionid'];
        $sun = $batches->get_sunday_by_batchid($batchid)['sectionid'];
        $participants = $batches->get_batchparticipants($sat, $sun);
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
    <?php include('partials/datatable_styles.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
     <main class="">
        <div class="div-50-center">
            <div class="card pad pan mb-3">
            <small>Participants: <span class="float-right">Result:</span></small>
                <ul class="striped">
                    <?php 
                        foreach ($participants as $ps) {
                            $ps_info = $participant->get_student_data($ps['participantid']);
                            echo "<li>";
                                echo "<p><img class='avatar-32' style='display:block; float: left;' src='";
                                    if($ps_info['photo'] == ''){
                                        echo 'public/images/no_image.jpg';
                                    } 
                                    else{ 
                                        echo $ps_info['photo'];
                                    }   
                                    echo "'>".$ps_info['lastname'].", ".$ps_info['firstname']." ".$ps_info['middlename'];
                                echo "<span class='float-right'>";
                                    if($ps['result'] == 1){
                                        echo "Passed";
                                    }else{
                                        echo "Failed";
                                    }
                                echo "</span>";
                                echo "</p>";
                            echo "</li>";
                        }
                     ?>
                </ul>
            </div>
        </div>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <?php include('partials/datatable_scripts.php'); ?>
    <script src="public/js/app/set_result.js"></script>
    <script type="text/javascript">
        var batchid = <?php echo $_GET['id'] ?>;
        var sat     = <?php echo $sat ?>;
        var sun     = <?php echo $sun ?>;
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);
         });
    </script>
</html>