<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $fileName = 'contatti';
    $desc = 'Contattaci per qualsiasi tuo dubbio o curiosità sul nostro servizio.';
    $key = 'sanjunipero, metaverso, virtuale, contatti, contattaci, informazioni';

    $builder = new PageBuilder($fileName, $desc, $key);

    $page = $builder->buildPage();
    echo $page;
?>