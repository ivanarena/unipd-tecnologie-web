<?php 
require_once("database.php");


function getPrenotazioni() {
$result = "";
try {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM EVENTO_UTENTE AS EU, EVENTO AS E, LOCALE AS L WHERE Username='". $_SESSION["Username"] . "' AND EU.IdEvento = E.IdEvento AND L.IdLocale = E.IdLocale;";
    foreach ($pdo->query($sql)->fetchAll() as $prenotazione) {
        $result .= strval(
            '<div class="data-container card-shadow">
        <div class="data-row"><label for="" class="data-label">Evento</label><span class="data">' . $prenotazione["NomeEvento"] . '</span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Luogo</label><span class="data">' . $prenotazione["NomeLocale"] . '</span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Data</label><span class="data">' . $prenotazione["DataOraInizio"] . '</span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Ora</label><span class="data">' . $prenotazione["DataOraFine"] . '</span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Durata</label><span class="data">' . strval($prenotazione["DataOraFine"]-$prenotazione["DataOraInizio"]) . '</span></div>
        <a href="/php/utils/doEliminaEventoUtente.php?IdEvento='. $prenotazione["IdEvento"].'" class="btn primary-btn unsubscribe-btn flex-row-center flex-row-center"
            text>Disdici</a>
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