<?php
require 'models/DB.php';

$batchid = $_POST["batchID"];

$query="SELECT * FROM person INNER JOIN participants ON person.personid= participants.personid
INNER JOIN sectionparticipants on participants.participantid= sectionparticipants.participantid
INNER JOIN sections ON sectionparticipants.sectionid = sections.sectionid
INNER JOIN batches ON sections.batchid = batches.batchid WHERE batches.batchid=$batchid";
$where="WHERE true ";
$filter="";
$last="ORDER BY Batch ASC";
// $action=$_POST["action"];

$db = db();

if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($db, $_POST["query"]);
 $filter.= " AND (firstname LIKE '%".$search."%') ";
}
else
{
  $filter = "";
}

// if($action!="showAll"){
//   $filter.="AND Batch=$action ";
// }

$query.=$filter;
$display = mysqli_query($db, $query);
$no     = 0;
if(mysqli_num_rows($display)>0){
    $section= null;
    while ($row = mysqli_fetch_array($display))
    { 
      // $color="";
      // if($row['Finished']==1){
      //   $color= "grey";
      // }
      // else{
      //   $color="green";
      // }

      if($row['section'] != $section){
        $section = $row['section'];
        echo '<div class="batch mt-2">
              <span class="bullet green"></span>
              <a>'.$row['batchno'].': '.$section.'</a>
              <hr>
              </div>';   
      }
        echo '  
                <div class="col-md-3">
                 <div class="card contact-card  waves-effect">
                    <div class="card-body">
                        <a class="activator" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i cursor="hand" class="fa fa-ellipsis-v"></i></a>
                        <div class="dropdown-menu dropdown-ins dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="profile.php?personid='.$row['personid'].'">View Profile</a>
                        </div>
                        <div class="mt-1 mb-1">
                            <img src="';if($row['photo'] == ''){echo 'public/images/no_image.jpg';}else{echo $row['photo'];}
                            echo'" height="70px" width="70px" class="img-fluid rounded-circle contact-avatar mx-auto">
                        </div>
                        <h5 class="h5-responsive text-center">'.$row['firstname'].'</h5>
                        <p class="text-center"><a href="https://facebook.com/'.$row['facebook'].'"><i class="fa fa-facebook-square" aria-hidden="true"></i> '.$row['facebook'].'</a></p>
                        <center>
                        <ul class="striped">
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> '.$row['email'].'</li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i> '.$row['phone'].'</li>
                            <li></li>
                        </ul>
                        </center>
                    </div>
                </div>
            </div>';
        $no++;
    }
}
else{
    echo '<div class="batch">
        <h4></h4>
        <hr>
        <div class="not-found">
            <i class="fa fa-frown-o" aria-hidden="true"></i>
            <p>Sorry, data not found.</p>
        </div>
        </div>';
}
?>
