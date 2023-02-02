<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getAbbonamenti.php');

    // Page information 
    $fileName = 'abbonamenti';
    $desc = 'Scegli il tipo di abbonamento che preferisci al nostro metaverso.';
    $key = 'sanjunipero, metaverso, virtuale, abbonamento, acquista';

    $builder = new PageBuilder($fileName, $desc, $key);
    
    $builder->setContent("<abbonamentiPlaceholder />",getAbbonamenti());

    $page = $builder->buildPage();
    echo $page;
?>