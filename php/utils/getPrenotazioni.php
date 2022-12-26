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
            <div class="data-row">
            <label class="data-label">Evento</label>
            <label class="data-label">Luogo</label>
            <label class="data-label">Data</label>
            <label class="data-label">Ora</label>
            <label class="data-label">Durata</label>
            </div>
            <div class="data-row">
            <span class="data">'. $prenotazione["NomeEvento"] .'</span>
            <span class="data">'. $prenotazione["NomeLocale"] .'</span>
            <span class="data">'. $prenotazione["DataOraInizio"] .'</span>
            <span class="data">'. $prenotazione["DataOraFine"] .'</span>
            <span class="data">'. strval($prenotazione["DataOraFine"]-$prenotazione["DataOraInizio"]) .'</span>
            </div>
            <span class="h-line"></span>
            </div>'  
        );
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