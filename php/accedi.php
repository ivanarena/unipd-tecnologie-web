<?php require_once('session.php'); ?>
<?php 
if(!isset($_SESSION["Username"])){
    require_once(__DIR__.'/pageBuilder.php');
    
    // Page information 
    $fileName = 'accedi';
    $desc = 'Accedi al sito dal tuo account e scopri tutte le novità disponibili sul tuo profilo.';
    $key = 'sanjunipero, metaverso, virtuale, accedi, profilo';

    $builder = new PageBuilder($fileName, $desc, $key);

    //Visualizzazione messaggio di errore
    if(array_key_exists("errUser", $_REQUEST) && !empty($_REQUEST["errUser"])){
        $builder->setError("Il nome utente non &egrave;	corretto.",$_GET["errUser"]);  // TODO: Stilizzare meglio
    }elseif(array_key_exists("errPass", $_REQUEST) && !empty($_REQUEST["errPass"])){
        $builder->setError("La password non &egrave; corretto.",$_GET["errPass"]); // TODO: Stilizzare meglio
    }elseif(array_key_exists("errGen", $_REQUEST) && !empty($_REQUEST["errGen"])){
        $builder->setError("Campi non validi!!!",$_GET["errGen"]); // TODO: Stilizzare meglio
    }
    
    $page = $builder->buildPage();
    echo $page;
}else{
    header('location: ../index.php');
    die();
}
?>