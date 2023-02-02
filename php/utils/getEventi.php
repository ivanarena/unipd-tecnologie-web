<?php 
require_once("database.php");

function nonPrenotato($id) {
    $ret = 0;
    if(!empty($_SESSION["Username"])){
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = 'SELECT Count(*) FROM EVENTO_UTENTE WHERE Username=? AND IdEvento =?;';
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($_SESSION["Username"],$id));
        $ret = $stmt->fetchColumn() <= 0;
        database::disconnect();
    }
    return $ret;
}

function abbonato() {
    $ret = 0;
    if(!empty($_SESSION["Username"])){
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = 'SELECT Count(*) FROM ABBONAMENTO_UTENTE WHERE Username=? AND CURDATE()<=DataScadenza;';
        $stmt = $pdo->prepare($query);
        $stmt->execute(array($_SESSION["Username"]));
        $ret = $stmt->fetchColumn() > 0;
        database::disconnect();
    }
    return $ret;
}

function getPosti($idLocale){
    try {
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql_Posti = "SELECT ((SELECT DISTINCT(Capienza)
                    FROM EVENTO E JOIN LOCALE L on E.IdLocale = L.IdLocale
                    WHERE IdEvento = ?)
                    -
                    (SELECT COUNT(username) as NumIscritti
                    FROM EVENTO_UTENTE EU
                    WHERE IdEvento = ?)) as PostiRim;";
        $stmt = $pdo->prepare($sql_Posti); 
        $stmt->execute([$idLocale,$idLocale]);
        $posti = $stmt->fetch();
        database::disconnect();
        return $posti["PostiRim"];
    } catch (PDOException $e) {
        echo 'Errore PDO e connessione DB: <br />';
        echo 'SQLQuery: ', $sql;
        echo 'Errore: ' . $e->getMessage();
    }
    return -1;
}

function nEventiRimanenti(){
    $ret='';
    $numEventiIscrittiUt = 0;
    if (abbonato()) {
        try {
            $pdo = database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $stmt = $pdo->prepare("SELECT COUNT(YEARWEEK(DataIscrizione)) as NumEventiIscritti FROM EVENTO_UTENTE WHERE YEARWEEK(DataIscrizione) = YEARWEEK(NOW()) AND Username = ? GROUP BY YEARWEEK(DataIscrizione)");
            $stmt->execute(array($_SESSION["Username"]));
            $numEventiIscrittiUt = $stmt->fetch()["NumEventiIscritti"] ?? 0;
            $query = "SELECT EventiSettimanali FROM ABBONAMENTO_UTENTE AU JOIN ABBONAMENTO A ON AU.IdAbbonamento = A.IdAbbonamento WHERE Username=? AND CURDATE()<=DataScadenza;";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array($_SESSION["Username"]));
            $eventiLimiteUt = $stmt->fetch()["EventiSettimanali"];
            $eventiRimanenti= $eventiLimiteUt-$numEventiIscrittiUt;
            $ret =  '<span class="events-count">Hai ancora a disposizione '. $eventiRimanenti .' eventi per questa settimana.</span>';
            database::disconnect();
        } catch (PDOException $e) {
            echo 'Errore PDO e connessione DB: <br />';
            echo 'SQLQuery: ', $sql;
            echo 'Errore: ' . $e->getMessage();
        }
    }
    return $ret;
}

function getEventi() {
    $result = '';
    if (isset($_SESSION['Username']) && $_SESSION["admin"] == 1) {
        $result = '<a href="<urlPrefixPlaceholder/>/php/utils/creaEvento.php" role="button" class="btn primary-btn main-btn">Crea evento</a>';
    } 
    try {
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        if (empty($_GET)) {
            $sql = "SELECT L.IdLocale, E.NomeEvento, L.NomeLocale, E.Descrizione AS DescrizioneEvento, E.IdEvento, DATE_FORMAT(DataOraInizio,'%d/%m/%Y - %H:%i ') as stampaInizio, DATE_FORMAT(DataOraFine,'fino al %d/%m/%Y - %H:%i') as stampaFine FROM EVENTO AS E, LOCALE AS L WHERE L.IdLocale=E.IdLocale;";
        } else {
            $sql = "SELECT L.IdLocale, E.NomeEvento, L.NomeLocale, E.Descrizione AS DescrizioneEvento, E.IdEvento, DATE_FORMAT(DataOraInizio,'%d/%m/%Y - %H:%i ') as stampaInizio, DATE_FORMAT(DataOraFine,'fino al %d/%m/%Y - %H:%i') as stampaFine FROM EVENTO AS E, LOCALE AS L WHERE L.IdLocale=E.IdLocale AND E.IdLocale='". $_GET["IdLocale"] ."';";
        }
        $res_sql = $pdo->query($sql);
        foreach ($res_sql->fetchAll() as $evento) {
            $posti = getPosti($evento["IdEvento"]);
            if (isset($_SESSION['Username']) && $_SESSION["admin"] == 1) {
                $result .= strval('<div class="h-card card-shadow events-container">
                <div class="event-card">
                    <div class="event-text">
                        <div class="event-heading">
                            <h1 class="event-title">' . $evento["NomeEvento"] . '</h1>
                            <h2 class="event-place">'. $evento["NomeLocale"] .'</h2>
                            <h3 class="event-timestamp">'.$evento["stampaInizio"].$evento["stampaFine"].'</h3>
                        </div>
                        <p class="event-desc">' . $evento["DescrizioneEvento"] . '</p>
                    </div>
                    <div class="booking-container flex-col-center">
                        <a href="<urlPrefixPlaceholder/>/php/utils/doEliminaEvento.php?IdEvento='. $evento["IdEvento"] .'" role="button" class="btn secondary-btn booking-btn">Elimina Evento</a>
                        <span class="spots-available">Posti rimasti: '.$posti.'</span>
                    </div>
                </div>
                </div>');
            } else if (isset($_SESSION['Username']) && abbonato() && nonPrenotato($evento["IdEvento"])) {
                $result .= strval('<div class="h-card card-shadow events-container">
                <div class="event-card">
                    <div class="event-text">
                        <div class="event-heading">
                            <h1 class="event-title">' . $evento["NomeEvento"] . '</h1>
                            <h2 class="event-place">'. $evento["NomeLocale"] .'</h2>
                            <h3 class="event-timestamp">'.$evento["stampaInizio"].$evento["stampaFine"].'</h3>
                        </div>
                        <p class="event-desc">' . $evento["DescrizioneEvento"] . '</p>
                    </div>
                    <div class="booking-container flex-col-center">
                        <a href="<urlPrefixPlaceholder/>/php/utils/doPrenota.php?IdEvento='. $evento["IdEvento"] .'" role="button" class="btn primary-btn booking-btn" aria-label="Prenota evento '. $evento["NomeEvento"] .'">Prenota</a>
                        <span class="spots-available">Posti rimasti: '.$posti.'</span>
                    </div>
                </div>
                </div>');
            } else {
                $result .= strval('<div class="h-card card-shadow events-container">
                <div class="event-card">
                    <div class="event-text">
                        <div class="event-heading">
                            <h1 class="event-title">' . $evento["NomeEvento"] . '</h1>
                            <h2 class="event-place">'. $evento["NomeLocale"] .'</h2>
                            <h3 class="event-timestamp">'.$evento["stampaInizio"].$evento["stampaFine"].'</h3>
                        </div>
                        <p class="event-desc">' . $evento["DescrizioneEvento"] . '</p>
                    </div>
                    <div class="booking-container flex-col-center">
                        <span class="hide error-msg">Per prenotare un evento devi essere abbonato. Ricorda che puoi prenotarti solo una volta per evento!</span>
                        <button class="btn secondary-btn booking-btn" aria-label="Prenota evento '. $evento["NomeEvento"] .'">Prenota</button>
                        <span class="spots-available">Posti rimasti: '.$posti.'</span>
                    </div>
                </div>
                </div>');
            }

        }
        database::disconnect();
    } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
        }
    return $result;
}


?>