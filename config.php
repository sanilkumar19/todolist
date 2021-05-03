<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$conn = mysqli_connect("localhost", "id16637834_root", "wf_$9mx9lV5l3v_X", "id16637834_app_users");
if(!$conn){
    echo("Error in connection");
    exit();
}
