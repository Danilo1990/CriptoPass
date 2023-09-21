<?php
session_start();
include 'inc/control-login.php';
include 'inc/functions.php';
include 'inc/configura-db.php';
$requested_url = $_SERVER['SCRIPT_NAME'];
$requested_url = str_replace('/', '', $requested_url);
head('Le mie pass'); 

$idUtente = $_SESSION["user_id"]; 
$sql = "SELECT id_pass, sito, username, password_admin FROM password WHERE id_utente = $idUtente";
$result = $conn->query($sql);
$num_rows = $result->num_rows;
$count = 0;
?>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
  <div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
          <div class="mb-3"><?php insertCopy($conn, $requested_url ) ?></div>
          <div class="shadow p-4">
            <?php if($num_rows == 0) {
                echo '<h2>Nessuna password salvata!</h2>';
            } else { ?>
              <div class="input-group mb-3 input-group-lg">
                <input type="text" name="cerca" id="cerca" class="form-control" placeholder="Cerca...">
                <button type="button" class="input-group-text" id="btnCerca">Cerca</button>
                <button type="button" class="bg-danger text-white input-group-text hide reset" id="reset">Reset</button>
              </div>
            
            <div class="table-responsive">
            <table class="table table-hover align-middle table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Sito</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th class="change hide" scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
                <tbody>
                  <?php while ($row = $result->fetch_assoc()) : $count++;
                  $sito = $row['sito'];
                  $username =$row["username"];
                  ?>
                      <tr>
                        <th scope="row"><?= $count ?></th>
                        <th id="site-<?=  $row["id_pass"] ?>"><?= $sito ?></th>
                        <td id="user-<?=  $row["id_pass"] ?>"><?= $username?></td>
                        <td id="pass-<?=  $row["id_pass"] ?>" class=""><?= $row["password_admin"] ?></td>
                        <td class="text-center change hide">
                          <button type="button" class="btn btn-sm btn-warning w-100 hide" id="btnChange-<?=  $row["id_pass"] ?>">
                            <i class="bi bi-send-fill"></i>
                          </button>
                        </td>
                        <td class="text-center">
                          <button type="button" class="changeTab btn btn-sm btn-info w-100" id="<?=  $row["id_pass"] ?>">
                          <i class="text-white bi bi-pencil"></i>
                          </button>
                        </td>
                        <td>
                          <button type="button" class="decript btn btn-sm btn-primary w-100" id="<?=  $row["id_pass"] ?>">
                            <i class="bi bi-unlock"></i>
                          </button>
                          <button type="button" class=" hide btn btn-sm btn-success w-100" id="reset-<?=  $row["id_pass"] ?>">
                            <i class="bi bi-lock"></i>
                          </button>
                        </td>
                        <td class="text-center"><button type="button" class="deletePass btn btn-sm btn-danger w-100" id="<?=  $row["id_pass"] ?>"><i class="bi bi-x-lg"></i> <span class="none"></span></button></td>
                      </tr>
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
