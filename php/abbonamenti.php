<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $fileName = 'abbonamenti';
    $title = 'Abbonamenti';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>
