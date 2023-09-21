<?php 
session_start();
include 'functions.php';
include 'configura-db.php';

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password)) {
    echo 'passLeght';    
    return false;
}

$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo 'userOnDB';
} else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$username', '$hashedPassword', 'writer')";
    if ($conn->query($sql) === TRUE) {
        echo 'ok';
    } else {
        echo "error";
    }
}