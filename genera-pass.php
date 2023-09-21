<?php
session_start();
include "inc/functions.php";
include "inc/configura-db.php";
head($titolo = "Home");
?>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
<div class="container py-5">
    <div class="card shadow">
    <div class="card-header bg-success text-white p-3"><h3 class="m-0">Genera la tua password</h3></div>
    <div class="card-body">
        <div class="bg-light p-3  text-dark fs-4 text-center">
            <span id="pass">La tua password</span> 
            <i id="copy" class="hide bi bi-clipboard-check fs-3 ms-3"></i>
        </div>
        <label for="customRange1" class="form-label mt-3">Lunghezza: <span id="lunghezza"><b>13</b></span></label>
        <div class="d-flex range">
            <span>5</span>
            <input type="range" class="form-range px-2" min="5" max="20"  id="lengthPass"> 
            <span>20</span>
        </div>
        <div class="settings shadow p-3">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="uppercasePass">
                <label class="form-check-label" for="uppercasePass">Includi lettere maiuscole</label>
            </div>   
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="numberPass">
                <label class="form-check-label" for="numberPass">Includi numeri</label>
            </div>  
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="symbolsPass">
                <label class="form-check-label" for="symbolsPass">Includi simboli</label>
            </div> 
        </div> 
        <button id="generate" type="button" class="btn btn-primary d-block w-100 mt-2 btn-lg">Genera</button>
    </div>
    </div>
</div>
</div>


<?php footerCustom(); ?>