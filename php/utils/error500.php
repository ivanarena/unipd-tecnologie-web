<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'error500';
    $desc = 'Il server ha riscontrato un errore interno';
    $key = 'sanjunipero, metaverso, virtuale, error500';

    $builder = new PageBuilder($fileName, $desc, $key);

    $page = $builder->buildPage();
    echo $page;
?>