<?php
session_start();
if (isset($_SESSION['user'])) {
  $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    echo "Hallo " . $_SESSION['user'] . " - <a href='" . $url . "?abmelden=1'>Abmelden</a>";

}else {
?>
<script type="text/javascript">
function FensterOeffnen (Adresse) {
  MeinFenster = window.open(Adresse, "Zweitfenster", "width=300,height=400,left=100,top=200");
  MeinFenster.focus();
}
</script>
<p class="hover">Du bist nicht angemeldet - <a href="./login.php" onclick="FensterOeffnen(this.href); return false">Anmelden</a></p>
<?php
}
if (isset($_GET["abmelden"])) {unset($_SESSION['user']);}

?>
