<html>
<head>
<link rel="stylesheet" href="style.css" />
<script type="text/javascript">
function Fenster_klein (Adresse) {
  MeinFenster = window.open(Adresse, "Zweitfenster", "width=300,height=200,left=100,top=200"); // in einem neuen Fenster öffnen 
  MeinFenster.focus();
}
function Fenster_breit (Adresse) {
  MeinFenster = window.open(Adresse, "Zweitfenster", "width=500,height=400,left=100,top=200");
  MeinFenster.focus();
}
</script>
</head>
<body>
Du bist nicht angemeldet - <a href="./login.php" onclick="Fenster_klein(this.href, 300); return false"> melde dich</a> an oder <a href="./registrieren.php" onclick="Fenster_breit(this.href, 600); return false">registriere dich zum ersten mal</a>
<nav>
<a href="./veranstaltungen.php">Veranstaltungen</a>
<a href="./orte.php">Orte</a>
</nav>
<?php
?>
</body>
</html>