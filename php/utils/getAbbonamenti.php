<?php 

require_once("database.php");

function noAbbonamenti() {
    $ret=0;
    $pdo = database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT Count(*) FROM ABBONAMENTO_UTENTE WHERE Username=? AND CURDATE()<=DataScadenza;";
    $stmt = $pdo->prepare($query);
    $stmt->execute(array($_SESSION["Username"]));
    if($stmt->fetchColumn() <= 0){
        $ret = 1;
    }
    database::disconnect();
    return $ret;
}

function getAbbonamenti(){
    $result = "";
    try{
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM ABBONAMENTO;";
        
        foreach ($pdo->query($sql)->fetchAll() as $abbonamento) {
            if (isset($_SESSION['Username']) && noAbbonamenti()) {
                $result.= strval('<div class="plan-card card-shadow">
                <div class="plan-card-content">
                        <h1 class="plan-name"><span lang="en">'.$abbonamento["TitoloAbb"].'</span></h1>
                        <span class="plan-price"><span class="euro">&#8364;</span>'.$abbonamento["Prezzo"].'</span>
                        <ul class="plan-features">
                            <li class="plan-feature">
                                <p class="feature-name">Durata <abbr title="abbonamento">abb</abbr>.</p>
                                <p class="feature-desc">90 giorni</p>
                            </li>
                            <li class="plan-feature">
                                <p class="feature-name">Eventi</p>
                                <p class="feature-desc">'.$abbonamento["EventiSettimanali"].'/settimana</p>
                            </li>
                            <li class="plan-feature">
                                <p class="feature-name">Borsellino</p>
                                <p class="feature-desc">'.substr($abbonamento["MetaCoin"], 0, -3).'€/giorno</p>
                            </li>
                        </ul>
                        </div>
                    <a href="/php/acquista.php?IdAbb='.$abbonamento["IdAbbonamento"].'&nomeAbb='.$abbonamento["TitoloAbb"].'" class="btn primary-btn subscribe-btn flex-row-center flex-row-center">Acquista</a>
                </div>');
            } else {
                $result.= strval('<div class="plan-card card-shadow">
                <div class="plan-card-content">
                        <h1 class="plan-name"><span lang="en">'.$abbonamento["TitoloAbb"].'</span></h1>
                        <span class="plan-price"><span class="euro">&#8364;</span>'.$abbonamento["Prezzo"].'</span>
                        <ul class="plan-features">
                            <li class="plan-feature">
                                <p class="feature-name">Durata <abbr title="abbonamento">abb</abbr>.</p>
                                <p class="feature-desc">90 giorni</p>
                            </li>
                            <li class="plan-feature">
                                <p class="feature-name">Eventi</p>
                                <p class="feature-desc">'.$abbonamento["EventiSettimanali"].'/settimana</p>
                            </li>
                            <li class="plan-feature">
                                <p class="feature-name">Borsellino</p>
                                <p class="feature-desc">'.substr($abbonamento["MetaCoin"], 0, -3).'€/giorno</p>
                            </li>
                        </ul>
                        </div>
                        <span class="hide error-msg">Per acquistare un abbonamento devi prima registrarti. Ricorda che puoi sottoscrivere un solo abbonamento!</span>
                        <button class="btn secondary-btn unsubscribe-btn flex-row-center flex-row-center">Acquista</button>
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