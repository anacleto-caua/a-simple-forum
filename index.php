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
            Welcome stranger
        </h1>
        <section class="popular">
            <h2 class="section-name">
                The best of the week goes here! 
            </h2>

            <a href="">
                <div class="post">
                    <div class="post-title">
                        Mc Donald's is really overrated!
                    </div>
                    <div class="post-content">
                        Their bread look like sand, the meat is almost soy and the sauces tasty like plastic. Yes a have eated plastic some time ago.
                        <a class="link" href="">HERE</a>
                    </div>
                </div>
            </a>
            
        </section>
    </main>
    <?php require 'assets/html/footer.html'; ?>
</body>
</html>