<?php
require_once('../session.php');
if (isset($_SESSION['Username'])) {
    header("location: ../../index.php");
} else { 
    $registrazioneCompletata = false;
    if (!empty($_POST)) {
        $usernameError = null;
        $passwordError = null;
        $nomeError = null;
        $cognomeError = null;
        $dataCheck = false;
        $dataError = null;
        $valid = true;
        if (array_key_exists("username", $_REQUEST) && !empty($_REQUEST["username"]) && strlen($_REQUEST["username"]) <= 50) {
            $username = $_POST['username'];
        } else {
            $usernameError = 'Inserire un username';
            $valid = false;
        };
        if (array_key_exists("data", $_REQUEST) && !empty($_REQUEST["data"])) {
            $data = $_POST['data'];
            $tdata=date_parse($data);
            if (checkdate($tdata['month'], $tdata['day'], $tdata['year'])) {
                $date1=date_create($tdata['year'].'-'.$tdata['month'].'-'.$tdata['day']);
                $date2=date_create(date("Y-m-d"));
                $diff=date_diff($date1,$date2);
                if(intval($diff->format("%y"))>=18){
                    $dataCheck = true;
                }
            }
        } else {
            $dataError = 'Inserire una data';
            $valid = false;
        };
        if (array_key_exists("email", $_REQUEST) && !empty($_REQUEST["email"])){
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $emailError = 'Email non valida';
                $valid = false;
            }
        }else{
            $emailError = 'Inserire un email';
            $valid = false;
        };
        if (array_key_exists("password", $_REQUEST) && !empty($_REQUEST["password"]) && strlen($_REQUEST["password"]) <= 255) {
            $password = $_POST['password'];
        } else {
            $passwordError = 'Inserire una password';
            $valid = false;
        };
        if (array_key_exists("nome", $_REQUEST) && !empty($_REQUEST["nome"]) && strlen($_REQUEST["nome"]) <= 50) {
            $nome = $_POST['nome'];
        } else {
            $nomeError = 'Inserire un nome';
            $valid = false;
        };
        if (array_key_exists("cognome", $_REQUEST) && !empty($_REQUEST["cognome"]) && strlen($_REQUEST["cognome"]) <= 50) {
            $cognome = $_POST['cognome'];
        } else {
            $cognomeError = 'Inserire un cognome';
            $valid = false;
        };
        if ($valid && $dataCheck) {            
            try {
                include_once('database.php');
                $pdo = database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("SELECT Count(*) FROM UTENTE WHERE Username='$username';");
                $stmt->execute();
                if ($stmt->fetchColumn() > 0) {
                    header('location: ../registrati.php?errUser=1');
                } else {
                    $sql = "INSERT INTO UTENTE(Username, Password, Email, Nome, Cognome, DataNascita) values(?,?,?,?,?,?)";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($username, password_hash($password, PASSWORD_DEFAULT), $email, $nome, $cognome, $data));
                    $registrazioneCompletata = true;
                }
                database::disconnect();
            } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
            }
            if($registrazioneCompletata){
                header('location: ./doneRegistrati.php');
            }
        } else {
            header("location: ../registrati.php?errGen=1");
        } 
    }
}
?>