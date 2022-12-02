<?php 
    require_once(__DIR__.'/php/pageBuilder.php');

    $builder = new PageBuilder('index', '.');
    $builder->setHead(file_get_contents(__DIR__."/php/pages/components/head.html"));
    $builder->setHeader(file_get_contents(__DIR__."/php/pages/components/header.html"));
    $builder->setFooter(file_get_contents(__DIR__."/php/pages/components/footer.html"));
    $page = $builder->buildPage();
    echo $page;
?>