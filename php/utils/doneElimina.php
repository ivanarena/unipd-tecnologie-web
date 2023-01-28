<?php require_once('../session.php'); ?>
<?php 
    require_once('../pageBuilder.php');

    // Page information 
    $fileName = 'eliminato';
    $desc = 'Hai eliminato il tuo account';

    $builder = new PageBuilder($fileName, $desc);
    if (isset($_SESSION["Username"])){
    session_destroy();
    unset($_SESSION['Username']);
    }

    $page = $builder->buildPage();
    echo $page;
?>