<?php 
require_once("database.php");


function getPrenotazioni() {
$result = "";
try {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $sql = "SELECT EU.IdEvento, E.NomeEvento, L.NomeLocale, DATE_FORMAT(E.DataOraInizio,'%d/%m/%Y') as dataInizio, DATE_FORMAT(DataOraInizio,'%H:%i') as oraInizio, DATE_FORMAT(DataOraFine,'%H:%i') as oraFine FROM EVENTO_UTENTE AS EU, EVENTO AS E, LOCALE AS L WHERE Username='". $_SESSION["Username"] . "' AND EU.IdEvento = E.IdEvento AND L.IdLocale = E.IdLocale;";
    foreach ($pdo->query($sql)->fetchAll() as $prenotazione) {
        $result .= strval(
            '<div class="data-container card-shadow">
        <div class="data-row"><label for="" class="data-label">Evento</label><span class="data">' . $prenotazione["NomeEvento"] . '</span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Luogo</label><span class="data">' . $prenotazione["NomeLocale"] . '</span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Data</label><span class="data">' . $prenotazione["dataInizio"] . '</span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Orario</label><span class="data">dalle ' . $prenotazione["oraInizio"] . ' alle ' . $prenotazione["oraFine"] . '</span>
        </div>
        <a href="<urlPrefixPlaceholder/>/php/utils/doEliminaEventoUtente.php?IdEvento='. $prenotazione["IdEvento"].'" class="btn primary-btn unsubscribe-btn flex-row-center flex-row-center"
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