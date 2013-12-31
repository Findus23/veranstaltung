<?php
session_start();
if (isset($_POST["benutzername"])) {
    require_once "verbindungsaufbau.php"; //mit Server verbinden
    $user= $_POST["benutzername"];
    $passwort= $_POST["passwort"];
    $salt = "*|!JeFF28S,@Z3Sm5\1?";
    $salted_password = $salt . $passwort;
    $password_hash = hash('sha256', $salted_password);
    if($stmt = $mysqli->prepare("SELECT passwort,user_id,vorname,nachname FROM benutzer WHERE username=?")) {
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($password_db, $user_id, $vorname, $nachname);
        $stmt->fetch();
        if($password_db == $password_hash) {
           $_SESSION['user'] = $user;
		   $_SESSION['user_id'] = $user_id;
		   $_SESSION['vorname'] = $vorname;
		   $_SESSION['nachname'] = $nachname;
        } else {
          echo "falsches Passwort";
        }

    } else {
        echo "falscher Benutzername";
    }
    $mysqli->close();
}
if (!isset($_SESSION['user'])) {
?>
<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta name="author" content="Lukas" >
	<link rel="stylesheet" href="style.css" />
	<style type="text/css">
		input {
			width: auto;
		}

	</style>

</head>

<body>
<form action="login.php" method="POST">
<table>
	<tr>
		<td>Benutzername:</td>
		<td><input type="text" name="benutzername" required autofocus /></td>
	</tr>
	<tr>
		<td>Passwort:</td>
		<td><input type="password" name=passwort required /></td>
	</tr>
</table>
<input type="submit" value="anmelden" />
</form>



<?php
} else {
echo "Hallo " . $_SESSION['user'] . " - <a href='./login.php?abmelden=1'>Abmelden</a>";
echo "<script>window.opener.parent.location.reload();window.close();</script>";
}
if (isset($_GET["abmelden"])) {session_destroy();}
?>


</body>
</html>