<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getPrenotazioni.php');

    // Page information 
    $fileName = 'prenotazioni';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $desc);

    $builder->setContent("<prenotazioniPlaceholder />", getPrenotazioni());

    $page = $builder->buildPage();
    echo $page;
?>