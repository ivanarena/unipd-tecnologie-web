<?php
require_once("session.php");
session_destroy();
unset($_SESSION['utente']);
header('location: ./index.php');
