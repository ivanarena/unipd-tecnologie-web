<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $title = 'Locali';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/locali.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>