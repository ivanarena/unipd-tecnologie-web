<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'registrazione';
    $desc = 'Pagina di rigraziamento per l&apos;avvenuta registrazione';
    $key = 'sanjunipero, metaverso, virtuale, registrati';

    $builder = new PageBuilder($fileName, $desc, $key);

    $page = $builder->buildPage();
    echo $page;
?>