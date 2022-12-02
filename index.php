<?php 
    require_once(__DIR__.'/php/pageBuilder.php');

    // Page information 
    $title = 'Home';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/index.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>