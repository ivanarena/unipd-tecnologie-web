<?php 
require_once("database.php");
require_once("getAbbonamenti.php");

function getAnagrafica() {
$result = "";
try {
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $sql = "SELECT * FROM UTENTE WHERE Username='". $_SESSION["Username"] . "';";
    $utente = $pdo->query($sql)->fetch();
    $result = strval(
        '<div class="data-container card-shadow">
        <div class="data-row"><label for="" class="data-label">Nome utente</label><span class="data">' . $utente["Username"] . ' </span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Nome</label><span class="data">' . $utente["Nome"] . ' </span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Cognome</label><span class="data">' . $utente["Cognome"] . ' </span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">Data di nascita</label><span class="data">' . $utente["DataNascita"] . ' </span>
        </div>
        <span class="h-line"></span>
        <div class="data-row"><label for="" class="data-label">E-mail</label><span class="data">' . $utente["Email"] . ' </span></div>
        </div>'  
        );
    database::disconnect();
    } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
    }
    return $result;
}

function getAbbonamentoUtente() {
    $result = "";
    try {
        if (noAbbonamenti()) return '';
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM ABBONAMENTO_UTENTE AS AU, ABBONAMENTO AS A WHERE AU.Username='". $_SESSION["Username"] . "' AND A.IdAbbonamento = AU.IdAbbonamento;";
        $abbonamento = $pdo->query($sql)->fetch();
        $result = strval(
            '<div class="data-container card-shadow">
            <div class="data-row"><label for="" class="data-label">Tipo abbonamento</label><span class="data">' . $abbonamento["TitoloAbb"] .' </span>
            </div>
            <span class="h-line"></span>
            <div class="data-row"><label for="" class="data-label">Data sottoscrizione</label><span class="data">' . $abbonamento["DataPagamento"] .' </span>
            </div>
            <span class="h-line"></span>
            <div class="data-row"><label for="" class="data-label">Scadenza</label><span class="data">' . $abbonamento["DataScadenza"] .' </span></div>
            <a href="<urlPrefixPlaceholder/>/php/utils/doEliminaAbbUtente.php?IdAbb='.$abbonamento["IdAbbUtente"].'" class="btn primary-btn unsubscribe-btn flex-row-center flex-row-center"
            text>Disdici</a>
        </div>'  
        );

        database::disconnect();
    } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
    }
    return $result;
}

// function getCarte() {
//     $result = "";
//     try {
//         $pdo = database::connect();
//         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
//         $sql = "SELECT * FROM PORTAFOGLIO WHERE Username='". $_SESSION["Username"] . "';";
//         foreach ($pdo->query($sql)->fetchAll() as $carta) {
//             $result .= strval(
//                 '<div class="data-container card-shadow">
//                 <div class="data-row"><label for="" class="data-label">Carta</label><span class="data">'. $carta["NumeroCarta"] .'</span>
//                 </div>
//             </div>'  );
//         }

//         database::disconnect();
//     } catch (PDOException $e) {
//                 echo 'Errore PDO e connessione DB: <br />';
//                 echo 'SQLQuery: ', $sql;
//                 echo 'Errore: ' . $e->getMessage();
//     }
//     return $result;
// }

?>