<?php
// Pagina per inserimento, modifica e cancellazione capitoli
session_start();
include 'scripts/control-login.php';
include 'scripts/functions.php';
include 'scripts/configura-db.php';
head($titolo = 'Cripta e decripta'); 
?>
<div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mb-2">
                <div class="card shadow bg-light">
                    <div class="card-header bg-success"><h3 class="text-white m-0 p-0">Cripta</h3></div>
                    <div class="card-body">
                        <form method="post" id="cripta-form">
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input " type="checkbox" role="switch" id="SwitchCheckUser">
                                <label class="form-check-label" for="SwitchCheckUser">Salvare sul tuo profilo?</label>
                            </div>
                            <input type="text" name="username" id="username" placeholder="Admin" class="hide form-control form-control-lg mb-2" required>
                            <input type="text" name="password" placeholder="Password" class="form-control form-control-lg mb-2" required>
                            <span class="hide text-danger fw-bold mb-3" id="error"></span>
                            <input type="password" name="key" placeholder="Key" class="form-control form-control-lg mb-2" required>
                            <button type="button" class="btn btn-warning btn-lg d-block w-100" id="cripta"><i class="bi bi-lock"></i> Cripta</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="criptoPass" class="card hide shadow my-3">
            <div class="card-header bg-success"><h3 class="text-white m-0 p-0">La tua password</h3></div>
            <div class="card-body py-3 position-relative">
            <div id="messaggio"></div>
                <button type="button" class="btn-close btn-lg close float-end fs-5" aria-label="Close" style="position: absolute;top: 10px;right: 10px;"></button>            
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mt-2">
                <div class="card shadow bg-light">
                    <div class="card-header bg-danger"><h3 class="text-white m-0 p-0">Decripta</h3></div>
                    <div class="card-body">
                        <form method="post" id="decripta-form">
                            <input type="text" name="encryptedPassword" placeholder="Password" class="form-control form-control-lg mb-2" required>
                            <input type="password" name="keyEncryp" placeholder="Key" class="form-control form-control-lg mb-2" required>
                            <button type="button" class="btn btn-primary btn-lg d-block w-100" id="decripta"><i class="bi bi-unlock"></i> Decripta</button>
                        </form>
                    </div>
                    </div>
                </div>
                <div id="criptoPass" class=" hide alert-dismissible shadow text-center alert alert-danger'" role="alert">
                    <span id="messaggio"></span>
                    <button type="button" class="btn-close close" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
</div>


<?php footerCustom() ?>


