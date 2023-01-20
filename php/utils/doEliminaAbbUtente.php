<?php
require_once("../session.php");

function eliminaPrenotazioni() {
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM EVENTO_UTENTE WHERE Username = '". $_SESSION["Username"] ."';";
        $query = $pdo->prepare($sql);
        $query->execute();
        database::disconnect();
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
}


if (isset($_SESSION["Username"])){
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM ABBONAMENTO_UTENTE WHERE IdAbbUtente = '". $_GET["IdAbb"] ."';";
        $query = $pdo->prepare($sql);
        $query->execute();
        eliminaPrenotazioni();
        database::disconnect();
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
}
header('location: ../profilo.php');

?>