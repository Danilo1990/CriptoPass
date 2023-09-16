<?php
session_start();
include 'scripts/control-login.php';
include 'scripts/functions.php';
include 'scripts/configura-db.php';
$requested_url = $_SERVER['SCRIPT_NAME'];
$requested_url = str_replace('/', '', $requested_url);
head('Le mie pass'); 

$idUtente = $_SESSION["user_id"]; 
$sql = "SELECT id_pass, username, password_admin FROM password WHERE id_utente = $idUtente";
$result = $conn->query($sql);
$num_rows = $result->num_rows;
$count = 0;
?>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
  <div class="container">
    <div class="row">
        <div class="col-lg-12">
          <div class="mb-3"><?php insertCopy($conn, $requested_url ) ?></div>
          <div class="shadow p-4">
            <?php if($num_rows == 0) {
                echo '<h2>Nessuna password salvata!</h2>';
            } else { ?>
            <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()) : $count++;
                  $username = base64_decode($row["username"]);
                  $keyUser = 'bhf&7/aaohd7((67lhfoi£$76'.$idUtente;
                  $algo = "AES-128-ECB";
                  $decryptedUsername = openssl_decrypt($username, $algo, $keyUser, OPENSSL_RAW_DATA);
                  ?>
                      <tr>
                        <th scope="row"><?= $count ?></th>
                        <td><?= $decryptedUsername?></td>
                        <td id="id-<?= $count ?>" class=""><?= $row["password_admin"] ?></td>
                        <td>
                          <button type="button" class="decript btn btn-sm btn-primary w-100" id="<?= $count ?>"><i class="bi bi-unlock"></i></button>
                          <button type="button" class="reset hide btn btn-sm btn-success w-100" id="reset-<?= $count ?>"><i class="bi bi-lock"></i></button>
                        </td>
                        <td class="text-center"><button type="button" class="deletePass btn btn-sm btn-danger w-100" id="<?=  $row["id_pass"] ?>"><i class="bi bi-x-lg"></i> <span class="none"></span></button></td>
                      <tr>
                  <?php endwhile; ?>
                </tbody>
            </table>
            </div>
          <?php } ?>
          </div>
        </div>
    </div>
  </div>
</div>
<?php footerCustom();
