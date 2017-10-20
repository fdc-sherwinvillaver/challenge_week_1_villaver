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
        <div class="div-70-center">
            <div class="card pad pan mb-3">
                <table class="table">
                    <thead class="mdb-color darken-3">
                        <tr class="white-text">
                            <th style="text-align:center;">Name</th>
                            <th style="text-align:center;">Section</th>
                            <th style="text-align:center;">Pass</th>
                            <th style="text-align:center;">Failed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($participants as $ps) {
                                $ps_info = $participant->get_student_data($ps['participantid']);
                                echo "<tr style='text-align:center;'>";
                                    echo "<td>";
                                    echo "<p><img class='avatar-32' style='display:block; float: left;' src='";
                                    if($ps_info['photo'] == ''){
                                        echo 'public/images/no_image.jpg';
                                    } 
                                    else{ 
                                        echo $ps_info['photo'];
                                    }   
                                    echo "'>".$ps_info['lastname'].", ".$ps_info['firstname']." ".$ps_info['middlename']."</p></td>";
                                    echo "<td>";
                                        if($ps['sectionid'] == $sat){
                                            echo "Saturday";
                                        }else{
                                            echo "Sunday";
                                        }
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<div>";
                                            echo "<input type='radio' onclick='setresult(\"".$ps_info['participantid']."\",\"1\")' id='p".$ps_info['participantid']."' name='radio".$ps_info['participantid']."'>";
                                            echo "<label for='p".$ps_info['participantid']."'>";
                                        echo "</div>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<div>";
                                            echo "<input type='radio' onclick='setresult(\"".$ps_info['participantid']."\",\"2\")' id='f".$ps_info['participantid']."' name='radio".$ps_info['participantid']."'>";
                                            echo "<label for='f".$ps_info['participantid']."'>";
                                        echo "</div>";
                                    echo "</td>";
                                echo "</tr>";
                            }
                         ?>                        
                    </tbody>
                </table>
                <div class="div-center-40">
                    <center><button id="btnsubmitresult" class="btn btn-outline-info waves-effect ml-auto float-right"><i class="fa fa-check"></i> Submit results</button></center>
                </div>
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