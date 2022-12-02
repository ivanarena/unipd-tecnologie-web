<?php 
    require_once(__DIR__.'/php/pageBuilder.php');

    $builder = new PageBuilder('index', '.');
    $builder->setHead(file_get_contents(__DIR__."/php/pages/components/head.html"));
    $page = $builder->buildPage();
    echo $page;
?>