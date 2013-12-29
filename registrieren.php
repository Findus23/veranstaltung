<!DOCTYPE html>

<html>

<head>
  <title>Registrieren</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./style.css" />


</head>

<body>

<h1>Registrieren</h1>
<form action="registrieren.php" method="POST">
<p>Benutzername: <input type="text" name="benutzername" maxlength="50"/></p>
<p>Vorname: <input type="text" name="vorname" maxlength="50"/></p>
<p>Nachname: <input type="text" name="nachname" maxlength="50"/></p>
<p>Passwort: <input type="password" name="passwort_1" maxlength="50"/></p>
<p>Passwort wiederholen: <input type="password" name="passwort_2" maxlength="50"/></p>

<p><input type="submit" value="Registrieren"></p>

</form>

<?php
require_once "verbindungsaufbau.php";

if (isset($_POST["benutzername"])) {    //Wenn das Formular ausgefüllt wurde ...
    $benutzername = $_POST["benutzername"];
    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $passwort_1 = $_POST["passwort_1"];
    $passwort_2 = $_POST["passwort_2"];
    if ($stmt = $mysqli->prepare("SELECT COUNT(*) FROM benutzer WHERE username=?")) {
        $stmt->bind_param("s", $benutzername);
        $stmt->execute();
        $stmt->bind_result($treffer);
        $stmt->fetch();
        $stmt->close();
        if ($treffer != 0) {
            echo "<strong>Benutzername schon vergeben</strong>";
            exit();
        }
    }
    if ($passwort_1 != $passwort_2) {
        echo "<strong>Das Passwort wurde falsch eingegeben</strong>";
        exit();
    }
    $salt = "*|!JeFF28S,@Z3Sm5\1?";
    $salted_password = $salt . $passwort_1;
    $password_hash = hash('sha256', $salted_password);
    if ($stmt = $mysqli->prepare("INSERT INTO benutzer (username, passwort, vorname, nachname) VALUES (?, ?, ?, ?)")) {   // Der SQL-Befehl wird vorbereitet ...
        $stmt->bind_param("ssss", $benutzername, $password_hash, $vorname, $nachname);               // ... eingesetzt ...
        $stmt->execute();                                                               // ... und ausgeführt
        $stmt->close();
        $mysqli->close();
        echo "<p>Benutzer erfolgreich angelegt</p>";
        echo "<p><input type='button' value='Fenster schließen' onclick='window.opener.parent.location.reload();window.close()'></p>";

    }
}
?>

</body>
</html>