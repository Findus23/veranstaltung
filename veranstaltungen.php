<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Veranstaltungen</title>
	<meta name="author" content="Lukas" >
    <link rel="stylesheet" href="./style.css" />
</head>

<body>
<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden

$ergebnis = $mysqli->query("SELECT * FROM orte, veranstaltungen WHERE orte.ort_id = veranstaltungen.ort_id");  //SQL Befehl ausführen
echo "<table border='1'>\n";
echo "<tr><th>Veranstaltungsname</th><th>Beschreibung</th><th>Zeit</th><th>Ort</th><th>Adresse</th><th>Teinehmen</th><th>Ändern</th><th>Löschen</th>"; //Zeile mit Überschriften
while ($zeile = $ergebnis->fetch_array()) { // für jeden Wert in der Datenbank eine Tabellenzeile
		echo "<tr><td>" . htmlspecialchars($zeile["name"]) . "</td>"
        . "<td>" . htmlspecialchars($zeile['beschreibung']) . "</td>"
        . "<td>" . date( 'd.m.Y H:i', strtotime(htmlspecialchars($zeile['zeit'])))
        . "<td>" . htmlspecialchars($zeile['ort_name']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['plz']) . " " . htmlspecialchars($zeile['stadt']) . "<br /> " . htmlspecialchars($zeile['strasse']) . " " . htmlspecialchars($zeile['hausnummer']) . "</td>"
        . "<td><a class='tabelle' href='./teilnahme.php?id=" . htmlspecialchars($zeile['veranstaltungs_id']) . "'><b>teilnehmen</b></a></td>"
        . "<td><a class='tabelle' href='./veranstaltung_aendern.php?id=" . htmlspecialchars($zeile['veranstaltungs_id']) . "'>ändern</a></td>"
        . "<td><a class='tabelle' href='./veranstaltung_loeschen.php?id=" . htmlspecialchars($zeile['veranstaltungs_id']) . "'>löschen</a></td>"
        ."</td></tr>\n" ;
}
echo "</table>";

$ergebnis->close();
$mysqli->close();


?>

<a href="veranstaltung_erstellen.php">Veranstaltung erstellen</a>
<br /><a href="orte.php">alle Orte anzeigen</a>

</body>
</html>