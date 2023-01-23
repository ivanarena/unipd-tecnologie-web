<?php
require_once("../session.php");
if (isset($_SESSION["Username"])){
    if (!empty($_POST)) {
        try {
            include_once('./database.php');
            $pdo = database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $numeroCarta = $_POST["numero-carta"];
            $dataInizio = date("Y-m-d");
            $dataScadenza = date('Y-m-d', strtotime($dataInizio. ' + 90 days'));
            $sql = 'INSERT INTO CARTA VALUES("'.$numeroCarta.'", "VISA", "'.$_POST["ccv"].'", "'.$_POST["scadenza"].'", "'.$_POST["intestatario"].'")';
            $query = $pdo->prepare($sql);
            $query->execute();
            $sql = 'INSERT INTO ABBONAMENTO_UTENTE VALUES(NULL, "'. $_GET["IdAbb"] .'", "'. $_SESSION["Username"] .'", "'. $numeroCarta .'", "'. $dataInizio .'", "'. $dataScadenza .'");';
            $query = $pdo->prepare($sql);
            $query->execute();
            database::disconnect();
        } catch (PDOException $e) {
            echo 'Errore PDO e connessione DB: <br />';
            echo 'SQLQuery: ', $sql;
            echo 'Errore: ' . $e->getMessage();
        
        }
    }
}
header('location: doneAcquista.php');

?>