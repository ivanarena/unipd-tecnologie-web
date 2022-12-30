<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    
    // Page information 
    $fileName = 'acquista';
    $desc = 'Effettua l &#39 acquisto del tuo abbonamento al metaverso.';

    $builder = new PageBuilder($fileName, $desc);
    
    $builder->setContent("<idAbbPlaceholder />", $_GET["IdAbb"]);

    $page = $builder->buildPage();
    echo $page;
?>