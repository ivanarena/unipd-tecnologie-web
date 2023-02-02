<?php require_once('session.php'); ?>
<?php 
if(!isset($_SESSION["Username"])){
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $fileName = 'registrati';
    $desc = 'Crea il tuo account e inizia la tua esperienza a San Junipero.';
    $key = 'sanjunipero, metaverso, virtuale, registrati, account';

    $builder = new PageBuilder($fileName, $desc, $key);

    if(!empty($_GET)){
        if(array_key_exists("errUser", $_REQUEST) && !empty($_REQUEST["errUser"])){
            $builder->setError("Il nome utente &egrave;	gi&agrave; esistente, provane uno nuovo.",$_GET["errUser"]);  // TODO: Stilizzare meglio
        }
        if(array_key_exists("errGen", $_REQUEST) && !empty($_REQUEST["errGen"])){
            $builder->setError("Campi non validi!!!",$_GET["errGen"]); // TODO: Stilizzare meglio
        }
        if(array_key_exists("errAge", $_REQUEST) && !empty($_REQUEST["errAge"])){
            $builder->setError("Et&agrave; non valida, devi essere maggiorenne per usufruire del servizio.",$_GET["errAge"]); // TODO: Stilizzare meglio
        }
    }

    $page = $builder->buildPage();
    echo $page;
}else{
    header('location: ../index.php');
    die();
}
?>