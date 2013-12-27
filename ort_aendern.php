<!DOCTYPE html>

<html>

<head>
  <title>Ort ändern</title>
  <meta charset="utf-8" />

</head>

<body>
<?php
require_once "verbindungsaufbau.php";
if (empty($_POST["name"])) {
    if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {     // wenn die id-manipuliert wurde abbrechen
        header("Location: http://localhost/mysql/veranstaltung/orte.php");

    }
    $id = $_GET["id"];
    if ($stmt = $mysqli->prepare("SELECT ort_name, stadt, plz, strasse, hausnummer FROM orte WHERE ort_id=?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($name, $stadt, $plz, $strasse, $hausnummer);              //Daten auslesen und in Variablen speichern
        $stmt->fetch();
        $stmt->close();
    }
?>
<h1>Ort ändern</h1>
<form action="ort_aendern.php" method="POST">
<p>Name: <input type="text" name="name" maxlength="50" value="<?php echo $name; ?>"/></p>
<p>PLZ: <input type="text" name="plz" maxlength="5" size="5" value="<?php echo $plz; ?>" /> Stadt: <input type="text" name="stadt" maxlength="50" value="<?php echo $stadt; ?>"/></p>
<p>Straße: <input type="text" name="strasse" maxlength="50" size="5" value="<?php echo $strasse; ?>" /> Hausnummer: <input type="text" name="hausnummer" maxlength="5" size="3" value="<?php echo $hausnummer; ?>"/></p>
<input type="hidden" name="id" value="<?php echo $id ?>" />
<p><input type="submit" value="Ort ändern"></p>


</form>

<?php
$mysqli->close();
} else {
    $name = $_POST["name"];
    $stadt = $_POST["stadt"];
    $plz = $_POST["plz"];
    $strasse = $_POST["strasse"];
    $hausnummer = $_POST["hausnummer"];
    $id = $_POST["id"];
    if ($stmt = $mysqli->prepare("UPDATE orte set ort_name=?,stadt=?, plz=?, strasse=?, hausnummer=? WHERE ort_id=?")) {
        $stmt->bind_param("sssssi", $name, $stadt, $plz, $strasse, $hausnummer, $id);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        header("Location: http://localhost/mysql/veranstaltung/orte.php");

    } else {
      echo "Wir haben ein Problem: " . $mysqli->error;
    }

}

?>

</body>
</html>