<?php
function defineValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

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

                $username_errors = array();
                $username = $mysqli->real_escape_string($_POST['username']);
                if($username  != $_POST['username'] or $username == ''){
                    array_push($username_errors, "Username invalid!");
                }

                $password_errors = array();
                $password = $mysqli->real_escape_string($_POST['password']);
                if($password != $_POST['password'] or $password == ''){
                    array_push($password_errors, "Password invalid!");
                }

                if(count($username_errors) == 0 && count($password_errors) == 0){
                    $query = "SELECT * FROM `user` WHERE username='$username' AND password='$password'";
                    $result = $mysqli->query($query);
                    $count = $result->num_rows;
                    
                    $result = $result->fetch_assoc();

                    if($count > 0) {
                        require('_require/session-manager.php');
                        
                        if($_POST['remember']){
                            setLogin($username, $result['role'], true);
                        }else{
                            setLogin($username, $result['role']);
                        }
                        
                        header("location: ./");
                    }
                }
            }
        ?>
        
        <h1>
            You can login here:
        </h1>
        <form action="login.php" method="POST">

            <div class="input-label">
                <label> Username </label>
                <input type="text" name="username" value="<?php defineValue('username'); ?>">
                <span class="field-error">
                    <?php
                        if(isset($_POST['submit'])){
                            foreach ($username_errors as $error){
                                echo "$error <br>";
                            }
                        }
                    ?>
                </span>
            </div>

            <div class="input-label">
                <label> Password </label>
                <input type="password" name="password">
                <span class="field-error">
                    <?php
                        if(isset($_POST['submit'])){
                            foreach ($password_errors as $error){
                                echo "$error <br>";
                            }
                        }
                    ?>
                </span>
            </div>

            <div class=" input-label checkbox">
                <label id="test">Remember me:</label>
                <input type="checkbox" name="remember">
            </div>

            <input type="submit" value="Login" name="submit">
        </form>
        <div class="change-form">
                Doesn't have an account?
            <a href="register.php">
                Create here!
            </a>
        </div>
        
    </main>
    <?php require 'assets/html/footer.html'; ?>
</body>
</html>