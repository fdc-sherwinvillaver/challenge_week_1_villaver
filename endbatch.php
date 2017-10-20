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
        $participants = new Participant;
        $batchid = $_GET['id'];
        $sat = $batches->get_saturday_by_batchid($batchid)['sectionid'];
        $sun = $batches->get_sunday_by_batchid($batchid)['sectionid'];
 ?>
<head>
    <title>EduStudio</title>
    <?php include('partials/head.php'); ?>
</head>

<body class="fixed-sn white-skin">
    <?php include('partials/nav.php'); ?>
    <!--Main layout-->
     <main class="">
     <form id='frmresults'>
        <div class="div-60-center">
        <div class="card pad pan">
            <div class="div-60-center">
                <ul class="nav md-pills nav-justified pills-primary">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Saturday <?php echo "<span class='badge red'>".$batches->count_participants_by_section($sat)."</span>"; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Sunday <?php echo "<span class='badge red'>".$batches->count_participants_by_section($sun)."</span>"; ?></a>
                </li>
            </ul>
            </div>
                <div class="tab-content">
                <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
                <br>
                    <ul class="">
                        <?php 
                            if($batches->count_participants_by_section($sat) == 0){
                                echo "<center><small><i>X</i> No participant</small></center>";
                            }else{
                                foreach ($participants->get_section_participants($sat) as $p){
                                    $info = $participants->get_student_data($p['participantid']);
                                    echo "<li>";
                                        echo "<div class='div-60-center'>";
                                            echo "<div class='col-md-12'>";
                                                echo "<select class='mdb-select' name='".$p['participantid']."result'>
                                                        <option value='' disabled selected>Set result</option>
                                                        <option value='1' ";
                                                         if ($batches->get_participant_result($sat, $p['participantid']) == 1){
                                                            echo "selected";
                                                         }
                                                echo ">Pass</option>
                                                        <option value='2' ";
                                                        if ($batches->get_participant_result($sat, $p['participantid']) == 2){
                                                            echo "selected";
                                                         }
                                                echo ">Fail</option>
                                                    </select>";
                                                echo "<label>".$info['lastname'].", ".$info['firstname']." ".$info['middlename']."</label>";
                                                echo "<br>";
                                                echo "<br>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</li>";
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div class="tab-pane fade" id="panel2" role="tabpanel" disabled>
                <br>
                    <ul class="">
                        <?php 
                            if($batches->count_participants_by_section($sun) == 0){
                                echo "<center><small><i>X</i> No participant</small></center>";
                            }else{
                                foreach ($participants->get_section_participants($sun) as $p){
                                    $info = $participants->get_student_data($p['participantid']);
                                    echo "<li>";
                                        echo "<div class='div-60-center'>";
                                            echo "<div class='col-md-12'>";
                                                echo "<select class='mdb-select' name='".$p['participantid']."result'>
                                                        <option value='' disabled selected>Set result</option>
                                                        <option value='1' ";
                                                        if ($batches->get_participant_result($sun, $p['participantid']) == 1){
                                                                echo "selected";
                                                             }
                                                        echo">Pass</option>
                                                        <option value='2' ";
                                                        if ($batches->get_participant_result($sun, $p['participantid']) == 2){
                                                                echo "selected";
                                                             }
                                                        echo ">Fail</option>
                                                    </select>";
                                                echo "<label>".$info['lastname'].", ".$info['firstname']." ".$info['middlename']."</label>";
                                                echo "<br>";
                                                echo "<br>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</li>";
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <input type="hidden" name="saturday" value="<?php echo $sat ?>">
            <input type="hidden" name="sunday" value="<?php echo $sun ?>">
            <input type="hidden" name="action" value="set_result">
            <button type='submit' class="btn btn-outline-info waves-effect ml-auto float-right" id='btnnext'>Submit Results <i class="fa fa-check"></i></button>
        </div>
        </div>
    </form>
    </main>
</body>
    <?php include('partials/scripts.php'); ?>
    <script src="public/js/app/batch.js"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            // Sidenav Initialization
            $(".button-collapse").sideNav();
            var el = document.querySelector('.custom-scrollbar');
            Ps.initialize(el);
         });
    </script>
</html>