<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'error403';
    $desc = 'Il server ha compreso la richiesta ma nega l&#39; autorizzazione';
    $key = 'sanjunipero, metaverso, virtuale, error403';

    $builder = new PageBuilder($fileName, $desc, $key);

    $page = $builder->buildPage();
    echo $page;
?>