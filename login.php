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
    <?php require 'mysql/connect.php'; ?>
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
                        session_start();
                        $_SESSION['USERNAME'] = $username;
                        $_SESSION['USER_ROLE'] = $result['role'];

                        header("location: ./");
                    }
                }
            }
        ?>
        
        <h1>
            You can login here:
        </h1>
        <span class="field-error" id="submit-field-error">
                <!--ERRORS HERE-->
        </span>
        <form action="login.php" method="POST">

            <div class="input-label">
                <label> Username </label>
                <input type="text" name="username" id="username">
                <span class="field-error" id="username-field-error">
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
                <input type="password" name="password" id="password">
                <span class="field-error" id="password-field-error">
                    <?php
                        if(isset($_POST['submit'])){
                            foreach ($password_errors as $error){
                                echo "$error <br>";
                            }
                        }
                    ?>
                </span>
            </div>

            <input type="submit" value="Login" name="submit">
        </form>
        <div class="change-form">
                Doesn't have an account?
            <a href="register.php">
                Create here!
            </a>
        </div>
        
        <!--
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="assets/js/form.js"></script>
        -->
       
    </main>
    <?php require 'assets/html/footer.html'; ?>
</body>
</html>