<?php 
session_start();
include 'functions.php';
include 'configura-db.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        
        $_SESSION["email"] = $row["email"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["user_id"] = $row["id_utente"];
        $_SESSION['utente_loggato'] = true;
        $_SESSION['role'] = $row['role'];

        echo 'ok';
        
    } else {
        echo 'errorPass';
    }
} else {
    echo 'errorUser';
}