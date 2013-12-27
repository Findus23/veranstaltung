<!DOCTYPE html>
<html lang="de">

<head>
	<meta charset="utf-8" />
	<title>Teilnahme</title>
	<meta name="author" content="Lukas" >
<script type="text/javascript">
function FensterOeffnen (Adresse) {
  MeinFenster = window.open(Adresse, "Zweitfenster", "width=300,height=400,left=100,top=200");
  MeinFenster.focus();
}
</script>
</head>

<body>
<h1>Teilnahme-Bestätigung</h1>
<?php
session_start();
if (isset($_SESSION["user"])) {
    echo "Du bist angemeldet";
} else {
?>
<p>Bitte <a href="./login.php" onclick="FensterOeffnen(this.href); return false"> melde dich</a> an (oder <a href="./registrieren.php" onclick="FensterOeffnen(this.href); return false">registriere dich zum ersten mal</a>)</a></p>

<?php
}
?>

</body>
</html>