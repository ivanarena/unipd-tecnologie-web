<?php
require_once("../session.php");
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM EVENTO WHERE IdEvento = ?;";
        $query = $pdo->prepare($sql);
        $query->execute(array($_GET["IdEvento"]));
        database::disconnect();
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
header('location: ../eventi.php');

?>