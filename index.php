<?php ob_start(); session_start();
   include('config.php');

try {
	$db = new PDO("mysql:host=".$host.";dbname=".$database.";charset=utf8", $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die($e->getMessage());
}

if(!empty($_COOKIE["user_id"])) {
    $user = $db->query("SELECT * FROM users WHERE id = '{$_COOKIE["user_id"]}'")->fetch(PDO::FETCH_ASSOC);
}

?>

<?php

if(isset($_GET["logout"])) {
    session_destroy();
    setcookie("user_id", NULL);
    setcookie("user_name", NULL);
    setcookie("passwd", NULL);
    setcookie("address", NULL);
    setcookie("email", NULL);
    setcookie("phone_number", NULL);
    header("Location:".$link);
}
if($_POST) {
    if($_POST["method"] == "register") {
        if($_POST["password"] !== $_POST["password_again"]) {
            header("Location:".$link."register.php?message=retype_password");
            exit();
        }
        $query = $db->query("SELECT * FROM users WHERE username = '{$_POST["username"]}'")->fetch(PDO::FETCH_ASSOC);
        if(!$query) {
            $sql = $db->prepare("INSERT INTO users (username, password)
            VALUES (:username, :password)");

            $sql->bindParam('username', $_POST["username"]);
            $sql->bindParam('password', $_POST["password"]);
            $sql->execute();

            header("Location:".$link."register.php?message=user_created");
            exit();
        } else {
            header("Location:".$link."register.php?message=user_couldnt_created");
            exit();
        }

    } elseif($_POST["method"] == "login") {
        $query = $db->prepare("SELECT * FROM users WHERE username = :username");

        $query->bindParam('username', $_POST["username"]);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($_POST["password"] !== $result["password"]) {
            header("Location:".$link."login.php?message=password");
            exit();
        } else {
            setcookie("user_id", $result["id"]);
            setcookie("user_name", $result["username"]);
            setcookie("passwd", $result["password"]);
            setcookie("address", $result["address"]);
            setcookie("email", $result["email"]);
            setcookie("phone_number", $result["phone_number"]);
            create_flash_message("message", "Password is true.");
        }

        header("Location:".$link);
    } elseif ($_POST["method"] == "settings") {
        $query = $db->prepare("UPDATE users SET username = :username, password = :password, email = :email, address = :address,  phone_number=:phone_number WHERE id = '{$_COOKIE["user_id"]}';");
        $query->bindParam('username', $_POST["username"]);
        $query->bindParam('password', $_POST["password"]);
        $query->bindParam('address', $_POST["address"]);
        $query->bindParam('email', $_POST["email"]);
        $query->bindParam('phone_number', $_POST["phone_number"]);
        $query->execute();
        //$rows = $query->fetchAll(PDO::FETCH_ASSOC);
        //header("Location:".$link."settings.php?message=successful");
        //exit();
        //$result = $query->fetch(PDO::FETCH_ASSOC);
        //error_log($result);
        setcookie("user_name", $_POST["username"]);
        setcookie("passwd", $_POST["password"]);
        setcookie("address", $_POST["address"]);
        setcookie("email", $_POST["email"]);
        setcookie("phone_number", $_POST["phone_number"]);
        header("Location:".$link."settings.php?message=successful");
        exit();
    } else {
        create_flash_message("message", "Select true method!");
    }
}

function create_flash_message($key, $value) {
    $_SESSION[$key] = $value;
}

function show_flash_message($key) {
    $message = $_SESSION[$key] ?? NULL;
    unset($_SESSION[$key]);

    return $message ? $message : NULL;
}

?>

<!DOCTYPE html>
<html>
<head>
<title>The Database Login App</title>
<link rel="stylesheet" href="css/main.css" type="text/css"></link>
</head>
<body>
    <div class="welcomelanding">

        <div align="center">
                <h1 style="color:blue;">The Database Login App</h1>

                <?=show_flash_message("message")?>

        <?php if(isset($_COOKIE["user_id"])) { ?>
            <h2 style="font-weight: normal;">Welcome to the database auth app, dear "<?=$user["username"]?>!"</h2>
            <h4>Table of users</h4>
            <?php 

                echo "<table>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Name</th>";
                echo "<th>Password</th>";
                echo "<th>Email</th>";
                echo "<th>Phone Number</th>";
                echo "<th>Address</th>";
                echo "</tr>";

                $users = $db->query('SELECT * FROM users')->fetchAll();
                foreach($users as $user) {
                    echo "<tr>";
                    echo "<td>".$user['id']."</td>";
                    echo "<td>".$user['username']."</td>";
                    echo "<td>".$user['password']."</td>";
                    echo "<td>".$user['email']."</td>";
                    echo "<td>".$user['phone_number']."</td>";
                    echo "<td>".$user['address']."</td>";
                    echo "</tr>";
                }        

                echo "</table>"; ?>
            <br>
            <br>
            Do you want to change yout user settings. Just go to <a href="<?=$link?>settings.php">Settings</a> page.
            <br>
            <br>

            If you wanna exit you can <a href="<?=$link?>?logout">Logout</a>
        <?php } else { header("Location:".$link."login.php"); } ?>
        </div>
    </div>


</body>
</html>
