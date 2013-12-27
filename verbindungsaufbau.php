<?php
$mysqli = new mysqli("localhost", "root", "", "veranstaltung"); //Mit MySQL verbinden
if ($mysqli->connect_error) {
	echo "Verbindungsfehler: ". mysql_connect_error();
	exit;
}
if (!$mysqli->set_charset("utf8")) { //Zeichensatz auf UTF-8 setzen (Umlaute!)
	echo "Fehler beim Laden von UTF-8";
}
?>