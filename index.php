<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Simple Forum</title>
    <link rel="stylesheet" href="assets/css/header-footer.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <?php require 'assets/html/header.html'; ?>
    <main>
        <h1>
            <?php
                if(isset($_SESSION) == false){
                    session_start();
                }
                if(isset($_SESSION['USERNAME'])){
                    echo 'Welcome ' . $_SESSION['USERNAME'];
                }
                else{
                    echo "Welcome stranger";
                }
            ?>
        </h1>
        <section class="popular">
            <h2 class="section-name">
                The best of the week goes here! 
            </h2>

            <a href="">
                <div class="post">
                    <h2 class="post-title">
                        Mc Donald's is really overrated!
                    </h2>
                    <div class="post-content">
                        Their bread look like sand, the meat is almost soy and the sauces tasty like plastic. Yes a have eated plastic some time ago.
                        <a class="link" href="">HERE</a>
                    </div>
                    <div class="infos">
                        <img src="images/profiles-icons/icon.jpg" alt="">
                        <span class="username">
                            usernamexxx
                        </span>
                        <span class="date-time">
                            27/09/2021
                            <br>
                            15:35
                        </span>
                    </div>
                </div>
            </a>
        </section>
    </main>
    <?php require 'assets/html/footer.html'; ?>
</body>
</html>