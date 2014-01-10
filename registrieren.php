<!DOCTYPE html>

<html>

<head>
  <title>Registrieren</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./style.css" />


</head>

<body>

<h1>Registrieren</h1>

<?php

if (isset($_POST["benutzername"])) {    //Wenn das Formular ausgefüllt wurde ...
	require_once "verbindungsaufbau.php";
    $benutzername = $_POST["benutzername"];
    $vorname = $_POST["vorname"];
    $nachname = $_POST["nachname"];
    $passwort_1 = $_POST["passwort_1"];
    $passwort_2 = $_POST["passwort_2"];
	$email = $_POST["email"];

    if ($passwort_1 != $passwort_2) { // überprüfen ob beide Passwörter übereinstimmen
        echo "<strong>Das Passwort wurde falsch eingegeben</strong>";
        exit();
    }
    if ($stmt = $mysqli->prepare("SELECT COUNT(*) FROM benutzer WHERE username=?")) { // überprüfen ob der Benutzername schon vergeben wurde.
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
    $salt = "*|!JeFF28S,@Z3Sm5\1?"; //zufälligen geheimen Wert verwenden ...
    $salted_password = $salt . $passwort_1; // und diesen an das Passwort anhängen ...
    $password_hash = hash('sha256', $salted_password); // ... und zuletzt das zusammengehängte Passwort mittels sha256 hashen
    if ($stmt = $mysqli->prepare("INSERT INTO benutzer (username, passwort, vorname, nachname, email) VALUES (?, ?, ?, ?, ?)")) {   // Der SQL-Befehl wird vorbereitet ...
        $stmt->bind_param("sssss", $benutzername, $password_hash, $vorname, $nachname, $email);               // ... eingesetzt ...
        $stmt->execute();                                                               // ... und ausgeführt
        $stmt->close();
        $mysqli->close();
        echo "<p>Benutzer erfolgreich angelegt</p>";
        echo "<p><input type='button' value='Fenster schließen' onclick='window.opener.parent.location.reload();window.close()'></p>"; // Beim Klick auf den Link wird das Fenster geschlossen und das Hauptfenster neu geladen

    }
} else {
?>

<form action="registrieren.php" method="POST">
<table>
	<tr>
		<td>Benutzername:</td>
		<td><input type="text" name="benutzername" maxlength="10" autofocus required /></td>
	</tr>
	<tr>
		<td>Vorname:</td>
		<td><input type="text" name="vorname" maxlength="10" required/></td>
	</tr>
	<tr>
		<td>Nachname:</td>
		<td><input type="text" name="nachname" maxlength="10" required/></td>
	</tr>
	<tr>
		<td>Email:</td>
		<td><input type="email" name="email" maxlength="50" required /></td>
	</tr>
	<tr>
		<td>Passwort:</td>
		<td><input type="password" id="password" name="passwort_1" required /></td>
	</tr>
	<tr>
		<td>Passwort wiederholen</td>
		<td><input type="password" id="passwordconf" name="passwort_2" required oninput="check(this)" /></td>
	</tr>
<script language='javascript' type='text/javascript'>
function check(input) { //Beim Abschicken wird überprüft ob die Passwörter übereinstimmen -- wenn nicht wird eine Meldung ausgegeben (funktioniert nur bei modernen Browsern) -> sonst per PHP
    if (input.value != document.getElementById('password').value) {
        input.setCustomValidity('Die beiden Passwörter müssen übereinstimmen');
    } else {
        input.setCustomValidity('');
   }
}
</script>
</table>
<input type="submit" value="Registrieren" style="width: auto;">
</form>
<?php } ?>
</body>
</html>