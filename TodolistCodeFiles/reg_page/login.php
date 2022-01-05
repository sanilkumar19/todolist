<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
$_SESSION['v1'] = 2;
include("includes/functions.php");
include_once ("includes/config.php");
if (isset($_POST['btn_submit'])){
    // otherwise:
    // create the sql command to insert user information into database

    $sql = "SELECT * FROM user_info WHERE email=?";
    // initiate a mysql statement using  mysqli_stmt_init()
    $stmt = mysqli_stmt_init($conn);
    // prepare the statement by assigning the sql command (and check for errors)
    if(!mysqli_stmt_prepare($stmt,$sql)){
        // show an error message to the user
        echo("There was an error inserting data");
        exit();
    }
    // otherwise
    // bind the user input values with the placeholders in the statement
    $email=trim($_POST["email"]);
    $password=$_POST["password"];
    mysqli_stmt_bind_param($stmt,"s", $email);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($results)) {
        $fetched_hashed_password = $row["password"];
        if (password_verify($password, $fetched_hashed_password)) {
            header('location: index.php'); // set sessions and show profile page
            mysqli_stmt_close($stmt);
            $_SESSION['logged'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['UID'] = $row['UID'];
            exit();
        }
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/stylesheet.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
if (isset($_POST['btn_submit'])){
    $_SESSION['logged'] = false;
    user_login_form("The credentials entered were not correct");
}
else {
    user_login_form();
}
?>
</body>
</html>
