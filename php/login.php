<?php 
include('config.php');

if (isset($_COOKIE["user_id"])) {
    header("Location:".$link);
    exit();
} else { ?>
    <h1>Login</h1>
    <h3>Please fill your credentials to login.</h3>

    <form method="POST" action="<?=$link?>">
        <input type="hidden" name="method" value="login"/>
        <?php

            if(@$_GET["message"] == "password") {
                echo "Please enter correct password!";
            }
        ?><br>
        <label for="username">Username:</label>
        <input name="username" id="username" required></input>

        <br><br>

        <label for="password">Password:</label>
        <input name="password" id="password" type="password" required></input>

        <br>
        <br>
        <button type="submit">Sign in</button>
        <br>
        Don't have an account? <a href="<?=$link?>register.php">Sign up now</a>
    </form>
<?php } ?>
