<?php 
require_once("../session.php");
if (isset($_SESSION['Username'])) {
    header("location: ../../index.php");
} else { 
    // ! NON FUNZIA DC
    if (!empty($_POST)) {
        $usernameError = null;
        $valid = true;
        if (array_key_exists("username", $_REQUEST) && !empty($_REQUEST["username"]) && strlen($_REQUEST["username"]) <= 20) { 
            // estendere i controlli a tutto i guess?
            $username = $_POST['username'];
            $password = $_POST['password'];
            $data = $_POST['data'];
            $nome = $_POST['nome'];
            $cognome = $_POST['cognome'];
        } else {
            $valid = false;
        };
        if ($valid) { 
            try {
                include_once('./database.php');
                $pdo = database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("SELECT Count(*) FROM UTENTE WHERE Username=$username;");
                $stmt->execute(array($username));
                if ($stmt->fetchColumn() > 0) {
                    header_remove();
                    header("location: ../registrati.php?errUser=1");
                } else {
                    $sql = "INSERT INTO UTENTE VALUES('$username', '$password', '$email', '$nome', '$cognome', '$data', 0);";
                    $DBUsername = $pdo->prepare($sql);
                    $DBUsername->execute();
                }
                database::disconnect();
            } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
            }
            if (isset($_SESSION['Username'])) {
                header("location: ../../index.php");
            }
        }else{
            header("location: ../registrati.php?errGen=1");
        }
    }
}?>