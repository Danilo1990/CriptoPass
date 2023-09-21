<?php 
session_start();
include '../inc/functions.php';
include '../inc/configura-db.php';

$titolo = $_POST['titolo'];
$contenuto = $_POST['contenuto'];
$pageSelect = $_POST['pageSelect'];

$sqlDelete = "DELETE FROM page WHERE page = '$pageSelect'";
$resultDelete = $conn->query($sqlDelete);

$sql = "INSERT INTO page (titolo, contenuto, page) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
     echo "Errore nella preparazione della dichiarazione: " . $conn->error;
} else {
    // Esegui il binding dei parametri
    $stmt->bind_param("sss", $titolo, $contenuto, $pageSelect);
    
    // Esegui la query
    if ($stmt->execute()) {
        echo 'Caricato con successo';
    } else {
        echo "Errore nell'inserimento: " . $stmt->error;
    }
}

