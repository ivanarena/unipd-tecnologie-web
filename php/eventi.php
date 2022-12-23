<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $fileName = 'eventi';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $desc);

    $builder->setContent("<eventiPlaceholder />",getEventi());

    $page = $builder->buildPage();
    echo $page;
?>