<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Orte</title>
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

$ergebnis = $mysqli->query("SELECT * FROM orte");  //SQL Befehl ausführen
echo "<table border='1'>\n";
echo "<tr><th>Name</th><th>Stadt</th><th>Straße</th><th>Ändern</th><th>Löschen</th>"; //Zeile mit Überschriften
while ($zeile = $ergebnis->fetch_array()) {
		echo "<tr><td>" . htmlspecialchars($zeile["ort_name"]) . "</td>"
        . "<td>" . htmlspecialchars($zeile['plz']) . " " . htmlspecialchars($zeile['stadt']) . "</td> "
        . "<td> " . htmlspecialchars($zeile['strasse']) . " " . htmlspecialchars($zeile['hausnummer']) . "</td>"
        . "<td><a href='./ort_aendern.php?id=" . htmlspecialchars($zeile['ort_id']) . "'>ändern</a></td>"
        . "<td><a href='./ort_loeschen.php?id=" . htmlspecialchars($zeile['ort_id']) . "'>löschen</a></td>"
        ."</td></tr>\n" ;
}
echo "</table>";

$ergebnis->close();
$mysqli->close();


?>

<a href="ort_erstellen.php">neuen Ort hinzufügen</a>
</body>
</html>