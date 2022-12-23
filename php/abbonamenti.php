<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getAbbonamenti.php');

    // Page information 
    $fileName = 'abbonamenti';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $desc);
    
    $builder->setContent("<abbonamentiPlaceholder />",getAbbonamenti());
    

    $page = $builder->buildPage();
    echo $page;
?>
