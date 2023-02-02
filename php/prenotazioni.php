<?php require_once('session.php'); ?>
<?php 
if(isset($_SESSION["Username"])){
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getPrenotazioni.php');

    // Page information 
    $fileName = 'prenotazioni';
    $desc = 'Effettua la tua prenotazione agli eventi che desideri.';
    $key = 'sanjunipero, metaverso, virtuale, prenotati, eventi';

    $builder = new PageBuilder($fileName, $desc, $key);

    $builder->setContent("<prenotazioniPlaceholder />", getPrenotazioni());

    $page = $builder->buildPage();
    echo $page;
}else{
    header('location: ./utils/error403.php');
}
?>