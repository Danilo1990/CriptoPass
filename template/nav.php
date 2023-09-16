<header id="header" class="shadow-sm bg-light py-2 sticky-top">
    <div class="container d-flex align-items-center">
        <a href="/" class="mw-100 logo me-auto"><img src="/img/Logo.png" alt="" class="mw-100 img-fluid"></a>
        <nav id="navbar" class="navbar">
            <ul class="nav <?= $class ?> d-none d-xl-flex">
                <li class="nav-item"><a class="nav-link text-dark" href="/" ><i class="bi bi-house"></i> Home</a></li>
                <?php if (isset($_SESSION['utente_loggato']) && $_SESSION['utente_loggato'] === true) { ?>
                    <li class="nav-item"><a class="nav-link  text-dark" href="/genera-pass" ><i class="bi-list-nested"></i> Genera pass</a></li>                   
                    <li class="nav-item"><a class="nav-link  text-dark" href="/cripta_decripta" ><i class="bi bi-lock"></i> Cripta e decripta</a></li>                   
                    <li class="nav-item"><a class="nav-link text-dark" href="/le-mie-pass"><i class="bi bi-shield-lock"></i> Le password</a></li>
                    <li class="nav-item"><a class="getstarted nav-link text-dark text-uppercase" href="/area-riservata"><i class="bi bi-person"></i>  <?= $_SESSION['username'] ?></a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link text-dark" href="/register"><i class="bi bi-pencil-square"></i>Registrati</a></li>
                    <li class="nav-item"><a class="nav-link getstarted text-dark" href="/login"><i class="bi bi-box-arrow-in-right"></i> Accedi</a></li>
                <?php } ?>
            </ul>
            <button class="p-1 fs-1 btn btn-outline-none d-xl-none d-sm-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <i class="bi bi-list mobile-nav-toggle"></i>
            </button> 
        </nav>
    </div>
</header><!-- End Header -->