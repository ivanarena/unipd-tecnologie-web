<?php require('./php/session.php'); ?>
<?php 
    require_once(__DIR__.'/php/pageBuilder.php');

    // Page information 
    $fileName = 'home';
    $title = 'Home';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $title, $desc);

    $page = $builder->buildPage();

    echo $page;
?>