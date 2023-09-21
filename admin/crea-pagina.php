<?php

$paginaContenuto = '<?php
session_start();
include "inc/functions.php";
include "inc/configura-db.php";
head($titolo = "Home");
?>

<?php footerCustom(); ?>';

// Scrivi il contenuto nella nuova pagina
$nomePagina = $_POST['title'];
$nomePagina = $_SERVER['DOCUMENT_ROOT'] . '/'.$nomePagina.'.php';

if (file_put_contents($nomePagina, $paginaContenuto)) {
    echo "La nuova pagina è stata creata con successo.";
} else {
    echo "Si è verificato un errore durante la creazione della pagina.";
}
