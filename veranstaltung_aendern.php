<!DOCTYPE html>

<html>

<head>
  <title>Veranstaltung ändern</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="./style.css" />


</head>

<body>
<?php
require_once "verbindungsaufbau.php";
if (empty($_POST["name"])) {
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {     // wenn die id-manipuliert wurde abbrechen
        header("Location: http://localhost/mysql/veranstaltung/veranstaltungen.php");

    }
    $id = $_GET["id"];
    if ($stmt = $mysqli->prepare("SELECT name, beschreibung, zeit, ort_id FROM veranstaltungen WHERE veranstaltungs_id=?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($name, $beschreibung, $datetime, $ort);              //Daten auslesen und in Variablen speichern
        $stmt->fetch();
        $stmt->close();
        $zeit = explode(" ", $datetime);               // Zeit wieder in Datum und Uhrzeit aufteilen
    }
?>
<h1>Veranstaltung ändern</h1>
<form action="veranstaltung_aendern.php" method="POST">
<p>Name: <input type="text" name="name" maxlength="50" value="<?php echo htmlspecialchars($name); ?>"/></p>
<p>Beschreibung: <textarea name="beschreibung" cols="30" rows="3"><?php echo htmlspecialchars($beschreibung); ?></textarea> </p>
<p>Tag (dd.mm.yyyy): <input type="date" name="tag" value="<?php echo htmlspecialchars($zeit[0]); ?>" />Uhrzeit (HH:MM): <input type="time" name="zeit" value="<?php echo htmlspecialchars($zeit[1]); ?>" /></p>
Veranstaltungsort:<select name="ort" size="1">
<?php
    $ergebnis = $mysqli->query("SELECT * FROM orte");
    while ($zeile = $ergebnis->fetch_array()) {
       if ($zeile['ort_id'] == $ort) {
            echo "<option selected value='" . htmlspecialchars($zeile['ort_id']) . "'>" . htmlspecialchars($zeile['ort_name']) . "</option>\n";
        } else {
            echo "<option value='" . htmlspecialchars($zeile['ort_id']) . "'>" . htmlspecialchars($zeile['ort_name']) . "</option>\n";
       }
    }
$mysqli->close();
?>
</select> <a href="./orte.php" target="Orte" >Orte anzeigen und bearbeiten</a>
<input type="hidden" name="id" value="<?php echo $id ?>" />
<p><input type="submit" value="Veranstaltung ändern"></p>


</form>

<?php

} else {
    $name = $_POST["name"];
    $beschreibung = $_POST["beschreibung"];
    $tag = $_POST["tag"];
    $zeit = $_POST["zeit"];
    $ort = $_POST["ort"];
    $id = $_POST["id"];
    $datetime = $tag . " " . $zeit . ":00";
    if ($stmt = $mysqli->prepare("UPDATE veranstaltungen set name=?, beschreibung=?, zeit=?, ort_id=? WHERE veranstaltungs_id=?")) {
        $stmt->bind_param("sssii", $name, $beschreibung, $datetime, $ort, $id);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        header("Location: http://localhost/mysql/veranstaltung/veranstaltungen.php");

    } else {
      echo "Wir haben ein Problem: " . $mysqli->error;
    }

}

?>

</body>
</html>