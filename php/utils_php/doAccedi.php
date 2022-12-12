<?php require_once("../session.php");
if (isset($_SESSION['loggato'])) {
    header("location: ../../index.php");
} else { echo 'Sono nel post';?>
    <?php
    if (!empty($_POST)) {
        $usernameError = null;
        $passwordError = null;
        $valid = true;
        if (array_key_exists("username", $_REQUEST) && !empty($_REQUEST["username"]) && strlen($_REQUEST["username"]) <= 20) {
            $username = $_POST['username'];
        } else {
            $usernameError = 'Inserire un username';
            $valid = false;
        };
        if (array_key_exists("password", $_REQUEST) && !empty($_REQUEST["password"]) && strlen($_REQUEST["password"]) <= 50) {
            $password = $_POST['password'];
        } else {
            $passwordError = 'Inserire una password';
            $valid = false;
        };
        echo 'Sono nel post';
        print_r($_POST);
        echo  $_POST['password'];
        if ($valid) { 
            try {
                include_once('./database.php');
                $pdo = database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("SELECT Count(*) FROM UTENTE WHERE Username=?;");
                $stmt->execute(array($username));

                if ($stmt->fetchColumn() <= 0) {
                    $usernameError = "L'username $username non esiste, crea un account. <a class='w3-button	w3-black' href='./registrazione.php'>Registrazione</a>";
                } else {
                    $sql = "SELECT * from UTENTE WHERE Username = ?";
                    $DBUsername = $pdo->prepare($sql);
                    $DBUsername->execute(array($username));
                    $data = $DBUsername->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($password, $data['Password'])) {
                        $_SESSION["Username"] = $data["Username"];
                        $_SESSION["loggato"] = $data["Privilegio"];
                    } else {
                        $passwordError = "Password Errata";
                    }
                }
                database::disconnect();
            } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
            }
            if (isset($_SESSION['loggato'])) {
                header("location: ./index.php");
            }
        }
    }
    ?>
    <?php } ?>