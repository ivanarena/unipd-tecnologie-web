<?php 
require_once("database.php");

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
        foreach ($pdo->query($sql)->fetchAll() as $evento) {
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
                        <span class="spots-available">???</span>
                    </div>
                </div>
                </div>');
            } else if (isset($_SESSION['Username']) && abbonato()) {
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
                        <span class="spots-available">???</span>
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
                        <span class="spots-available">???</span>
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