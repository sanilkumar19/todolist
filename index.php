<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
if(isset($_SESSION['logged']) && $_SESSION['logged']===true)
{
    header('Location: main.php');
}
else{
    header('Location: login.php');
}
if(isset($_GET['q']))
{
    if($_GET['q']=='logout'){
        $_SESSION["logged"]=false;
        session_destroy();
        //clearstatcache();
        apc_cache_clear();
        header('Location: logout.php');
        die;
    }
}
?>