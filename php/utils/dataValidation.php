<?php require('session.php'); ?>
<?php 
function checkUsername($username){
    if (!empty($_POST)) {
        $valid = true;
        if (array_key_exists("bUsername", $_REQUEST) && !empty($_REQUEST["bUsername"]) && strlen($_REQUEST["bUsername"]) <= 100) {
            $username = $_POST['bUsername'];
        } else {
            $usernameError = 'Inserire un username';
            $valid = false;
        };
        if (array_key_exists("bUsername", $_REQUEST) && !empty($_REQUEST["bPassword"]) && strlen($_REQUEST["bPassword"]) <= 100) {
            $password = $_POST['bPassword'];
        } else {
            $passwordError = 'Inserire una password';
            $valid = false;
        }
    }
}