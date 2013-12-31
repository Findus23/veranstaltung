<?php
$mysqli = new mysqli("localhost", "root", "", "veranstaltung"); //Mit MySQL verbinden
if ($mysqli->connect_error) {
	echo "Verbindungsfehler: ". mysql_connect_error();
	exit;
}
if (!$mysqli->set_charset("utf8")) { //Zeichensatz auf UTF-8 setzen (Umlaute!)
	echo "Fehler beim Laden von UTF-8";
}
$host =htmlspecialchars($_SERVER["HTTP_HOST"]);
$url= rtrim(dirname(htmlspecialchars($_SERVER["PHP_SELF"])), "/\\");
$URL = "http://$host$url";
define("URL", $URL);
?>