<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');
    require_once(__DIR__.'/utils/getEventi.php');

    // Page information 
    $fileName = 'eventi';
    $desc = 'Scopri tutti gli eventi disponibili a cui puoi partecipare nel nostro metaverso.';

    $builder = new PageBuilder($fileName, $desc);

    $builder->setContent("<eventiPlaceholder />", getEventi());
    $builder->setContent("<eventiRimPlaceholder />", nEventiRimanenti());

    $page = $builder->buildPage();
    echo $page;
?>