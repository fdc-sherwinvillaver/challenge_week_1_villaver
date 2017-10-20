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
    <meta charset='utf-8' />

    <link href='public/css/full_calendar/fullcalendar.min.css' rel='stylesheet' />
    <link href='public/css/full_calendar/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='public/js/full_calendar/moment.min.js'></script>
    <script src='public/js/full_calendar/jquery.min.js'></script>
    <script src='public/js/full_calendar/fullcalendar.min.js'></script>
    <title>EduStudio</title>
    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1024px;
            margin: 0 auto;
        }
    </style>

</head>
<body class="fixed-sn white-skin">
    <!--Main layout-->
     <main class="">
        <a href="http://localhost/sis_edustudio/"><< Back to Home </a>
        <div class="container-fluid mb-3">
            <div class="col-md-9">
                <div class="card pad">
                    <div class="row">
                        <div id="calendar"></div>
                    </div>
                </div>
                <!-- /.Section: Calendar -->
            </div>
        </div>
    </main>
    <!--/Main layout-->
</body>
    <script type="text/javascript">
        $(document).ready(function() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10) {
            dd = '0'+dd
        } 
        if(mm<10) {
            mm = '0'+mm
        } 
        today = yyyy + '-' + mm + '-' + dd; 
        var source;
        function getReservations(){
            $.ajax({
                url:"controllers/ReservationController.php",
                type:"POST",
                data:{action:"get_reservations"},
                success: function(data){
                    var json = JSON.parse(data);
                    for(var i = 0; i < json.length; i++){
                        if(json[i].reservationdate == today){
                            json[i]['color'] = "#8BC34A";
                        }
                        else if (json[i].reservationdate < today){
                            json[i]['color'] = "#f44336";
                        }
                        else{
                        }
                    }
                    source = json;
                },
                async: false
            });
        }
        getReservations();


        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: today,
            navLinks: true, // can click day/week names to navigate views
            selectable: true,
            selectHelper: true,
            select: function(date) {
                var date_clicked = new Date(date);
                var d = date_clicked.getDate();
                var m = date_clicked.getMonth() + 1;
                var y = date_clicked.getFullYear();
                if(d<10) {
                    d = '0'+d
                } 
                if(m<10) {
                    m = '0'+m
                }
                var date_clicked = y + '-' + m + '-' + d;
                if(date_clicked < today){
                    alert('You cannot reserve on that date');
                }
                else{
                    window.location = "newreservation.php?date="+date_clicked;
                }
            },
            // editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: source
        });
        
    });
    </script>
</html>