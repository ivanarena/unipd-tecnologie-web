<?php
require_once("../session.php");
if (isset($_SESSION["Username"])){
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dataScadenza = date('Y-m-d', strtotime($dataInizio. ' + 90 days'));
        /**Non puoi prendere direttamente i valori così, serve una prepared statement per evitare sql injection, vedi la funzione getPosti in getEventi.php*/
        $sql = 'INSERT INTO EVENTO_UTENTE VALUES("'. $_SESSION["Username"] .'", "'. $_GET["IdEvento"] .'",  "'. date("Y-m-d") .'");';
        $query = $pdo->prepare($sql);
        $query->execute();
        database::disconnect();
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
}
header('location: donePrenota.php');

?>