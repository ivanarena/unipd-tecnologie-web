<?php
require_once("../session.php");

if (isset($_SESSION["Username"])){
    try {
        include_once('./database.php');
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT Count(*) FROM EVENTO_UTENTE WHERE Username = ? AND IdEvento = ?;");
        $stmt->execute(array($_SESSION["Username"],$_GET["IdEvento"]));
        if ($stmt->fetchColumn() > 0) {
            $sql = "DELETE FROM EVENTO_UTENTE WHERE Username = ? AND IdEvento = ?;";
            $query = $pdo->prepare($sql);
            $query->execute($_SESSION["Username"],$_GET["IdEvento"]);
        }
        database::disconnect();
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
}

header('location: ../prenotazioni.php');

?>