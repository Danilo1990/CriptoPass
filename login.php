<?php
// Pagina di LOGIN
session_start();
include 'inc/functions.php';
include 'inc/configura-db.php';
head('Accedi');
?>

<section class="vh-100" style="background-color: #f2f2f2;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                    <div class="col-md-6 col-lg-5 d-none d-md-block" style="background-image: url(/img/login.jpg);background-size: cover;background-position: center center;"></div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-4 text-black">
                                <?php if (isset($_GET['deleteAccount'])) : ?>
                                    <div class="alert alert-success alert-dismissible w-75" role="alert">
                                        <div><?= $_GET['deleteAccount'] ?></div>
                                        <button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif;
                                if (isset($_GET['messaggio'])) : $messaggio = $_GET['messaggio']; ?>
                                    <div class="card shadow bg-light mb-3">
                                        <div class="card-header bg-success text-center">
                                            <h3 class="text-white m-0 p-0 fs-5"><?= htmlspecialchars($messaggio) ?></h3>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <form class="active" id="loginForm">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fs-2 me-3 bi bi-box-arrow-in-right" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Accedi</span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" />
                                    </div>
                                    <div class="form-outline mb-3">
                                        <div class="d-flex position-relative">
                                            <input type="password" data-id="1" name="password" placeholder="Password" class="showPass form-control form-control-lg mb-2">
                                            <i id="showPass1" class="icon-pass bi bi-eye position-absolute"></i>
                                        </div>
                                    </div>
                                    <div class="pt-1 mb-">
                                        <button type="button" id="login" class="btn btn-dark btn-lg btn-block w-100 mb-2">Accedi</button>
                                        <p class="mt-3 small fw-bold" style="color: #393f81;">Non hai un account? <a href="/register.php" class="link-danger">Registrati</a></p>
                                        <button type="button" id="buttonResetPass" class="small fw-bold border-0 bg-transparent p-0">Ho dimenticato la password?</button>
                                    </div>
                                </form>
                                <form class="hide" method="post" action="inc/recupera-password.php" id="resetPass">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fs-2 me-3 bi bi-box-arrow-in-right" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Recupera Pass</span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="email" class="form-control form-control-lg" name="email" placeholder="email" />
                                    </div>
                                    <div class="pt-1 mb-">
                                        <button type="submit" class="btn btn-dark btn-lg btn-block w-100">Recupera la password</button>
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
<?php footerCustom(); ?>