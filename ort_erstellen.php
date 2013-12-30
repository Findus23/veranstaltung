<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Ort hinzufügen</title>
	<link rel="stylesheet" href="./style.css" />
</head>

<body>

<h1>Ort hinzufügen</h1>
<form action="ort_erstellen.php" method="POST">
<table>
	<tr>
		<td>Name:</td>
		<td><input type="text" name="name" maxlength="50" required autofocus /></td>
	</tr>
	<tr>
		<td>PLZ:</td>
		<td><input type="text" name="plz" maxlength="5" size="5" required /></td>
	</tr>
	<tr>
		<td>Stadt:</td>
		<td><input type="text" name="stadt" maxlength="50" required /></td>
	</tr>
	<tr>
		<td>Straße:</td>
		<td><input type="text" name="strasse" maxlength="50" size="5" /></td>
	</tr>
	<tr>
		<td>Hausnummer:</td>
		<td><input type="text" name="hausnummer" maxlength="5" size="3"/></td>
	</tr>
</table>
<input type="submit" value="Ort hinzufügen" style="width: auto;">
</form>
<?php
if (isset($_POST["name"])) {    //Wenn das Formular ausgefüllt wurde ...
	require_once "verbindungsaufbau.php"; //mit Server verbinden
    $name = $_POST["name"];
    $plz = $_POST["plz"];
    $stadt = $_POST["stadt"];
    $strasse = $_POST["strasse"];
    $hausnummer = $_POST["hausnummer"];
    if ($stmt = $mysqli->prepare("INSERT INTO orte (ort_name, stadt, plz, strasse, hausnummer) VALUES (?, ?, ?, ?, ?)")) {   // Der SQL-Befehl wird vorbereitet ...
        $stmt->bind_param("sssss", $name, $stadt, $plz, $strasse, $hausnummer);               // ... eingesetzt ...
        $stmt->execute();                                                               // ... und ausgeführt
        $stmt->close();
        $mysqli->close();
        header("Location: http://localhost/mysql/veranstaltung/orte.php");   // Auf die Hauptseite weiterleiten
    }
}
?>

</body>
</html>