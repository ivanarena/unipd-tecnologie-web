<?php 
require_once("database.php");

function getLocaliAsOptions() {
    $result = "";
    try{
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM LOCALE;";
        foreach ($pdo->query($sql)->fetchAll() as $locale) {
            $result.= strval('<option value="'. $locale["IdLocale"] . '">'. $locale["NomeLocale"] .'</option>');
        }
    database::disconnect();
    } catch (PDOException $e) {
    echo 'Errore PDO e connessione DB: <br />';
    echo 'SQLQuery: ', $sql;
    echo 'Errore: ' . $e->getMessage();
    }
    return $result;
}


function getLocali(){
    $result = "";

    try{
        $pdo = database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM LOCALE;";
        foreach ($pdo->query($sql)->fetchAll() as $locale) {
            $result.= strval('<div class="h-card card-shadow">
            <img class="place-img" src="<urlPrefixPlaceholder/>' . $locale["LinkImg"] . '" alt="' . $locale["AltImg"] . '"/>
            <div class="place-info-container">

                <div class="place-text">
                    <h1 class="place-name">' . $locale["NomeLocale"] . '</h1>
                    <h2 class="place-street">' . $locale["Indirizzo"] . '</h2>
                    <p class="place-desc">' . $locale["Descrizione"] . '</p>
                </div>
                <div class="btn-container">
                    <a class="btn primary-btn place-events-btn" href="<urlPrefixPlaceholder/>/php/eventi.php?IdLocale='. $locale["IdLocale"] .'">Controlla gli eventi</a>
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