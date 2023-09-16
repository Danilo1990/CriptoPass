<?php
// Inietta la headv
function head($titolo) { 
    include 'template/header.php';
}
function cssHeader() {
    $css = '<link href="/css/style.css" rel="stylesheet">';
    $css .= '<link href="/css/admin.css" rel="stylesheet">';
    $css .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">';
    $css .= '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">';
    $css .= '<link rel="preconnect" href="https://fonts.googleapis.com">';
    $css .= '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    $css .= '<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;700&display=swap" rel="stylesheet">';
    echo $css;
}
// Inietta il footer
function footerCustom() { 
    include 'template/footer.php';
}
// Script JS nel footer
function footerScripts() {
    $script = '';
    $script .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>';
    $script .= '<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>';
    $script .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>';
    $script .= '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';
    $script .= '<script src="js/main.js"></script>';
    $script .= '<script src="js/ajax.js"></script>';
    echo $script;
}
// Menu
function navMenu($class) { 
    include 'template/nav.php';
}
// Topbar Admin
function topMenuAdmin() { 
    include 'template/nav-admin.php';
}
// Menù mobile
function menuMobile() { ?>
    <div class="offcanvas offcanvas-start w-75" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h4 class="offcanvas-title" id="offcanvasExampleLabel">Menu</h4>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <nav id="navbar" class="">
            <ul class="nav nav flex-column">
                <li class="nav-item"><a class="nav-link text-dark px-0 fs-3" href="/" ><i class="bi bi-house"></i> Home</a></li>
                <?php if (isset($_SESSION['utente_loggato']) && $_SESSION['utente_loggato'] === true) { ?>
                    <li class="nav-item"><a class="nav-link  text-dark px-0 fs-3" href="/cripta_decripta" ><i class="bi bi-lock"></i> Cripta e decripta</a></li>                   
                    <li class="nav-item"><a class="nav-link text-dark px-0 fs-3" href="/le-mie-pass"><i class="bi bi-shield-lock"></i> Le password</a></li>
                    <li class="nav-item"><a class="getstarted nav-link text-dark px-0 fs-3 text-uppercase" href="/area-riservata"><i class="bi bi-person"></i>  <?= $_SESSION['username'] ?></a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link text-dark px-0 fs-3" href="/register"><i class="bi bi-pencil-square"></i>Registrati</a></li>
                    <li class="nav-item"><a class="nav-link getstarted text-dark px-0 fs-3" href="/login"><i class="bi bi-box-arrow-in-right"></i> Accedi</a></li>
                <?php } ?>
            </ul>
        </nav>
      </div>
    </div>
<?php }
// Script login
function loginCustom($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                
                $_SESSION["email"] = $row["email"];
                $_SESSION["username"] = $username;
                $_SESSION["user_id"] = $row["id_utente"];
                $_SESSION['utente_loggato'] = true;
                $_SESSION['role'] = $row['role'];
                
                header("Location: area-riservata.php"); // Reindirizza all'area riservata
            } else {
                alertCustom('Password errata! Riprova', 'danger');
            }
        } else {
            alertCustom('Username non trovato', 'danger');
        }
    
    }
    
}
// Script registrazione
function registerCustom($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password)) {
            alertCustom($text = "<i class=\"bi bi-exclamation-triangle fw-lg\"></i> La password deve contenere almeno 8 caratteri e una lettera maiuscola.", $class = "small", $type = 'danger', $align = 'start');
            return false;
        }

        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            alertCustom('Questo username esiste già', 'danger');
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user (email, username, password, role) VALUES ('$email', '$username', '$hashedPassword', 'writer')";
            if ($conn->query($sql) === TRUE) {
                header("Location: login.php?messaggio=Utente registrato con successo!");
            } else {
                echo "Errore durante la registrazione: " . $conn->error;
            }
        }
    }
}
// Alert Custom
function alertCustom($text, $type, $align = 'center') {
    echo '<div class="alert-dismissible shadow text-'.$align.' alert alert-'.$type.'" role="alert">'.$text.'<button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
// Messaggio Errore Custom
function errorMessage($id = 'messaggioErrore', $text = 'Errore') {
    echo '<div id="'.$id.'" style="display: none;" class="errore alert alert-danger" role="alert">'.$text.'</div>';
}


// Sezione amministratore //

// Script per la stampa del form modifica variabili DB
function administratorDB() { 
    include 'config.php';?>
    <div class="card shadow bg-light">
        <div class="card-header bg-info"><h3 class="text-white m-0 p-0">Database connect</h3></div>
        <div class="card-body">
        <form method="post" id="connectDb" action="variable-db.php">
            <label for="exampleFormControlInput1" class="form-label">servername</label>
            <input type="text" name="servername" class="form-control form-control-lg" value="<?php echo $servername; ?>" /><br>
            
            <label for="exampleFormControlInput1" class="form-label">username</label>
            <input type="text" name="username" class="form-control form-control-lg" value="<?php echo $username; ?>" /><br>
            
            <label for="exampleFormControlInput1" class="form-label">password</label>
            <input type="text" name="password" class="form-control form-control-lg" value="<?php echo $password; ?>" /><br>
            
            <label for="exampleFormControlInput1" class="form-label">dbname</label>
            <input type="text" name="dbname" class="form-control form-control-lg" value="<?php echo $dbname; ?>" /><br>
            <button type="submit" class="btn btn-lg btn-danger d-block w-100" id="connect">Modifica</button>
        </form>
        </div>
    </div>
<?php }
// Script per la stampa degli utenti
function administratorUserList($conn) { 
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql); ?>
    <div class="card shadow bg-light">
        <div class="card-header bg-primary ">
            <h2 class="card-title text-white mb-1">Utenti</h2>
        </div>
        <div class="card-body">
            <ul class="list-group"> 
                <?php 
                while ($row = $result->fetch_assoc()) :
                    echo '<li class="list-group-item w-100 py-4">';
                        echo '<div class="row  align-items-center h-100">';
                            echo '<div class="col-xl-10">';
                                echo '<h4>'.$row["username"].'</h4>';
                                echo '<p class="mb-0"><b>Ruolo:</b> '.$row["role"].'</p>';
                            echo '</div>';
                            echo '<div class="col-xl-2 text-center">';
                                echo '<button class=" btn btn-danger btn-sm deleteUser" data-id="'.$row["id_utente"].'"><i class="bi bi-x-octagon"></i> Elimina</button>';
                            echo '</div>';
                        echo '</div>';
                    echo '</li>';
                endwhile; 
                ?>
            </ul>
        </div>
    </div>
<?php }
// Script per la stampa del numero degli utenti
function administratorUser($conn) { 
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
    $num_rows = mysqli_num_rows($result);
    ?>
    <div class="card shadow bg-light">
        <div class="card-header bg-primary ">
        <h3 class="card-title text-white mb-1 text-center">Sono registrati</h3>
        </div>
        <div class="card-body">
        <h1 class="display-4 font-weight-bold text-primary text-center"><?= $num_rows ?></h1>
        <h5 class="text-primary text-center ">Utenti</h5>
        </div>
    </div>
<?php }
// Script per la stampa del numero di capitoli inseriti
function administratorPassUpload($conn) { 
    $passUpload = "SELECT password_admin FROM password";
    $resultPassUpload = $conn->query($passUpload); ?>
    <div class="card shadow bg-light">
        <div class="card-header bg-danger ">
            <h3 class="card-title text-white mb-1 text-center">Sono state caricate</h3>
        </div>
        <div class="card-body">
            <h1 class="display-4 font-weight-bold text-danger text-center"><?= mysqli_num_rows($resultPassUpload) ?></h1>
            <h5 class="text-danger text-center ">Password</h5>
        </div>
    </div>
<?php }
function adminPages() {
    $directory = "./";
    $files = scandir($directory);
    $files = array_diff($files, array(".", "..")); ?>
    <div class="card shadow bg-light mb-3">
        <div class="card-header bg-success"><h3 class="text-white m-0 p-0">Crea nuova pagina</h3></div>
        <div class="card-body">
            <form method="post" id="createPage">
                <input type="text" name="titolo" placeholder="Titolo pagina" class="form-control form-control-lg mb-2" required>
                <button type="button" class="btn btn-warning btn-lg d-block w-100" id="titlePage"><i class="bi bi-lock"></i> Pubblica</button>
            </form>
        </div>
    </div>
    <div class="card shadow bg-light">
        <div class="card-header bg-primary ">
            <h2 class="card-title text-white mb-1">Pagine</h2>
        </div>
        <div class="card-body">
            <ul class="list-group">
            <?php foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $name = str_replace('.php', '', $file);
                    $namePage = str_replace("-", " ", $name); ?>
                    <li class="list-group-item w-100">
                        <span class="color-dark text-uppercase fw-bold"><?= $namePage ?></span>
                        <button class="float-end btn btn-danger btn-sm deletePage rounded-pill" data-id="<?= $file ?>">Elimina</button>
                        <a href="/<?= $name ?>" class="float-end btn btn-success btn-sm mx-1 rounded-pill">Visualizza</a>
                    </li>
                <?php }
            } ?>
            </ul>
        </div>
    </div>
<?php }
function copyPage() {     
    $directory = "./";
    $files = scandir($directory);
    $files = array_diff($files, array(".", "..")); 
    ?>
    <div class="card shadow bg-light mb-3">
        <div class="card-header bg-success"><h3 class="text-white m-0 p-0">Contenuto pagina</h3></div>
        <div class="card-body">
            <form method="post" id="copyPage">
                <select id="pageName" name="pageName" class="form-select form-select-lg mb-3">
                    <option disabled selected>Scegli la pagina</option>
                    <?php foreach($files as $file) {
                        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                        $name = str_replace('.php', '', $file);
                        $namePage = str_replace("-", " ", $name);
                        echo'<option value="'.$file.'">'.$namePage .'</option>';
                        }
                    }
                    ?>
                </select>
                <input type="text" name="titoloPagina" placeholder="Titolo pagina" class="form-control form-control-lg mb-2">
                <textarea type="text" name="contenutoPagina" placeholder="Contenuto pagina" rows="20" class="form-control form-control-lg mb-2"></textarea>
                <button type="button" class="btn btn-warning btn-lg d-block w-100" id="insertCopy"><i class="bi bi-lock"></i> Pubblica</button>
            </form>
        </div>
    </div>
<?php }
function insertCopy($conn, $requested_url ) {

    $sql = "SELECT * FROM page WHERE page = '$requested_url'"; // Modifica la query in base alla tua struttura URL

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Mostra i dati recuperati
        while ($row = $result->fetch_assoc()) {
            $titolo = $row["titolo"];
            $contenuto = $row["contenuto"];
            echo $titolo;
            echo $contenuto;
        }
    } else {
        echo "Nessun risultato trovato";
    }
}