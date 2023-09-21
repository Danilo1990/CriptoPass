<?php 
include 'configura-db.php'; 
$id = $_POST['id'];
$newSite = $_POST['newSite'];
$newUser = $_POST['newUser'];
$newPass = $_POST['newPass'];


$query = "UPDATE password SET sito = '$newSite', username = '$newUser', password_admin = '$newPass' WHERE id_pass = $id";

if (mysqli_query($conn, $query)) {
    echo 'change';
} else {
    echo "Errore nell'aggiornamento: " . mysqli_error($conn);
}

