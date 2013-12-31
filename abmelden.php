<?php
session_start();
session_destroy();
header("Location: http://localhost/mysql/veranstaltung/veranstaltungen.php");

?>