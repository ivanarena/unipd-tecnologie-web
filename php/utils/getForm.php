<?php
require_once("../session.php");
if (isset($_SESSION["Username"])){
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO FORM (Nome, Cognome, Email, Msg) VALUES(?, ?, ?, ?);';
        $query = $pdo->prepare($sql);
        $query->execute(array($_POST["Nome"], $_POST["Cognome"], $_POST["Email"], $_POST["Msg"]));
        database::disconnect();
        header('location: ../contatti.php');
    } 
    catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
}


?>