<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Meine Website</title>
	<meta name="author" content="Lukas" >
    <style>
    tr:nth-child(2n) td {
        background: #EEE8AA;
}

    </style>
</head>

<body>
<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden

$ergebnis = $mysqli->query("SELECT * FROM orte, veranstaltungen WHERE orte.ort_id = veranstaltungen.ort_id");  //SQL Befehl ausführen
echo "<table border='1'>\n";
echo "<tr><th>Veranstaltungsname</th><th>Beschreibung</th><th>Zeit</th><th>Ort</th><th>Adresse</th><th>Ändern</th><th>Löschen</th>"; //Zeile mit Überschriften
while ($zeile = $ergebnis->fetch_array()) {
		echo "<tr><td>" . htmlspecialchars($zeile["name"]) . "</td>"
        . "<td>" . htmlspecialchars($zeile['beschreibung']) . "</td>"
        . "<td>" . date( 'd.m.Y H:i', strtotime(htmlspecialchars($zeile['zeit'])))
        . "<td>" . htmlspecialchars($zeile['ort_name']) . "</td>"
        . "<td>" . htmlspecialchars($zeile['plz']) . " " . htmlspecialchars($zeile['stadt']) . "<br /> " . htmlspecialchars($zeile['strasse']) . " " . htmlspecialchars($zeile['hausnummer']) . "</td>"
        . "<td><a href='./veranstaltung_aendern.php?id=" . htmlspecialchars($zeile['veranstaltungs_id']) . "'>ändern</a></td>"
        . "<td><a href='./veranstaltung_loeschen.php?id=" . htmlspecialchars($zeile['veranstaltungs_id']) . "'>löschen</a></td>"
        ."</td></tr>\n" ;
}
echo "</table>";

$ergebnis->close();
$mysqli->close();


?>

<a href="veranstaltung_erstellen.php">Veranstaltung erstellen</a>
</body>
</html>