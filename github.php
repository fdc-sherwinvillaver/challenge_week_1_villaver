<?php
function pullRequest(){
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
}
  
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $data = json_decode(file_get_contents('php://input'), true);
    if($data['ref'] == 'refs/heads/GITHUB-WEBHOOK'){
        pullRequest();
    }
}
?>
<html>
    <?php echo $output; ?>
</html>