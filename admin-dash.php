<?php
session_start();
if($_SESSION['role'] === 'administrator') {
    include 'inc/control-login.php';
    include 'inc/functions.php';
    include 'inc/configura-db.php';
    head('Dashboard'); 
    ?>
      <div class="main">
        <div class="navbar-side">
          <h6>
            <span class="link-text small">Pannello di controllo</span>
          </h6>
          <ul>
            <li>
              <a href="/" class="link" title="sito">
                <span class="link-text">Visita il sito</span>
              </a>
            </li>
            <li>
              <a href="#" class="link link-active" data-panel="panel" title="Dashboard" id="dati">
                <span class="link-text">Dashboard</span>
              </a>
            </li>
            <li>
              <a href="#" class="link" data-panel="panel" title="user" id="user">
                <span class="link-text">Utenti</span>
              </a>
            </li>
            <li>
              <a href="#" class="link" data-panel="panel" title="pages" id="pages">
                <span class="link-text">Pagine</span>
              </a>
            </li>
            <li>
              <a href="#" class="link" data-panel="panel" title="copy" id="copy">
                <span class="link-text">Copy pagina</span>
              </a>
            </li>
            <li>
              <a href="/area-riservata" title="Profile">
                <span class="link-text">Profile</span>
              </a>
            </li>
            <li>
              <a href="/logout.php" title="Sign Out">
                <span class="link-text">Sign Out</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="content">
          <nav class="navbar navbar-dark bg-dark py-1">
            <a href="#" id="navBtn">
              <span id="changeIcon" class="fa fa-bars text-light"></span>
            </a>
            <div class="d-flex">
              <a class="nav-link text-light px-2" href="#"><i class="fas fa-search"></i></a>
              <a class="nav-link text-light px-2" href="#"><i class="fas fa-bell"></i></a>
              <a class="nav-link text-light px-2" href="#"><i class="fas fa-sign-out-alt"></i></a>
            </div>
          </nav>
          <div class="container-fluid p-4">
            <div class="row justify-content-center align-items-center mb-3 panel-tab active" id="dati-panel">
              <div class="col-lg-6 col-md-6 p-2">
                <?php administratorUser($conn) ?>
              </div>
              <div class="col-lg-6 p-2">
                <?php administratorPassUpload($conn) ?>
              </div>
            </div>
            <div class="row panel-tab" id="user-panel">
              <div class="col-lg-12">
                <?php administratorUserList($conn) ?>
              </div>
            </div>
            <div class="row panel-tab" id="pages-panel">
              <div class="col-lg-12">
                <?php  adminPages() ?>
              </div>
            </div>
            <div class="row panel-tab" id="copy-panel">
              <div class="col-lg-12">
                <?php  copyPage() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php footerCustom();    
} else { 
    header("Location: area-riservata.php"); // Reindirizza all'area riservata
}

