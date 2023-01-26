<?php
require_once("../session.php");
if (isset($_SESSION["Username"])&& isset($_SESSION["admin"])){
    if($_SESSION["admin"]==1){
        try {
            include_once('./database.php');
            $pdo = database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dataOraInizio = new DateTime();
            $dataOraFine = new DateTime();
            $dataOraInizio = $dataOraInizio->createFromFormat('Y-m-d*H:i', $_POST['data-inizio-evento']);
            $dataOraFine = $dataOraInizio->createFromFormat('Y-m-d*H:i', $_POST['data-fine-evento']);
            $dataOraInizio = $dataOraInizio->format('Y-m-d H:i:s');
            $dataOraFine = $dataOraFine->format('Y-m-d H:i:s');
            $sql = 'INSERT INTO EVENTO (NomeEvento, Descrizione, IdLocale, DataOraInizio, DataOraFine) VALUES(?, ?, ?, ?, ?);';
            $query = $pdo->prepare($sql);
            $query->execute(array($_POST["nome-evento"], $_POST["descrizione"], $_POST["locale"], $dataOraInizio, $dataOraFine));
            database::disconnect();
            header('location: ../eventi.php');
        } 
        catch (PDOException $e) {
            echo 'Errore PDO e connessione DB: <br />';
            echo 'SQLQuery: ', $sql;
            echo 'Errore: ' . $e->getMessage();
        }
    }
}else{
    header('location: ./error403.php');
    die();
}
?>

