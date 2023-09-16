<?php 

$paginaDaEliminare = $_POST["idPage"];

$directory = "../"; // Directory principale
$fileDaEliminare = $directory . $paginaDaEliminare;

if (file_exists($fileDaEliminare)) {
    if (unlink($fileDaEliminare)) {
        echo "La pagina '$paginaDaEliminare' è stata eliminata con successo.";
    } else {
        echo "Impossibile eliminare la pagina '$paginaDaEliminare'.";
    }
} else {
    echo "La pagina '$paginaDaEliminare' non esiste.";
}
