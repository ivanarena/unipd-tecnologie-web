<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $title = 'Registrati';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/registrati.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>