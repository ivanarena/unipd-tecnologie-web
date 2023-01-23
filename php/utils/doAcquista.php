<?php
require_once("../session.php");
require_once("./getAbbonamenti.php");
if (isset($_SESSION["Username"])&& noAbbonamenti()){
    $pagamentoEffettuato = false;
    if (!empty($_POST) && isset($_GET["IdAbb"])&& isset($_GET["nomeAbb"])) {
        $cartaError = null;
        $ccvError = null;
        $intestatarioError = null;
        $dataError = null;
        $idAbbError = null;
        $dataCheck = false;
        $valid = true;
        if(array_key_exists("IdAbb", $_REQUEST) && !empty($_GET["IdAbb"])){
            if($_GET["IdAbb"]==1 || $_GET["IdAbb"]==2 || $_GET["IdAbb"]==3){
                $idAbb = $_GET["IdAbb"];
            } else{
                $valid = false;
        }
        }else{
            $valid = false;
        }
        if (array_key_exists("numero-carta", $_REQUEST) && !empty($_REQUEST["numero-carta"]) && strlen($_REQUEST["numero-carta"]) <= 19) {
            $carta = $_POST['numero-carta'];
        } else {
            $usernameError = 'Inserire una carta :';
            $valid = false;
        }
        if (array_key_exists("ccv", $_REQUEST) && !empty($_REQUEST["ccv"]) && strlen($_REQUEST["ccv"]) == 3) {
            $ccv = $_POST['ccv'];
        } else {
            $ccvError = 'Inserire il ccv :';
            $valid = false;
        }
        if (array_key_exists("intestatario", $_REQUEST) && !empty($_REQUEST["intestatario"]) && strlen($_REQUEST["intestatario"]) <=100) {
            $intestatario = $_POST['intestatario'];
        } else {
            $intestatarioError = 'Inserire un intestatario :';
            $valid = false;
        }
        if (array_key_exists("scadenza", $_REQUEST) && !empty($_REQUEST["scadenza"])) {
            $data = $_POST['scadenza'];
            $tdata=date_parse($data);
            if (checkdate($tdata['month'], $tdata['day'], $tdata['year'])) {
                $date1=date_create($tdata['year'].'-'.$tdata['month'].'-'.$tdata['day']);
                $date2=date_create(date("Y-m-d"));
                if($date1>=$date2){
                    $dataCheck = true;
                }
            }
        } else {
            $dataError = 'Inserire una data valida :';
            $valid = false;
        };
        if ($valid && $dataCheck) {            
            try {
                include_once('database.php');
                $pdo = database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $username = $_SESSION["Username"];
                $dataInizio = date("Y-m-d");
                $dataScadenza = date('Y-m-d', strtotime($dataInizio. ' + 90 days'));
                $stmt = $pdo->prepare("SELECT Count(*) FROM CARTA WHERE NumeroCarta=?;");
                $stmt->execute(array($carta));
                if ($stmt->fetchColumn() <= 0) {
                    $sql = "INSERT INTO CARTA(NumeroCarta,Circuito,CCV,DataScadenza,Intestatario) VALUES(?,?,?,?,?);";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($carta,"Mastercard",$ccv,$data,$intestatario));
                }
                $sql = "INSERT INTO ABBONAMENTO_UTENTE(IdAbbonamento,Username,NumeroCarta,DataPagamento,DataScadenza) VALUES(?,?,?,?,?);";
                $q = $pdo->prepare($sql);
                $q->execute(array($idAbb,$username,$carta,$dataInizio,$dataScadenza));
                $pagamentoEffettuato = true;
                database::disconnect();
            } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
            }
            if($pagamentoEffettuato){
                header('location: doneAcquista.php');
                die();
            }
        }
        if($pagamentoEffettuato == false){
            header('location: ../acquista.php?IdAbb='.$_GET["IdAbb"].'&nomeAbb='.$_GET["nomeAbb"].'&errGen=1');
            die();
        }
    }
}else{
    header('location: ./error403.php');
    die();
}

?>