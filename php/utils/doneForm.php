<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'form';
    $desc = 'Pagina di rigraziamento per l&apos;avvenuto invio del messaggio!';

    $builder = new PageBuilder($fileName, $desc);

    $page = $builder->buildPage();
    echo $page;
?>