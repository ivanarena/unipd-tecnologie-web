<?php require('./php/session.php'); ?>
<?php 
    require_once(__DIR__.'/php/pageBuilder.php');

    // Page information 
    $fileName = 'home';
    $desc = 'Pagina principale di San Junipero, il metaverso più figo del mondo. Qui trovi tutte le informazioni relative al servizio';
    $key = 'sanjunipero, metaverso, virtuale, home, homepage';

    $builder = new PageBuilder($fileName, $desc, $key);

    $page = $builder->buildPage();

    echo $page;
?>