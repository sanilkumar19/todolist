<?php
include_once("includes/config.php");
function user_login_form($error=null){ ?>
    <section class="form">
        <?php
        if($error !== null) {
            echo "<div class='error_message'>" .$error."</div>";
        }
        ?>
        <div class="login-form">
        <form action="login.php" method="post">
            <h2 class="text-center">Welcome to TGIF</h2>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Email" name="email" required>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <input type="Password" class="form-control" placeholder="Password" name="password" required>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" value="Login" name="btn_submit" class="btn btn-primary login-btn btn-block">Sign in</button>
            </div>
        </form>
        <p class="text-center text-muted small">Don't have an account? <a href="register.php">Sign up here!</a>
    </section>
    </div>
<?php
}
function user_registration_form($error=null){ ?>
    <section class="form">
        <?php
        if($error !== null) {
         echo "<div class='error_message'>" .$error."</div>";
        }
        ?>
        <div class="login-form">
            <form action="" method="post">
                <h2 class="text-center">Create an Account</h2>
                <div class="form-group">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Username" name="name">
                        <input type="text" class="form-control" placeholder="Email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group"><span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <input type="password" class="form-control" placeholder="Repeat Password" name="repeat_password">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" value="register" class="btn btn-primary login-btn btn-block" data-toggle name="btn_submit">Register</button>
                </div>
            </form>
            <p class="text-center text-muted small">Already registered? <a href="login.php">Log in here</a>
    </section>
    </div>
<?php
}
function authenticate($name,$email,$password,$repeat_password){
    // check name, and last name are not empty
    if(strlen($name)<2){
        user_registration_form("Name is too small");
        exit();
    }
    // check email format
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        user_registration_form("Invalid email format");
        exit();
    }
    // check $password==$repeat_password
    if($password!==$repeat_password) {
        user_registration_form("Passwords do not match");
        exit();
    }
    // check $password is at least 5 char long
    if(!password_validator($password,5)) {
        user_registration_form("Password not valid<br>
        1 capital letter<br>
        1 lowercase letter<br>
        1 number<br>
        Atleast 5 characters long");
        exit();
    }
}
function register_user(){
    if(isset($_POST['btn_submit'])){
        $name=trim($_POST["name"]);
        $lastname=trim($_POST["lastname"]);
        $email=trim($_POST["email"]);
        $password=$_POST["password"];
        $repeat_password=$_POST["repeat_password"];

        authenticate($name,$lastname,$email,$password,$repeat_password);

        // otherwise:
        // create the sql command to insert user information into database
        $sql = "INSERT INTO user_info (name,lastname,email,password) VALUES (?,?,?,?)";
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
        mysqli_stmt_bind_param($stmt,"ssss",
            $name,$lastname,$email,$hashed_password);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        echo ("Account successfully registered");
        user_login_form();
    }
    else{
        user_registration_form();
        exit();
    }
}
function profile_header(){
}
function profile_footer(){
}
function completed(){

}
function password_validator($password,$len){
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    //$specialChars = preg_match('@[^\w]@', $password);
    //|| !$specialChars
    if(!$uppercase || !$lowercase || !$number || strlen($password) < $len) {
        return false;
    }else{
        return true;
    }
}