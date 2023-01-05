<?php 
require_once("database.php");

function nonPrenotato($id) {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'SELECT Count(*) FROM EVENTO_UTENTE WHERE Username="'. $_SESSION["Username"] .'" AND IdEvento = '. $id .';';
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($prenotazioni));
    $ret = $stmt->fetchColumn() <= 0;
    database::disconnect();
    return $ret;
}

function postiDisponibili($id) {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'SELECT Count(*) FROM EVENTO_UTENTE AS EU, EVENTO AS E, LOCALE AS L WHERE E.IdEvento='. $id .' ;';
    $privilegio = $pdo->query($query)->fetchColumn();
    database::disconnect();
    return $privilegio;
}

function abbonato() {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'SELECT Count(*) FROM ABBONAMENTO_UTENTE WHERE Username="'. $_SESSION["Username"] .'";';
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($username));
    $ret = $stmt->fetchColumn() > 0;
    database::disconnect();
    return $ret;
}

function admin() {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'SELECT Privilegio FROM UTENTE WHERE Username="'. $_SESSION["Username"] .'";';
    $privilegio = $pdo->query($query)->fetchColumn();
    database::disconnect();
    return $privilegio;
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


function getEventi() {
    $result = '';
    if (isset($_SESSION['Username']) && admin() == 1) {
        $result = '<a href="/php/utils/creaEvento.php" role="button" class="btn primary-btn main-btn">Crea evento</a>';
    } 
    try {
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        if (empty($_GET)) {
            $sql = "SELECT L.IdLocale, E.NomeEvento, L.NomeLocale, E.Descrizione AS DescrizioneEvento, E.IdEvento FROM EVENTO AS E, LOCALE AS L WHERE L.IdLocale=E.IdLocale;";
        } else {
            $sql = 'SELECT L.IdLocale, E.NomeEvento, L.NomeLocale, E.Descrizione AS DescrizioneEvento, E.IdEvento FROM EVENTO AS E, LOCALE AS L WHERE L.IdLocale=E.IdLocale AND E.IdLocale="'. $_GET["IdLocale"] .'";';
        }
        $res_sql = $pdo->query($sql);
        foreach ($res_sql->fetchAll() as $evento) {
            $posti = getPosti($evento["IdEvento"]);
            if (isset($_SESSION['Username']) && admin() == 1) {
                $result .= strval('<div class="h-card card-shadow events-container">
                <div class="event-card">
                    <div class="event-text">
                        <div class="event-heading">
                            <h1 class="event-title">' . $evento["NomeEvento"] . '</h1>
                            <h2 class="event-place">'. $evento["NomeLocale"] .'</h2>
                            <h3 class="event-timestamp"><time datetime="2023-01-15">15/01/2023</time>, dalle 17 alle 19</h3>
                        </div>
                        <p class="event-desc">' . $evento["DescrizioneEvento"] . '</p>
                    </div>
                    <div class="booking-container flex-col-center">
                        <a href="/php/utils/doPrenota.php?IdEvento='. $evento["IdEvento"] .'" role="button" class="btn primary-btn booking-btn">Prenota</a>
                        <a href="/php/utils/doEliminaEvento.php?IdEvento='. $evento["IdEvento"] .'" role="button" class="btn secondary-btn booking-btn">Elimina Evento</a>
                        <span class="spots-available">Posti rimasti : '.$posti.'</span>
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
                            <h3 class="event-timestamp"><time datetime="2023-01-15">15/01/2023</time>, dalle 17 alle 19</h3>
                        </div>
                        <p class="event-desc">' . $evento["DescrizioneEvento"] . '</p>
                    </div>
                    <div class="booking-container flex-col-center">
                        <a href="/php/utils/doPrenota.php?IdEvento='. $evento["IdEvento"] .'" role="button" class="btn primary-btn booking-btn">Prenota</a>
                        <span class="spots-available">Posti rimasti : '.$posti.'</span>
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
                            <h3 class="event-timestamp"><time datetime="2023-01-15">15/01/2023</time>, dalle 17 alle 19</h3>
                        </div>
                        <p class="event-desc">' . $evento["DescrizioneEvento"] . '</p>
                    </div>
                    <div class="booking-container flex-col-center">
                        <a href="javascript:void(0)" role="button" class="btn secondary-btn booking-btn">Prenota</a>
                        <span class="spots-available">Posti rimasti : '.$posti.'</span>
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