<?php
// function pullRequest(){
    $commands = array(
        'echo $PWD',
        'whoami',
        'sudo git pull'
    );
    $output = '';
    foreach($commands AS $command){
        $tmp = shell_exec("$command 2>&1");
        $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
        $output .= htmlentities(trim($tmp)) . "\n";
    }
  echo $output;
// }
  
<<<<<<< HEAD
// if($_SERVER['REQUEST_METHOD'] === "POST"){
=======
// if($_SERVER['REQUEST_METHOD'] === 'POST'){
>>>>>>> e82d61c4e0a4fbc83dab23fd28adf7d0f1c59900
//     $data = json_decode(file_get_contents('php://input'), true);
//     if($data['ref'] == 'refs/heads/GITHUB-WEBHOOK'){
//         pullRequest();
//     }
// }
<<<<<<< HEAD
// ?>
=======
?><!-- 
<html>
    <?php echo $output; ?>
</html> -->
>>>>>>> e82d61c4e0a4fbc83dab23fd28adf7d0f1c59900
