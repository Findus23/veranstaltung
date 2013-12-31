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
        header("Location: ".URL."/veranstaltungen.php");

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
<table>
	<tr>
		<td>Name: </td>
		<td><input type="text" name="name" maxlength="50" required value="<?php echo htmlspecialchars($name); ?>" /></td>
	</tr>
	<tr>
		<td>Beschreibung: </td>
		<td><textarea name="beschreibung" cols="31" rows="5" ><?php echo htmlspecialchars($beschreibung); ?></textarea> </td>
	</tr>
	<tr>
		<td>Tag:</td>
		<td><input type="date" name="tag" placeholder="dd.mm.yyyy" value="<?php echo htmlspecialchars($zeit[0]); ?>" pattern="(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d" title="dd.mm.yyyy" /></td>
	</tr>
	<tr>
		<td>Uhrzeit</td>
		<td><input type="time" name="zeit" placeholder="hh:mm" value="<?php echo htmlspecialchars($zeit[1]); ?>" pattern="^([01][0-9]|2[0-3]):([0-5][0-9])$" title="hh:mm" /></td>
	</tr>
	<tr>
		<td>Veranstaltungsort:</td>
		<td><select name="ort" size="1"><?php
    $ergebnis = $mysqli->query("SELECT * FROM orte");
    while ($zeile = $ergebnis->fetch_array()) {
       if ($zeile['ort_id'] == $ort) {
            echo "<option selected value='" . htmlspecialchars($zeile['ort_id']) . "'>" . htmlspecialchars($zeile['ort_name']) . "</option>\n";
        } else {
            echo "<option value='" . htmlspecialchars($zeile['ort_id']) . "'>" . htmlspecialchars($zeile['ort_name']) . "</option>\n";
       }
    }
$mysqli->close();
?></select><a href="./orte.php" target="Orte" >Orte anzeigen und bearbeiten</a></td>
	</tr>
</table>
<input type="hidden" name="id" value="<?php echo $id ?>" />
<input type="submit" id="submit" value="Veranstaltung ändern" style="width: auto;">
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
        header("Location: ".URL."/veranstaltungen.php");

    } else {
      echo "Wir haben ein Problem: " . $mysqli->error;
    }

}

?>

</body>
</html>