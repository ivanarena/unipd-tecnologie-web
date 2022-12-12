<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    // Page information 
    $title = 'Accedi';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/accedi.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>