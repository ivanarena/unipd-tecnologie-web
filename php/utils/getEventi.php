<?php 
require_once("database.php");

function getEventi() {
    $result = "";
    try {
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        if (empty($_GET)) {
            $sql = "SELECT * FROM EVENTO AS E, LOCALE AS L WHERE L.IdLocale=E.IdLocale;";
        } else {
            $sql = 'SELECT * FROM EVENTO AS E, LOCALE AS L WHERE L.IdLocale=E.IdLocale AND E.IdLocale="'. $_GET["IdLocale"] .'";';
        }
        foreach ($pdo->query($sql)->fetchAll() as $evento) {
            $result .= strval('<div class="h-card card-shadow events-container">
            <div class="event-card">
                <div class="event-text">
                    <div class="event-heading">
                        <h1 class="event-title">' . $evento["NomeEvento"] . '</h1>
                        <h2 class="event-place">'. $evento["NomeLocale"] .'</h2>
                        <h3 class="event-timestamp"><time datetime="2023-01-15">15/01/2023</time>, dalle 17 alle 19</h3>
                    </div>
                    <p class="event-desc">' . $evento["Descrizione"] . '</p>
                </div>
                <div class="booking-container flex-col-center">
                    <a href="/php/utils/doPrenota.php" role="button" class="btn primary-btn booking-btn">Prenota</a>
                    <span class="spots-available">???</span>
                </div>
            </div>
        </div>');
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