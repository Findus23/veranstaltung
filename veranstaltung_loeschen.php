<?php
require_once "verbindungsaufbau.php";


if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];
    if ($stmt = $mysqli->prepare("DELETE FROM veranstaltungen WHERE veranstaltungs_id=?")) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        header("Location: ".URL."/veranstaltungen.php");
    } else {
      echo "Fehler";
    }
} else {
  echo "unerlaubter Parameter";
}
?>