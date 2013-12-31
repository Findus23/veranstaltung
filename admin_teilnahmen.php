<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Teilnahmen</title>
	<meta name="author" content="Lukas" >
    <link rel="stylesheet" href="./style.css" />
	<style type="text/css">
		form {
			display:inline;
		}
	</style>
</head>

<body>
Filtern nach
<form>
<select name="v_id" size="1" onchange="submit()">
	<option value="">Veranstaltung</option>
<?php
require_once "verbindungsaufbau.php";
$ergebnis = $mysqli->query("SELECT * FROM veranstaltungen");    //Ort-Tabelle auslesen
while ($zeile = $ergebnis->fetch_array()) {
	if (isset($_GET["v_id"]) && $zeile['veranstaltungs_id'] == $_GET["v_id"]) {
    	echo "<option selected  value='" . htmlspecialchars($zeile['veranstaltungs_id']) . "'>" . htmlspecialchars($zeile['name']) . "</option>\n";           //Optionen in Dropdown-Liste eingeben
	} else {
    	echo "<option  value='" . htmlspecialchars($zeile['veranstaltungs_id']) . "'>" . htmlspecialchars($zeile['name']) . "</option>\n";           //Optionen in Dropdown-Liste eingeben
	}
}
$ergebnis->close();
?>
</select>
</form>oder
<form>
<select name="u_id" size="1" onchange="submit()">
	<option value="">Benutzer</option>

<?php
$ergebnis = $mysqli->query("SELECT * FROM benutzer");    //Ort-Tabelle auslesen
while ($zeile = $ergebnis->fetch_array()) {
	if (isset($_GET["u_id"]) && $zeile['user_id'] == $_GET["u_id"]) {
    echo "<option selected onchange=submit() value='" . htmlspecialchars($zeile['user_id']) . "'>" . htmlspecialchars($zeile['username']) . "</option>\n";           //Optionen in Dropdown-Liste eingeben
	} else {
    echo "<option onchange=submit() value='" . htmlspecialchars($zeile['user_id']) . "'>" . htmlspecialchars($zeile['username']) . "</option>\n";           //Optionen in Dropdown-Liste eingeben
	}
}
$ergebnis->close();
?>
</select>
</form>

<?php
echo "<table border='1'>\n";
if (!isset($_GET["u_id"]) && !isset($_GET["v_id"]) || isset($_GET["v_id"]) && !is_numeric($_GET["v_id"]) || isset($_GET["u_id"]) && !is_numeric($_GET["u_id"])) {
	$ergebnis = $mysqli->query("SELECT * FROM teilnahmen,benutzer,veranstaltungen WHERE veranstaltungen.veranstaltungs_id = teilnahmen.veranstaltungs_id AND user_id=teilnehmer_id ORDER BY veranstaltungen.veranstaltungs_id ");  //SQL Befehl ausführen
	echo "<tr><th>Veranstaltung</th><th>Name (Benutzername)</th><th>E-Mail</th></tr>"; //Zeile mit Überschriften
	while ($zeile = $ergebnis->fetch_array()) {
			echo "<tr><td>" . htmlspecialchars($zeile["name"]) . "</td>"
			. "<td>" . htmlspecialchars($zeile["vorname"]) . " " . htmlspecialchars($zeile["nachname"]) . " (" . htmlspecialchars($zeile["username"]) .")</td>"
			. "<td><a href='mailto:" . htmlspecialchars($zeile["email"]) . "'>"  . htmlspecialchars($zeile["email"]) . "</a>" . "</td>"
 	       ."</tr>\n" ;
	}
} elseif(isset($_GET["u_id"]) && is_numeric ($_GET["u_id"])) {
	$u_id = $_GET["u_id"];
   	$ergebnis = $mysqli->query("SELECT * FROM teilnahmen,benutzer,veranstaltungen WHERE veranstaltungen.veranstaltungs_id = teilnahmen.veranstaltungs_id AND user_id=teilnehmer_id AND user_id =$u_id ORDER BY veranstaltungen.veranstaltungs_id ");  //SQL Befehl ausführen
	echo "<tr><th>Veranstaltung</th></tr>"; //Zeile mit Überschriften
	while ($zeile = $ergebnis->fetch_array()) {
	  		echo "<tr><td>" . htmlspecialchars($zeile["name"]) . "</td>" . "</tr>\n" ;
}
} elseif(isset($_GET["v_id"]) && is_numeric ($_GET["v_id"])) {
	$v_id = $_GET["v_id"];
   	$ergebnis = $mysqli->query("SELECT * FROM teilnahmen,benutzer,veranstaltungen WHERE veranstaltungen.veranstaltungs_id = teilnahmen.veranstaltungs_id AND user_id=teilnehmer_id AND veranstaltungen.veranstaltungs_id =$v_id ORDER BY user_id ");  //SQL Befehl ausführen
	echo "<tr><th>Name (Benutzername)</th><th>E-Mail</th></tr>"; //Zeile mit Überschriften
	while ($zeile = $ergebnis->fetch_array()) {
			echo "<td>" . htmlspecialchars($zeile["vorname"]) . " " . htmlspecialchars($zeile["nachname"]) . " (" . htmlspecialchars($zeile["username"]) .")</td>"
 			. "<td><a href='mailto:" . htmlspecialchars($zeile["email"]) . "'>"  . htmlspecialchars($zeile["email"]) . "</a>" . "</td>"
 	       ."</tr>\n" ;
}
}

echo "</table>";
$ergebnis->close();
$mysqli->close();


?>

</body>
</html>