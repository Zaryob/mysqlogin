<?php 
   include('config.php');
if(isset($_COOKIE["user_id"])) {
    header("Location:".$link);
} else { ?>
    <h2>Sign Up:</h2>
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
        <label for="username">Username:</label>
        <input name="username" id="username" required></input>

        <br><br>

        <label for="password">Password:</label>
        <input name="password" id="password" type="password"  required></input>
        <br>
        <label for="password_again">Password (again):</label>
        <input name="password_again" id="password_again" type="password"  required></input>

        <br>
        <br>
        <button type="submit">Sign Up</button>
        <br>
        Already have an account? <a href="<?=$link?>login.php">Login here</a>.
    </form>
<?php } ?>
