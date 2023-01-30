<?php require('./php/session.php'); ?>
<?php 
    require_once(__DIR__.'/php/pageBuilder.php');

    // Page information 
    $fileName = 'home';
    $title = 'Home';
    $desc = 'Pagina principale di San Junipero, il metaverso più figo del mondo. Qui trovi tutte le informazioni relative al servizio';

    $builder = new PageBuilder($fileName, $title, $desc);

    $page = $builder->buildPage();

    echo $page;
?>