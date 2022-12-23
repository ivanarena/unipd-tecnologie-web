<?php
require_once("../session.php");
if (strtok($_SERVER["REQUEST_URI"], '?') == '/php/utils/doDisconnettiti.php') {
    header("location: ../../index.php");
} else { 
session_destroy();
unset($_SESSION['utente']);
header('location: ../../index.php');
}
?>