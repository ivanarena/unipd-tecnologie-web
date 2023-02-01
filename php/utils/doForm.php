<?php
require_once("../session.php");
if (!empty($_POST)) {
    $nomeError = null;
    $cognomeError = null;
    $emailError = null;
    $msgError = null;
    $invioEffettuato = false;
    $valid = true;
    if (array_key_exists("nome", $_REQUEST) && !empty($_REQUEST["nome"]) && strlen($_REQUEST["nome"]) <= 50) {
        $nome = $_POST['nome'];
    } else {
        $nomeError = 'Inserire un nome :';
        $valid = false;
    }
    if (array_key_exists("cognome", $_REQUEST) && !empty($_REQUEST["cognome"]) && strlen($_REQUEST["cognome"]) <= 50) {
        $cognome = $_POST['cognome'];
    } else {
        $cognomeError = 'Inserire il cognome :';
        $valid = false;
    }
    if (array_key_exists("email", $_REQUEST) && !empty($_REQUEST["email"]) && strlen($_REQUEST["email"]) <=100) {
        $email = $_POST['email'];
    } else {
        $emailError = 'Inserire un email :';
        $valid = false;
    }
    if (array_key_exists("msg", $_REQUEST) && !empty($_REQUEST["msg"]) && strlen($_REQUEST["msg"]) <=2048) {
        $msg = $_POST['msg'];
    } else {
        $msgError = 'Inserire un messaggio :';
        $valid = false;
    }

    if ($valid) {            
        try {
            include_once('database.php');
            $pdo = database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO FORM(Nome, Cognome, Email, Msg, DataInvio) VALUES(?,?,?,?,?);";
            $q = $pdo->prepare($sql);
            $q->execute(array($nome,$cognome,$email,$msg,date("Y-m-d")));
            $invioEffettuato = true;
            database::disconnect();
        } catch (PDOException $e) {
            echo 'Errore PDO e connessione DB: <br />';
            echo 'SQLQuery: ', $sql;
            echo 'Errore: ' . $e->getMessage();
        }
        if($invioEffettuato){
            header('location: ./doneForm.php');
            die();
        }
    }
    if($invioEffettuato == false){
        header('location: ../contatti.php');
        die();
    }
}else{
    header('location: ./error403.php');
    die();
}

?>