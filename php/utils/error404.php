<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'error404';
    $desc = 'Pagina non trovata';
    $key = 'sanjunipero, metaverso, virtuale, error404';

    $builder = new PageBuilder($fileName, $desc, $key);

    $page = $builder->buildPage();
    echo $page;
?>
