<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getProfilo.php');

    // Page information 
    $fileName = 'prenotazioni';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $desc);

    // $builder->setContent("<anagraficaPlaceholder />", getAnagrafica());

    $page = $builder->buildPage();
    echo $page;
?>