<?php 
session_start();
include 'control-login.php';
include 'functions.php';
include 'configura-db.php';

$idUtente = $_SESSION["user_id"];
$username = $_POST["username"];
$password = $_POST["password"];

$key = $_POST["key"];
$algo = "AES-128-ECB";
$keyUser = 'bhf&7/aaohd7((67lhfoi£$76'.$idUtente;

$encryptedPassword = openssl_encrypt($password, $algo, $key, OPENSSL_RAW_DATA);
$encryptedPassword = base64_encode($encryptedPassword);


echo '<p>La tua passwprd è <span class="fw-semibold">'.$encryptedPassword.'</span></p>';

if($username){
    $hashedUsername = openssl_encrypt($username, $algo, $keyUser, OPENSSL_RAW_DATA);
    $hashedUsername = base64_encode($hashedUsername);

    $sql = "INSERT INTO password (username, password_admin, id_utente) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        echo "Errore nella preparazione della dichiarazione: " . $conn->error;
    } else {
        // Esegui il binding dei parametri
        $stmt->bind_param("sss", $hashedUsername, $encryptedPassword, $idUtente);
        
        // Esegui la query
        if ($stmt->execute()) {
            echo '<p class="fw-semibold text-primary">Password salvata nel tuo profilo</p>';
        } else {
            echo "Errore nell'inserimento del nuovo capitolo: " . $stmt->error;
        }
    }
}