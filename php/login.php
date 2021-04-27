<?php 
include('config.php');

if (isset($_COOKIE["user_id"])) {
    header("Location:".$link);
    exit();
} else { ?>
<html>
<head>
<title>Login Page</title>
<link rel="stylesheet" href="css/main.css" type="text/css"></link>
</head>
<body>
    <div class="signlanding">
    <h1>Login</h1>
    <h3>Please fill your credentials to login.</h3>

    <form method="POST" action="<?=$link?>">
        <input type="hidden" name="method" value="login"/>
        <?php

            if(@$_GET["message"] == "password") {
                echo "Please enter correct password!";
            }
        ?><br>
        <label for="username">Username</label>
        <br>
        <input name="username" id="username" required></input>

        <br><br>

        <label for="password">Password</label>
        <br>
        <input name="password" id="password" type="password" required></input>

        <br>
        <br>
        <button type="submit" class="button_blue" >Sign in</button>
        <br>
        <br>

        Don't have an account? <a href="<?=$link?>register.php">Sign up now</a>
    </form>
    </div>
</body>
</html>
<?php } ?>
