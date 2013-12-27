<?php
if (isset($_POST["benutzername"])) {
    require_once "verbindungsaufbau.php"; //mit Server verbinden
    $user= $_POST["benutzername"];
    $passwort= $_POST["passwort"];
    $salt = "*|!JeFF28S,@Z3Sm5\1?";
    $salted_password = $salt . $passwort;
    $password_hash = hash('sha256', $salted_password);
    if($stmt = $mysqli->prepare("SELECT passwort FROM benutzer WHERE username=?")) {
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->bind_result($password_db);
        $stmt->fetch();
        if($password_db == $password_hash) {
           echo "Hallo $user";
           $richtig="yes";
           setcookie("angemeldet", $user);
        } else {
          echo "falsches Passwort";
        }

    } else {
        echo "falscher Benutzername";
    }
    $mysqli->close();
}
if (!isset($richtig) || $richtig != "yes") {
?>
<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Login</title>
	<meta name="author" content="Lukas" >

</head>

<body>
<form action="login.php" method="POST">
<p>Benutzername: <input type="text" name="benutzername"/></p>
<p>Passwort: <input type="password" name=passwort /></p>
<p><input type="submit" value="anmelden" /></p>
</form>



<?php
}

?>


</body>
</html>