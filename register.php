<?php
// Pagina di REGISTRAZIONE

include 'scripts/functions.php';
include 'scripts/configura-db.php';
head('Registrati'); 
?>

<section class="vh-100" style="background-color: #f2f2f2;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="./img/login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-4 text-black">
                                <?php registerCustom($conn); ?>
                                <form method="post" action="">
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <i class="fs-2 me-3 bi bi-pencil-square" style="color: #ff6219;"></i>
                                        <span class="h1 fw-bold mb-0">Registrati</span>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="email" id="form3Example2" class="form-control form-control-lg" name="email" placeholder="Email" required />
                                        <input type="text" id="form3Example3" class="form-control form-control-lg mt-3" name="username" placeholder="Username" required />
                                        <input type="password" id="form3Example4"name="password" class="mt-3 form-control form-control-lg" placeholder="Password" required />
                                    </div>
                                    <div class="mt-4 pt-2">
                                        <button type="submit" class="btn btn-success btn-lg w-100" style="padding-left: 2.5rem; padding-right: 2.5rem;">Registrati</button>
                                        <p class="small fw-bold mt-2 pt-1 mb-0">Hai già un account? <a href="/login.php" class="link-danger">Accedi</a></p>
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