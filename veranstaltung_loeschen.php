<?php
require_once "verbindungsaufbau.php"; //mit SQL-Server verbinden


if (isset($_GET["id"]) && is_numeric($_GET["id"])) { // Wenn die id gültig ist ...
    $id = $_GET["id"];
    if ($stmt = $mysqli->prepare("DELETE FROM veranstaltungen WHERE veranstaltungs_id=?")) { // ... diese Veranstaltung löschen
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        header("Location: ".URL."/veranstaltungen.php"); // zur Hauptseite weiterleiten
    } else {
      echo "SQL-Fehler";
    }
} else {
  echo "unerlaubter id-Parameter";
}
?>