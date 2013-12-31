<!DOCTYPE html>

<html>

<head>
  <title>Veranstaltung erstellen</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./style.css" />


</head>

<body>

<h1>Veranstaltung erstellen</h1>
<form action="veranstaltung_erstellen.php" method="POST">
<table>
	<tr>
		<td>Name: </td>
		<td><input type="text" name="name" maxlength="50" required autofocus  /></td>
	</tr>
	<tr>
		<td>Beschreibung: </td>
		<td><textarea name="beschreibung" cols="31" rows="5" ></textarea> </td>
	</tr>
	<tr>
		<td>Tag:</td>
		<td><input type="date" name="tag" placeholder="dd.mm.yyyy" pattern="(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d" title="dd.mm.yyyy" /></td>
	</tr>
	<tr>
		<td>Uhrzeit</td>
		<td><input type="time" name="zeit" placeholder="hh:mm" pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$" title="hh:mm" /></td>
	</tr>
	<tr>
		<td>Veranstaltungsort:</td>
		<td><select name="ort" size="1">
<?php
require_once "verbindungsaufbau.php";


$ergebnis = $mysqli->query("SELECT * FROM orte");    //Ort-Tabelle auslesen
while ($zeile = $ergebnis->fetch_array()) {
    echo "<option value='" . htmlspecialchars($zeile['ort_id']) . "'>" . htmlspecialchars($zeile['ort_name']) . "</option>\n";           //Optionen in Dropdown-Liste eingeben
}
?>
</select><a href="./orte.php" target="Orte" >Orte anzeigen und bearbeiten</a></td>
	</tr>
</table>
<input type="submit" id="submit" value="Veranstaltung hinzufügen" style="width: auto;">
</form>

<?php
if (isset($_POST["name"]) && isset($_POST["beschreibung"]) && isset($_POST["tag"]) && isset($_POST["zeit"]) && isset($_POST["ort"])) {    //Wenn das Formular ausgefüllt wurde ...
    $name = $_POST["name"];
    $beschreibung = $_POST["beschreibung"];
    $tag = $_POST["tag"];
    $zeit = $_POST["zeit"];
    $ort = $_POST["ort"];
    $datetime = $tag . " " . $zeit . ":00";         // ... werden Tag und Uhrzeit zusammengefügt
    if ($stmt = $mysqli->prepare("INSERT INTO veranstaltungen (name, beschreibung, zeit, ort_id) VALUES (?, ?, ?, ?)")) {   // Der SQL-Befehl wirdvorbereitet ...
        $stmt->bind_param("sssi", $name, $beschreibung, $datetime, $ort);               // ... eingesetzt ...
        $stmt->execute();                                                               // ... und ausgeführt
        $stmt->close();
        $mysqli->close();
        header("Location: ".URL."/veranstaltungen.php");   // Auf die Hauptseite weiterleiten
    }
}
?>

</body>
</html>