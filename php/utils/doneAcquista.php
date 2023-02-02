<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'pagamento';
    $desc = 'Pagina di rigraziamento per l&apos;avvenuto pagamento!';
    $key = 'sanjunipero, metaverso, virtuale, acquista';

    $builder = new PageBuilder($fileName, $desc, $key);

    $page = $builder->buildPage();
    echo $page;
?>