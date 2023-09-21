<?php 
// Processo di eliminazione accout
// Form nella pagia area-riservata.php

session_start();

include 'control-login.php';
include 'functions.php';
include 'configura-db.php'; 

// Ricevi l'id_utente dalla richiesta POST

$idUtente = $_POST['idUtente'];

// Esegui la query per eliminare le righe associate all'id_utente
$sql = "DELETE FROM user WHERE id_utente = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Errore nella preparazione della query: " . $conn->error;
} else {
    $stmt->bind_param("i", $idUtente);
    
    if ($stmt->execute()) {
        alertCustom('Account eliminato con successo', 'success');
        header("Location: ../login.php?deleteAccount=Account eliminato");
    } else {
        echo "Errore nell'eliminazione delle pagine: " . $stmt->error;
    }

    $stmt->close();
}
