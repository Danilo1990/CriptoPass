<?php 
session_start();
include '../scripts/functions.php';
include '../scripts/configura-db.php';
$link = $_POST['link'];
$requested_url = str_replace('/', '', $link);

$sql = "SELECT * FROM page WHERE page = '$requested_url'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

$titolo = $row["titolo"];
$contenuto = $row["contenuto"];
$response = array(
    "titolo" => $titolo,
    "contenuto" => $contenuto
);
header('Content-Type: application/json');
echo json_encode($response);
