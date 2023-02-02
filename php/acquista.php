<?php require_once('session.php'); ?>
<?php 
require_once(__DIR__.'/pageBuilder.php');
require_once(__DIR__.'/utils/getAbbonamenti.php');
if(isset($_SESSION["Username"]) && noAbbonamenti()){
    // Page information 
    $fileName = 'acquista';
    $desc = 'Effettua l &#39 acquisto del tuo abbonamento al metaverso.';
    $key = 'sanjunipero, metaverso, virtuale, acquista, abbonamento';

    $builder = new PageBuilder($fileName, $desc, $key);
    if(array_key_exists("IdAbb", $_REQUEST) && !empty($_REQUEST["IdAbb"]) && array_key_exists("nomeAbb", $_REQUEST) && !empty($_REQUEST["nomeAbb"])){
        $builder->setContent("<idAbbPlaceholder />", $_GET["IdAbb"]);
        $builder->setContent("<nameAbbPlaceholder />", $_GET["nomeAbb"]);
    }else{
        header('location: abbonamenti.php');
    }

    if(array_key_exists("errGen", $_REQUEST) && !empty($_REQUEST["errGen"])){
        $builder->setError("Errore generico!!! Controlla i campi",$_GET["errGen"]); // TODO: Stilizzare meglio
    }

    $page = $builder->buildPage();
    echo $page;
}else{
    header('location: ./utils/error403.php');
}
?>