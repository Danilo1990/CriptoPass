<?php
session_start();
include 'inc/functions.php';
include 'inc/configura-db.php';
$requested_url = $_SERVER['SCRIPT_NAME'];
$requested_url = str_replace('/', '', $requested_url);
head($titolo = 'Home'); 

?>


<div class="gradient-banner">
  <div class="container position-relative">
    <div class="row align-items-center">
      <div class="col-md-6 text-start">
        <h1 class="text-dark  mb-4">Gestisci e proteggi le tue</br> password in modo sicuro</h1>
        <p class="text-dark mb-5">Benvenuto su CriptoPass, la tua soluzione completa per la gestione delle password e la 
          sicurezza online. Con CriptoPass, puoi criptare e decodificare le tue password con facilità, garantendo la 
          massima protezione per i tuoi dati sensibili.</p>
          <a href="/cripta_decripta" class="btn btn-primary btn-lg">Inizia ora <i class="ms-2 bi bi-shield-check"></i></a>
      </div>
      <div class="col-md-6 text-center">
        <img class="img-fluid" src="./img/slide.png" alt="screenshot">
      </div>
    </div>
  </div>
</div>
<?php footerCustom();