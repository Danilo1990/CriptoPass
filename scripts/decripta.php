<?php 
$encryptedPassword = base64_decode($_POST["password"]);
$key = $_POST["key"];
$algo = "AES-128-ECB";

$decryptedPassword = openssl_decrypt($encryptedPassword, $algo, $key, OPENSSL_RAW_DATA);
if($decryptedPassword == NULL) {
    echo '<h5 class="text-danger">Password o Key errata!</h5>';
} else {
    echo '<h5><b>'.$decryptedPassword.'</b></h5>';
}