<?php 
include 'configura-db.php';

// Ricevi l'email inviata dal form
$email = $_POST["email"];

// Verifica se l'email esiste nel database
$sql = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $token = bin2hex(random_bytes(32));
    $expiration_time = date("Y-m-d H:i:s", strtotime("+1 hour"));
    $sql = "INSERT INTO password_reset (email, token, expiration_time) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $token, $expiration_time);
    $stmt->execute();
    $siteUrl = "http://$_SERVER[HTTP_HOST]";

    // Invia un'email all'utente con il link per il ripristino della password
    $reset_link = $siteUrl."/reset-password.php?token=" . $token;
    $subject = "Recupero password";
    $message = "Per ripristinare la tua password, fai clic sul seguente link: $reset_link";
    $headers = "From: no-reply@tuo-sito.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Inserisci l'evento nella tabella di registrazione degli eventi
    $sql = "INSERT INTO email_log (recipient_email, subject, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $subject, $message);
    $stmt->execute();
    $stmt->close();
    mail($email, $subject, $message, $headers);
    header("Location: ../login.php?deleteAccount=È stata inviata l'email per il recupero password");
} else {
    header("Location: ../login.php?deleteAccount=EMAIL NON TROVATA");
}

$conn->close();