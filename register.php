<?php
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}
include("includes/functions.php");
include_once("includes/config.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/stylesheet.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if(isset($_POST['btn_submit'])){
    $name=trim($_POST["name"]);
    $email=trim($_POST["email"]);
    $password=$_POST["password"];
    $repeat_password=$_POST["repeat_password"];

    authenticate($name,$email,$password,$repeat_password);

    // otherwise:
    // create the sql command to insert user information into database
    $sql = "INSERT INTO user_info (name,email,password) VALUES (?,?,?)";
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
    $hashed_password = password_hash($password,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,"sss",
                    $name,$email,$hashed_password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    //echo ("Account successfully registered");
    user_login_form();
}
else{
    user_registration_form();
    exit();
}
?>
</body>
</html>
