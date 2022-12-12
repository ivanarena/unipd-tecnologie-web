<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $title = 'Eventi';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/eventi.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>