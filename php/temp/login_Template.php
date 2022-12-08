<?php require_once("session.php");
if (isset($_SESSION['loggato'])) {
    header("location: ./index.php");
} else { ?>
    <?php if (!empty($_POST)) {
        $usernameError = null;
        $passwordError = null;
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
        };

        if ($valid) {

            try {
                include_once('database.php');
                $pdo = database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("SELECT Count(*) FROM UTENTI WHERE Username=?;");
                $stmt->execute(array($username));

                if ($stmt->fetchColumn() <= 0) {
                    $usernameError = "L'username $username non esiste, crea un account. <a class='w3-button	w3-black' href='./registrazione.php'>Registrazione</a>";
                } else {
                    $sql = "SELECT * from UTENTI WHERE Username = ?";
                    $DBUsername = $pdo->prepare($sql);
                    $DBUsername->execute(array($username));
                    $data = $DBUsername->fetch(PDO::FETCH_ASSOC);
                    if (password_verify($password, $data['Password'])) {
                        $_SESSION["idUtente"] = $data["IdUt"];
                        $_SESSION["loggato"] = $data["Privilegi"];
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
        }
    }
    if (isset($_SESSION['loggato'])) {
        header("location: ./index.php");
    }
    ?>
    <?php include_once('header.php'); ?>
    <title>Login - EasyTrain</title>
    </head>


    <body>
        <?php include_once('nav.php') ?>
        <div class="w3-container w3-sand w3-padding-16" style="width:100%">
            <h1 class="w3-center">Login</h1>
            <form class="w3-container" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                <label for="bUsername">Username : </label>
                <input class="w3-input" type="text" placeholder="Username" name="bUsername" value="<?php echo !empty($username) ? $username : ''; ?>">
                <?php if (!empty($usernameError)) : ?>
                    <div class="w3-panel w3-border-left w3-pale-red w3-border-red">
                        <span><?php echo $usernameError; ?></span>
                    </div>
                <?php endif; ?>
                <label for="bPassword">Password : </label>
                <input class="w3-input" placeholder="******" name="bPassword" type="password" value="<?php echo !empty($password) ? $password : ''; ?>">
                <?php if (!empty($passwordError)) : ?>
                    <div class="w3-panel w3-border-left w3-pale-red w3-border-red">
                        <span><?php echo $passwordError; ?></span>
                    </div>
                <?php endif; ?>
                <br>
                <button type="submit" class="w3-btn w3-black">Accedi</button>
            </form>
        </div>
        <?php include_once('scripts.php') ?>
        <script>
            jQuery(document).ready(function() {

                $("input[name='bPassword']")
                    .mouseenter(function() {
                        $(this).attr("type", "text");
                    })
                    .mouseleave(function() {
                        $(this).attr("type", "password");
                    });
            });
        </script>
        <?php include_once('footer.php'); ?><?php } ?>