<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Teilnahme</title>
	<meta name="author" content="Lukas" >
	<link rel="stylesheet" href="./style.css" />

<script type="text/javascript">
function Fenster_klein (Adresse) {
  MeinFenster = window.open(Adresse, "Zweitfenster", "width=300,height=200,left=100,top=200");
  MeinFenster.focus();
}
function Fenster_breit (Adresse) {
  MeinFenster = window.open(Adresse, "Zweitfenster", "width=500,height=400,left=100,top=200");
  MeinFenster.focus();
}
</script>
</head>

<body>
<h1>Teilnahme-Bestätigung</h1>
<?php
session_start();
if (isset($_SESSION["user"]) && isset($_GET["id"])) {
	require_once "verbindungsaufbau.php"; //mit Server verbinden
    if ($stmt = $mysqli->prepare("INSERT INTO teilnahmen (teilnehmer_id, veranstaltungs_id) VALUES (?, ?)")) {   // Der SQL-Befehl wird vorbereitet ...
        $stmt->bind_param("ii", $_SESSION["user_id"], $_GET["id"]);               // ... eingesetzt ...
        $stmt->execute();                                                               // ... und ausgeführt
        $stmt->close();
        $mysqli->close();
		echo "<p>Hallo, " . $_SESSION["vorname"] . " " . $_SESSION["nachname"] . "! Du wurdest erfolgreich in die Veranstaltung eingetragen. <a href='./veranstaltungen.php'>Zurück zur Hauptseite</a>
<p/>";
	} else {echo "<p><b>Es ist ein technisches Problem aufgetreten.</b></p>";}
} else {
?>
<p>Bitte <a href="./login.php" onclick="Fenster_klein(this.href, 300); return false"> melde dich</a> an oder <a href="./registrieren.php" onclick="Fenster_breit(this.href, 600); return false">registriere dich zum ersten mal</a></p>

<?php
}
?>
</body>
</html>