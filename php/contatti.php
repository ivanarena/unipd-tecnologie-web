<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $title = 'Contatti';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/contatti.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>