<?php ob_start(); session_start();
try {
    $db = new PDO("mysql:host=localhost;dbname=users;charset=utf8", "admin", "password", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
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

    header("Location: http://localhost");
}

if($_POST) {
    if($_POST["method"] == "register") {
        $query = $db->query("SELECT * FROM users WHERE username = '{$_POST["username"]}'")->fetch(PDO::FETCH_ASSOC);
        if(!$query) {
            $sql = $db->prepare("INSERT INTO users (username, password)
            VALUES (:username, :password)");

            $sql->bindParam('username', $_POST["username"]);
            $sql->bindParam('password', $_POST["password"]);
            $sql->execute();

            create_flash_message("message", "User created succesfuly!");
        } else {
            create_flash_message("message", "User already created!");
        }

    } elseif($_POST["method"] == "login") {
        $query = $db->prepare("SELECT * FROM users WHERE username = :username");

        $query->bindParam('username', $_POST["username"]);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($_POST["password"] !== $result["password"]) {
            create_flash_message("message", "Please, enter correct password!");
        } else {
            setcookie("user_id", $result["id"]);
            create_flash_message("message", "Password is true.");
        }

        header("Refresh:0");
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
<body>
	<div align="center">
		<h1 style="color:red;">The Worst Auth App</h1>

		<?=show_flash_message("message")?>

        <?php if(isset($_COOKIE["user_id"])) { ?>
            <h2>Welcome to the worst auth app, <?=$user["username"]?>!</h2>
            <a href="http://68.183.106.165?logout">Çıkış Yap</a>
        <?php } else { ?>
		<h2>Login:</h2>
 		<form method="POST" action="http://localhost">
			<input type="hidden" name="method" value="login" />

 			<label for="username">Username:</label>
 			<input name="username" id="username" required></input>

 			<br><br>

			<label for="password">Password:</label>
 			<input name="password" id="password" required></input>

			<br>
			<br>
			<button type="submit">Sumbit</button>
		</form>

		<hr>

        <?php } ?>
	</div>
</body>
</html>


<!DOCTYPE html>
<html>
<body>
	<div align="center">
        <h2>Register:</h2>
 		<form method="POST" action="http://localhost">
			<input type="hidden" name="method" value="register" />

 			<label for="username">Username:</label>
 			<input name="username" id="username" required></input>

 			<br><br>

			<label for="password">Password:</label>
 			<input name="password" id="password" required></input>

			<br>
			<br>
			<button type="submit">Submit</button>
		</form>
        </div>
    </body>
</html>
