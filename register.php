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
    <main>
        <?php

        ?>
        <h1>
            You can create a account here:
        </h1>

        <form action="register.php" method="POST">

            <div class="input-label">
                <label> Username </label>
                <input type="text" name="username" placeholder="Username">
                <span class="field-error">
                    Not optional field
                </span>
            </div>

            <div class="input-label">
                <label>Date of Birth</abbr></label>
                <input type="date" name="bithday">
            </div>

            <div class="input-label">
                <label> Email </label>
                <input type="email" name="email" placeholder="E-Mail">
            </div>

            <div class="input-label">
                <label> Password </label>
                <input type="password" name="password" placeholder="Password">
            </div>

            <div class="input-label">
                <label> Password Confirm</label>
                <input type="password" name="confirm-password" placeholder="Confirm Password">
            </div>
            <div class="center-submit">
                <input type="submit" value="Create Account">
            </div>
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