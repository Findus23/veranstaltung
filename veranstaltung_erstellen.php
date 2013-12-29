<!DOCTYPE html>

<html>

<head>
  <title>Veranstaltung erstellen</title>
  <meta charset="utf-8" />

</head>

<body>

<h1>Veranstaltung erstellen</h1>
<form action="veranstaltung_erstellen.php" method="POST">
<p>Name: <input type="text" name="name" maxlength="50"/></p>
<p>Beschreibung: <textarea name="beschreibung" cols="30" rows="3" ></textarea> </p>
<p>Tag (dd.mm.yyyy): <input type="date" name="tag" />Uhrzeit (HH:MM): <input type="time" name="zeit" /></p>
Veranstaltungsort:<select name="ort" size="1">
<?php
require_once "verbindungsaufbau.php";


$ergebnis = $mysqli->query("SELECT * FROM orte");    //Ort-Tabelle auslesen
while ($zeile = $ergebnis->fetch_array()) {
    echo "<option value='" . htmlspecialchars($zeile['ort_id']) . "'>" . htmlspecialchars($zeile['ort_name']) . "</option>\n";           //Optionen in Dropdown-Liste eingeben
}
?>
</select> <a href="./orte.php" target="Orte" >Orte anzeigen und bearbeiten</a>
<p><input type="submit" value="Veranstaltung hinzufügen"></p>


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
        header("Location: http://localhost/mysql/veranstaltung/veranstaltungen.php");   // Auf die Hauptseite weiterleiten
    }
}
?> 

</body>
</html>