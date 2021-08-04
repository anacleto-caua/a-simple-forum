<?php
function printErrors($errors_array){
    echo "<span class='field-error'>";
        foreach($errors_array as $error){
            echo $error;
            echo "<br>";
        }
    echo "</span>";
}

function defineValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

#create arrays here to be accessed like globals
$username_errors = array();
$dob_errors = array();
$email_errors = array();
$password_errors = array();
$confirm_password_errors = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Simple Forum</title>
    <link rel="stylesheet" href="assets/css/header-footer.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/form.css">
</head>
<body>
    <?php require 'assets/html/header.html'; ?>
    <?php require '_require/connect.php'; ?>
    <main>
        <?php
            if(isset($_POST['submit'])){
                $username = $mysqli->real_escape_string($_POST['username']);
                if($username != $_POST['username'] or $username == ''){
                    array_push($username_errors, "Username invalid!");
                }
                if(strlen($username) < 5){
                    array_push($username_errors, "Username need at least 5 characters!");
                }
                if(strlen($username) > 15){
                    array_push($username_errors, "Username can't be longer than 15 characters!");
                }

                $query = "SELECT * FROM `user` WHERE username = '$username'";
                $result = $mysqli->query($query);
                $count = $result->num_rows;
                if($count > 0){
                    array_push($username_errors, "Username unavailable!");
                }

                $dob = $_POST["birthday"];
                if( (int)substr($dob, 0, 4) > date('Y') - 18 ){
                    array_push($dob_errors, "Theoretically you should be eighteen to access this site!");
                }
                if($dob == ''){
                    array_push($dob_errors, "You need a birthday date!");
                }
                
                $email = $mysqli->real_escape_string($_POST['email']);
                if(filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
                    array_push($email_errors, "Not a valid email adress!");
                }
                $query = "SELECT * FROM `user` WHERE email = '$email'";
                $result = $mysqli->query($query);
                $count = $result->num_rows;
                if($count > 0){
                    array_push($email_errors, "Email unavailable!");
                }

                $password = $mysqli->real_escape_string($_POST['password']);
                if($password != $_POST['password'] or $password == ''){
                    array_push($password_errors, "Password invalid!");
                }
                if(strlen($password) < 5){
                    array_push($password_errors, "Password need at least 5 characters!");
                }

                $confirm_password = $mysqli->real_escape_string($_POST['confirm-password']);
                if($password != $confirm_password){
                    array_push($confirm_password_errors, "Passwords needs to be equal!");
                }

                #------------------------------------NOTE---------------------------------
                #should I use array_merge() to concatenete this arrays and count just one?
                if(count($username_errors) == 0 &&
                    count($dob_errors) == 0 &&
                    count($email_errors) == 0 &&
                    count($password_errors) == 0 &&
                    count($confirm_password_errors) == 0){
                        
                    $query = "INSERT INTO `user` (`username`, `email`, `password`, `birthday`)
                                            VALUES ('$username','$email','$password','$dob')";
                    $mysqli->query($query);
                    header("location: login.php");
                }
            }
        ?>
        <h1>
            You can create a account here:
        </h1>
        

        <form action="register.php" method="POST">

            <div class="input-label">
                <label>Username </label>
                <input type="text" name="username" value="<?php defineValue('username'); ?>">
                <?php printErrors($username_errors); ?>
            </div>

            <div class="input-label">
                <label>Date of Birth </label>
                <input type="date" name="birthday" value="<?php defineValue('birthday'); ?>">
                <?php printErrors($dob_errors); ?>
            </div>

            <div class="input-label">
                <label>Email </label>
                <input type="email" name="email" value="<?php defineValue('email'); ?>">
                <?php printErrors($email_errors); ?>
            </div>

            <div class="input-label">
                <label>Password </label>
                <input type="password" name="password" value="<?php defineValue('password'); ?>">
                <?php printErrors($password_errors); ?>
            </div>

            <div class="input-label">
                <label>Password Confirm </label>
                <input type="password" name="confirm-password">
                <?php printErrors($confirm_password_errors); ?>
                
            </div>
                <input type="submit" name="submit" value="Create Account">
        </form>
        <div class="change-form">
                Already have an account?
            <a href="login.php">
                Login here!
            </a>
        </div>
    </main>
    <?php require 'assets/html/footer.html'; ?>
</body>
</html>