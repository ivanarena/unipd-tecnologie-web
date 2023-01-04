<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');
    require_once('getLocali.php');

    // Page information 
    $fileName = 'crea-evento';
    $desc = 'Crea un nuovo evento.';

    $builder = new PageBuilder($fileName, $desc);

    $builder->setContent("<getLocali />", getLocaliAsOptions());

    $page = $builder->buildPage();
    echo $page;
?>