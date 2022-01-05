<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$_SESSION['logged']=false;
session_destroy();
clearstatcache();

$page = "login.php";
$sec = "1";
header("Refresh: $sec; url=$page");
?>
