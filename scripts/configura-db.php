<?php
// Configura il db
// Dati presi da config.php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "pass";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connessione al database fallita: " . mysqli_connect_error());
}

?>