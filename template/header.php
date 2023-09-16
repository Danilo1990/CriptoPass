<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $titolo ?></title>
  <meta name="description" content="La tua descrizione personalizzata qui. Questa è una breve descrizione del tuo sito web." />
  <meta content="none" name="keywords">
  <?php cssHeader() ?>
</head>
<?php
$nomePagina = basename($_SERVER['PHP_SELF']);
$nomePagina = basename($_SERVER['PHP_SELF']);
$nameclass = str_replace('.php', '', $nomePagina);
?>
<body class="page-<?= $nameclass; ?>">
  <?php if($nomePagina != 'login.php' && $nomePagina != 'register.php' && $nomePagina != 'admin-dash.php') : 
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'administrator' && $nomePagina != 'admin-dash.php') {
      topMenuAdmin();
    }
    navMenu($class = '');
  endif; 