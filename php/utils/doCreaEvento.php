<?php
require_once("../session.php");
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO EVENTO VALUES(NULL, "'. $_POST["nome-evento"] .'", "'. $_POST["descrizione"] .'", "'. $_POST["locale"] .'", "2023-01-05 17:00:00", "2023-01-05 20:30:00");';
        $query = $pdo->prepare($sql);
        $query->execute();
        database::disconnect();
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
header('location: ../eventi.php');

?>

