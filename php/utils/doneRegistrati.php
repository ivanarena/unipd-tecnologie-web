<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'registrazione';
    $desc = 'Pagina di rigraziamento per l&apos;avvenuta registrazione';

    $builder = new PageBuilder($fileName, $desc);

    $page = $builder->buildPage();
    echo $page;
?>