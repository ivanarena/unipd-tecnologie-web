<?php 
require_once("database.php");

function getAnagrafica() {
    $result = "";
    try {
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM UTENTE WHERE Username='". $_SESSION["Username"] . "';";
        $utente = $pdo->query($sql)->fetchAll();
        $result .= strval(
            '<div class="data-container card-shadow">
            <div class="data-row"><label for="" class="data-label">Nome utente</label><span class="data">' . $utente["Username"] . '</span>
            </div>
            <span class="h-line"></span>
            <div class="data-row"><label for="" class="data-label">Nome</label><span class="data">' . $utente["Nome"] . '</span></div>
            <span class="h-line"></span>
            <div class="data-row"><label for="" class="data-label">Cognome</label><span class="data">' . $utente["Cognome"] . '</span>
            </div>
            <span class="h-line"></span>
            <div class="data-row"><label for="" class="data-label">Data di nascita</label><span class="data">' . $utente["DataNascita"] . '</span>
            </div>
            <span class="h-line"></span>
            <div class="data-row"><label for="" class="data-label">E-mail</label><span class="data">' . $utente["Email"] . '</span></div>
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


?>