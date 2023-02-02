<?php
require_once("../session.php");
require_once("./getAbbonamenti.php");
require_once("./getEventi.php");
if (isset($_SESSION["Username"])&& !noAbbonamenti()){
    $prenotaEffettuato = false;
    $prenotaError=null;
    if (array_key_exists("IdEvento", $_REQUEST) && isset($_GET["IdEvento"])&& !empty($_GET["IdEvento"])) {          
        try {
            include_once('database.php');
            $pdo = database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $pdo->prepare("SELECT Count(*) FROM EVENTO WHERE IdEvento=?;");
            $stmt->execute(array($_GET["IdEvento"]));
            if ($stmt->fetchColumn() > 0) {
                if(getPosti($_GET["IdEvento"])>0){
                    $stmt = $pdo->prepare("SELECT Count(*) FROM EVENTO_UTENTE WHERE Username=? AND IdEvento=?;");
                    $stmt->execute(array($_SESSION["Username"],$_GET["IdEvento"]));
                    if ($stmt->fetchColumn() <= 0) {
                        $stmt = $pdo->prepare("SELECT COUNT(YEARWEEK(DataIscrizione)) as NumEventiIscritti FROM EVENTO_UTENTE WHERE YEARWEEK(DataIscrizione) = YEARWEEK(NOW()) AND Username = ? GROUP BY YEARWEEK(DataIscrizione)");
                        $stmt->execute(array($_SESSION["Username"]));
                        $numEventiIscrittiUt = $stmt->fetch()["NumEventiIscritti"] ?? 0;
                        $query = "SELECT EventiSettimanali FROM ABBONAMENTO_UTENTE AU JOIN ABBONAMENTO A ON AU.IdAbbonamento = A.IdAbbonamento WHERE Username=? AND CURDATE()<=DataScadenza;";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute(array($_SESSION["Username"]));
                        $eventiLimiteUt = $stmt->fetch()["EventiSettimanali"];
                        if($numEventiIscrittiUt<$eventiLimiteUt){
                            $sql = "INSERT INTO EVENTO_UTENTE(Username, IdEvento, DataIscrizione) VALUES(?,?,?);";
                            $q = $pdo->prepare($sql);
                            $q->execute(array($_SESSION["Username"],$_GET["IdEvento"],date("Y-m-d")));
                            $prenotaEffettuato = true;
                        }else{
                            $prenotaError = "Limite di eventi prenotabili superato.";
                        }
                    }else{
                        $prenotaError = "Evento già prenotato";
                    }
                }else{
                    $prenotaError = "Impossibile prenotare, capienza al limite.";
                }
            }
            database::disconnect();
        } catch (PDOException $e) {
            echo 'Errore PDO e connessione DB: <br />';
            echo 'SQLQuery: ', $sql;
            echo 'Errore: ' . $e->getMessage();
        }
        if($prenotaEffettuato){
            header('location: ./donePrenota.php');
            die();
        }
    }
    if($prenotaEffettuato == false){
        header_remove();
        header('location: ../eventi.php');
        die();
        if(!empty($prenotaError)){
            header('location: ../eventi.php?err='.$prenotaError);
        }
    }
}else{
    header('location: ../../index.php');
}

?>