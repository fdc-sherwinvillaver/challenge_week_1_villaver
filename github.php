<?php
$commands = array(
    'sudo git pull'
);
$output = '';
foreach($commands AS $command){
    $tmp = shell_exec("$command 2>&1");
    $output .= "<span style=\"color: #6BE234;\">\$</span> <span style=\"color: #729FCF;\">{$command}\n</span>";
    $output .= htmlentities(trim($tmp)) . "\n";
}
echo $output;
?>