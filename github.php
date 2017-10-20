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

if($_POST['Payload']) {
    $payload  = $_POST['Payload'];
    if($payload['ref'] ==  "refs/heads/GITHUB-WEBHOOK") {
         pullRequest();
    }
}
?>