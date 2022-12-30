<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $fileName = 'chi-siamo';
    $desc = 'Scopri qualcosa in più sugli sviluppatori di San Junipero.';

    $builder = new PageBuilder($fileName, $desc);

    $page = $builder->buildPage();
    echo $page;
?>