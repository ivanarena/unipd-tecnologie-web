<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $title = 'Abbonamenti';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/abbonamenti.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>
