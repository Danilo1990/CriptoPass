<?php
session_start();
include 'scripts/functions.php';
include 'scripts/configura-db.php';
$requested_url = $_SERVER['SCRIPT_NAME'];
$requested_url = str_replace('/', '', $requested_url);
head($titolo = 'Home'); 

?>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-7 col-md-6">
        <?php insertCopy($conn, $requested_url ) ?>
        <a href="/cripta_decripta" class="btn btn-primary btn-lg">Inizia subito</a>
      </div>
      <div class="col-12 col-lg-5 col-md-6">
        <img src="./img/slide.png" class="img-fluid w-75" alt="img home">
      </div>
    </div>
  </div>
</div>
<?php footerCustom();