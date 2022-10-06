<?php
// On appelle la session
session_start();
// On écrase le tableau de session
$_SESSION = array();
// On détruit la session
session_destroy();
unset($_SESSION);
unset($_COOKIE);
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Location:authentification.php');
exit;
?>