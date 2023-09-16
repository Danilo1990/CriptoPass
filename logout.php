<?php
// Gestisce il logout utente
session_start();
session_destroy();
header("Location: /");
exit();
?>
