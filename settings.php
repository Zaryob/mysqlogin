<?php 
    include('config.php');
?>
<html>
<head>
<title>Settings Page</title>
<link rel="stylesheet" href="css/main.css" type="text/css"></link>
</head>
<body>
    <div class="signlanding">
    <h1>Your Settings</h1>
    <h3>If you want to change your credentials please change them up.</h3>

    <form method="POST" action="<?=$link?>">
        <input type="hidden" name="method" value="settings"/>
        <br>
        If you dont want to make any change, you can <a href="<?=$link?>">go back</a>.
        <br>
        <br>

        <?php

        if(@$_GET["message"] == "successful") { ?>
            <div class="successful">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo "Succesfully updated";?>
            </div> 
        <?php
        } elseif(@$_GET["message"] == "failed") {?>
            <div class="fail">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo "Something went wrong. Please check";?>
            </div> 
        <?php
        }
        ?><br>
        
        <label for="username">Username</label>
        <br>
        <input name="username" id="username" value="<?php echo $_COOKIE["user_name"]; ?>" required></input>

        <br><br>

        <label for="password">Password</label>
        <br>
        <input name="password" id="password" value="<?php echo $_COOKIE["passwd"]; ?>" required></input>
        <br><br>

        <label for="email">Email</label>
        <br>
        <input name="email" id="email" value="<?php echo $_COOKIE["email"]; ?>" ></input>
        <br><br>

        <label for="address">Address</label>
        <br>
        <input name="address" id="address"value="<?php echo $_COOKIE["address"]; ?>" ></input>
        <br><br>

        <label for="phone_number">Phone Number</label>
        <br>
        <input name="phone_number" id="phone_number" value="<?php echo $_COOKIE["phone_number"]; ?>" ></input>

        <br>
        <br>
	    <button type="submit" class="button_blue" >Update</button>
	    <button class="button_white" ><a href="<?=$link?>">Go Back</a></button>
        <br>
    </form>
    </div>
</body>
</html>
<?php ?>
