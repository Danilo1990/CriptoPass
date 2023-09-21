<?php
include 'inc/functions.php';
include 'inc/configura-db.php';
head('Registrati'); 

$token = $_GET['token'];
$sql = "SELECT * FROM password_reset WHERE token = '$token'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$tokenDB = isset($row["token"]);

if($token != $tokenDB) {
        echo '<div class="container py-5">';
            echo '<div class="text-center shadow alert alert-danger" role="alert">';
                echo '<h2>Il link è errato o scaduto</h2>';
                echo '<a href="/login.php" class="btn btn-outline-primary mt-2">Torna al login</a>';
            echo '</div>';
        echo '</div>';
        return;
}

$email = $row["email"];
$sqlUser = "SELECT id_utente FROM user WHERE email = '$email'";
$resultUser = $conn->query($sqlUser);
$rowUser = $resultUser->fetch_assoc();
$idUtente = $rowUser["id_utente"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id_new = $_POST["id_new"];
    $newpassword = $_POST["newpassword"];

    $hashed_new_password = password_hash($newpassword, PASSWORD_DEFAULT);

    $sql_update = "UPDATE user SET password = ? WHERE id_utente = ?";

    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $hashed_new_password, $id_new);

    if ($stmt_update->execute()) {
        header("Location: login.php?messaggio=Password modificata con successo!");
    } else {
        echo "Si è verificato un errore durante il cambio della password.";
    }
}

?>
<section class="vh-100" style="background-color: #f2f2f2;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="assets/img/login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-4 text-black">
                                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fs-2 me-3 bi bi-box-arrow-in-right" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Nuova password</span>
                                    </div>
                                    <div class="form-outline mb-3">
                                        <input type="hidden" name="id_new" value="<?= $idUtente ?>" />
                                        <input type="password" name="newpassword" class="form-control form-control-lg" placeholder="Nuova Password" />
                                    </div>
                                    <div class="pt-1 mb-">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block w-100">Cambia password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>