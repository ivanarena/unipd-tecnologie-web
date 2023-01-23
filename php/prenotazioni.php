<?php require_once('session.php'); ?>
<?php 
if(isset($_SESSION["Username"])){
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getPrenotazioni.php');

    // Page information 
    $fileName = 'prenotazioni';
    $desc = 'Effettua la tua prenotazione agli eventi che desideri.';

    $builder = new PageBuilder($fileName, $desc);

    $builder->setContent("<prenotazioniPlaceholder />", getPrenotazioni());

    $page = $builder->buildPage();
    echo $page;
}else{
    header('location: error403.php');
}
?>