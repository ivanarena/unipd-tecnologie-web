<?php
require_once("../session.php");
if (isset($_SESSION["Username"])){
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM UTENTE WHERE Username = '". $_SESSION["Username"] ."';";
        $DBUsername = $pdo->prepare($sql);
        $DBUsername->execute(array($username));
        database::disconnect();
        session_destroy();
        unset($_SESSION['Username']);
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
}
header('location: ../../index.php');

?>