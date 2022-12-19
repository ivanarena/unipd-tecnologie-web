<?php require_once('session.php'); ?>
<?php 
    require_once(__DIR__.'/pageBuilder.php');

    // Page information 
    $fileName = 'abbonamenti';
    $desc = 'blabalb';

    $builder = new PageBuilder($fileName, $desc);

    // ! PROVANDO A FARLO FUNZIONARE
    // try {
    //     include_once('./utils/database.php');
    //     $pdo = database::connect();
    //     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //     for ($i = 1; $i <= 3; $i+=1) {
    //         $sth = $pdo->prepare("SELECT * FROM ABBONAMENTO WHERE IdAbbonamento = $i");
    //         $sth->execute(array($abbonamenti));
    //         $results = $sth->fetch(PDO::FETCH_ASSOC);
    //     }
    //     database::disconnect();
    // } catch (PDOException $e) {
    //     echo 'Errore PDO e connessione DB: <br />';
    //     echo 'SQLQuery: ', $sql;
    //     echo 'Errore: ' . $e->getMessage();
    // }
    
    $page = $builder->buildPage();
    echo $page;
?>
