<?php 
   include('config.php');
if(isset($_COOKIE["user_id"])) {
    header("Location:".$link);
} else { ?>
<html>
<head>
<title>Register Page</title>
<link rel="stylesheet" href="css/main.css" type="text/css"></link>
</head>
<body>
    <div class="signlanding">
    <h1>Sign Up</h1>
    <h3>Please fill your credentials to sign up.</h3>

    <form method="POST" action="<?=$link?>">
        <input type="hidden" name="method" value="register" />

        <?php

        if(@$_GET["message"] == "retype_password") {
            echo "Please enter same password!";
        } elseif(@$_GET["message"] == "user_created") {
            echo "User created succesfuly!";
        } elseif(@$_GET["message"] == "user_couldnt_created") {
            echo "Username already used!";
        }
        ?><br>
        <label for="username">Username</label>
        <br>
        <input name="username" id="username" required></input>

        <br><br>

        <label for="password">Password</label>
        <br>
        <input name="password" id="password" type="password"  required></input>
        <br><br>
        <label for="password_again">Confirm Password</label>
        <br>
        <input name="password_again" id="password_again" type="password"  required></input>
        <br><br>
        <button class="button_blue" type="submit">Sign Up</button>
        <button class="button_white" onclick="
        document.getElementById('password').value = '';
        document.getElementById('password_again').value = '';
        document.getElementById('username').value = '';
        " title="Clear">Reset</button></input>
        <br>
        <br>
        Already have an account? <a href="<?=$link?>login.php">Login here</a>.
    </form>
    <div>
</body>
</html>
<?php } ?>
