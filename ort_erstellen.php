<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title>Ort hinzufügen</title>
</head>

<body>

<h1>Ort hinzufügen</h1>
<form action="ort_erstellen.php" method="POST">
<p>Name: <input type="text" name="name" maxlength="50"/></p>
<p>PLZ: <input type="text" name="plz" maxlength="5" size="5" /> Stadt: <input type="text" name="stadt" maxlength="50"/></p>
<p>Straße: <input type="text" name="strasse" maxlength="50" size="5" /> Hausnummer: <input type="text" name="hausnummer" maxlength="5" size="3"/></p>
<p><input type="submit" value="Ort hinzufügen"></p>


</form>

<?php
require_once "verbindungsaufbau.php"; //mit Server verbinden

if (isset($_POST["name"])) {    //Wenn das Formular ausgefüllt wurde ...
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