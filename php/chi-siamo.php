<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $title = 'Chi siamo';
    $desc = 'blabalb';

    $builder = new PageBuilder('/pages/chi-siamo.html', $title, $desc);

    $page = $builder->buildPage();
    echo $page;
?>