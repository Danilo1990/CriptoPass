<?php 
session_start();
include 'configura-db.php'; 
include 'functions.php'; 

// Recupera la vecchia password dell'utente dal database
$user_id = $_SESSION['user_id']; // Assumi che tu abbia l'ID dell'utente in sessione
$sql = "SELECT password FROM user WHERE id_utente = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($hashed_password);
$stmt->fetch();
$stmt->close();

// Verifica se la vecchia password fornita dall'utente corrisponde a quella memorizzata
if (password_verify($_POST['old_password'], $hashed_password)) {

    $new_password = $_POST['new_password'];

    if($_POST['old_password'] === $new_password) {
        echo '<span class="text-white bg-danger p-2">La password non può essere uguale a quella precedente</span>';
        return false;
    }

    if (strlen($new_password) < 8 || !preg_match('/[A-Z]/', $new_password)) {
        echo '<span class="text-white bg-danger p-2">La password deve contenere almeno 8 caratteri e una lettera maiuscola!</span>';
        return false;
    }
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

    $sql_update = "UPDATE user SET password = ? WHERE id_utente = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $hashed_new_password, $user_id);

    if ($stmt_update->execute()) {
        echo '<span class="text-white bg-success p-2">Password modificata con successo</span>';
    } else {
        echo '<span class="text-white bg-danger p-2">Si è verificato un errore durante il cambio della password.</span>';

    }
} else {
    echo '<span class="text-white bg-danger p-2">Password non corretta!</span>';

}
