<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getLocali.php');

    // Page information 
    $fileName = 'locali';
    $desc = 'Scopri i locali che ospitano i nostri eventi e che puoi frequentare a San Junipero.';

    $builder = new PageBuilder($fileName, $desc);

    $builder->setContent("<localiPlaceholder />", getLocali());

    $page = $builder->buildPage();
    echo $page;
?>