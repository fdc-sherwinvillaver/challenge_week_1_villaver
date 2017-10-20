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
    <!--Main layout-->
    <main class="">
            <div class="container-fluid">
            <form>
                <div class="list-menu card">
                <div class="card-body pad">
                <div class="md-form">
                    <input type="search" id="txtsearch" class="form-control" name="txtsearch">
                    <label for="txtsearch" class="">Search</label>
                    <div id="btnsearch"><i class="fa fa-search"></i></div>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="checkbox1" name="Passers">
                    <label for="checkbox1">Passed the LET Exam</label>
                </div>
                <div class="form-group">
                    <input type="checkbox" id="checkbox2" name="Retakers">
                    <label for="checkbox2">Failed the LET Exam </label>
                </div>
                <hr>
                <div>
                    <small>Legend:</small>
                    <ul class="striped">
                        <li><span class="bullet green"></span> Still On-Going <span class="badge bg-primary label-pill float-right">
                        <li><span class="bullet grey"></span> Finished the Review <span class="badge bg-primary float-right">
                    </ul>
                </div>
                <br>
                <div class="md-form">
                     <select class="mdb-select" name="sort">
                         <option>Ascending</option>
                         <option>Descending</option>
                     </select>
                     <label for="gender">Order by:</label>
                </div>
                </div>
                </div>
                </form>
                    <div class="list-row">
                    <div class="row" id="display">
                    </div>
                    <hr>
                    <div class="text-right"><h6>Showing <b id="result"></b> Result(s)</h6></div>
                    </div>
            </div>
    </main>
    <!--/Main layout-->

    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
        <a class="btn-floating btn-large red">
            <i class="fa fa-pencil"></i>
        </a>
        <ul>
            <li><a class="btn-floating red"><i class="fa fa-star"></i></a></li>
            <li><a class="btn-floating yellow darken-1"><i class="fa fa-user"></i></a></li>
            <li><a class="btn-floating green"><i class="fa fa-envelope"></i></a></li>
            <li><a class="btn-floating blue"><i class="fa fa-shopping-cart"></i></a></li>
        </ul>
    </div>
</body>
    <?php include('partials/scripts.php'); ?>
    <script type="text/javascript">
     $(document).ready(function(){
      // Sidenav Initialization
      $(".button-collapse").sideNav();
      var el = document.querySelector('.custom-scrollbar');
      Ps.initialize(el);
   });
    </script>
    <script type="text/javascript">
         $(document).ready(function(){
            
            var url = (window.location).href;
            var batchID =url.substring(url.lastIndexOf('=')+1);

            filterSearch();
            $.ajax({
               url:"search.php",
               method:"POST",
               data:{batchID:batchID},
               success:function(data)
               {
                $('#display').html(data);
                var Count = $('#display').html(data).find('h5').length;
                document.getElementById("result").innerHTML = Count;
               }
              });
             function filterSearch(query)
             {
              var search = $('#txtsearch').val();
              $.ajax({
               url:"search.php",
               method:"POST",
               data:{query:search,batchID:batchID},
               success:function(data)
               {
                $('#display').html(data);
                var Count = $('#display').html(data).find('h5').length;
                document.getElementById("result").innerHTML = Count;
               }
              });
             }

             $('#txtsearch').keyup(function(){
              var search = $(this).val();

               filterSearch(search, batchID);

             });
             // $('#selectBatch').change(function()
             //  { 
             //    var batchID = $(this).find(":selected").val();
             //    var selectBatch = 'action=' + batchID;
             //    $.ajax({
             //   url:"search.php",
             //   method:"POST",
             //   data:selectBatch,
             //   success:function(data)
             //   {
             //    $('#display').html(data);
             //    var Count = $('#display').html(data).find('h5').length;
             //    document.getElementById("result").innerHTML = Count;
             //   }
             //  });
             //  });
           
         });
    </script>

</html>