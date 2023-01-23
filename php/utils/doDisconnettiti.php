<?php
require_once("../session.php");
if (isset($_SESSION["Username"])){
    session_destroy();
    unset($_SESSION['Username']);
}
header('location: ../../index.php');
die();
?>