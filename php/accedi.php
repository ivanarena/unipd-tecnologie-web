<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    // Page information 
    $fileName = 'accedi';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $desc);

    //Visualizzazione messaggio di errore
    if(!empty($_GET)){
        if(array_key_exists("errUser", $_REQUEST) && !empty($_REQUEST["errUser"])){
            $builder->setError("L'username è inesistente!!!",$_GET["errUser"]);  // TODO: Stilizzare meglio
        }
        if(array_key_exists("errPass", $_REQUEST) && !empty($_REQUEST["errPass"])){
            $builder->setError("La password è errata!!!",$_GET["errPass"]); // TODO: Stilizzare meglio
        }
        if(array_key_exists("errGen", $_REQUEST) && !empty($_REQUEST["errGen"])){
            $builder->setError("Campi non validi!!!",$_GET["errGen"]); // TODO: Stilizzare meglio
        }
    }
    
    $page = $builder->buildPage();
    echo $page;
?>