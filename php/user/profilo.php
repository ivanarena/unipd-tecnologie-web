<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');
    require_once('../utils/getProfilo.php');

    // Page information 
    $fileName = 'profilo';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $desc);

    // $builder->setContent("<anagraficaPlaceholder />", getAnagrafica());

    $page = $builder->buildPage();
    echo $page;
?>