<?php 
require_once("../session.php");
if (isset($_SESSION['Username'])) {
    header("location: ../../index.php");
} else { 
    if (!empty($_POST)) {
        $usernameError = null;
        $passwordError = null;
        $valid = true;
        if (array_key_exists("username", $_REQUEST) && !empty($_REQUEST["username"]) && strlen($_REQUEST["username"]) <= 20) {
            $username = $_POST['username'];
        } else {
            $valid = false;
        };
        if (array_key_exists("password", $_REQUEST) && !empty($_REQUEST["password"]) && strlen($_REQUEST["password"]) <= 50) {
            $password = $_POST['password'];
        } else {
            $valid = false;
        };
        if ($valid) { 
            try {
                include_once('./database.php');
                $pdo = database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("SELECT Count(*) FROM UTENTE WHERE Username=?;");
                $stmt->execute(array($username));
                if ($stmt->fetchColumn() <= 0) {
                    header_remove();
                    header("location: ../accedi.php?errUser=1");
                    die();
                } else {
                    $sql = "SELECT * from UTENTE WHERE Username = ?";
                    $DBUsername = $pdo->prepare($sql);
                    $DBUsername->execute(array($username));
                    $data = $DBUsername->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($password, $data['Password'])) {
                        $_SESSION["Username"] = $data["Username"];
                        $_SESSION["admin"] = $data["Privilegio"];
                    } else {
                        header_remove();
                        header("location: ../accedi.php?errPass=1");
                        die();
                    }
                }
                database::disconnect();
            } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
            }
            if (isset($_SESSION['Username'])) {
                header("location: ../../index.php");
                die();
            }
        } else {
            header("location: ../accedi.php?errGen=1");
            die();
        }
    }
    header('location: ./error403.php');
    die();
}?>