<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'prenotazione';
    $desc = 'Pagina di rigraziamento per l&apos;avvenuta prenotazione';

    $builder = new PageBuilder($fileName, $desc);

    $page = $builder->buildPage();
    echo $page;
?>