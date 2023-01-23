<?php
require_once("../session.php");
if (isset($_SESSION["Username"])&& isset($_SESSION["admin"])){
    if($_SESSION["admin"]==1){
        try {
            include_once('./database.php');
            $pdo = database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("SELECT Count(*) FROM EVENTO WHERE IdEvento = ?;");
            $stmt->execute(array($_GET["IdEvento"]));
            if ($stmt->fetchColumn() > 0) {
                $sql = "DELETE FROM EVENTO WHERE IdEvento = ?;";
                $query = $pdo->prepare($sql);
                $query->execute(array($_GET["IdEvento"]));
            }
            database::disconnect();
        } catch (PDOException $e) {
            echo 'Errore PDO e connessione DB: <br />';
            echo 'SQLQuery: ', $sql;
            echo 'Errore: ' . $e->getMessage();
        }
    }
}
header('location: ../eventi.php');

?>