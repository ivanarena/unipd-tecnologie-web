<?php require('session.php'); ?>
<?php if (isset($_SESSION['loggato'])) {
    header("location: ./index.php");
} else { ?>
    <?php include_once('database.php');
    $registrazioneCompletata = false;
    if (!empty($_POST)) {
        $usernameError = null;
        $passwordError = null;
        $nomeError = null;
        $cognomeError = null;
        $nonsonounpcError = null;
        $nonsonounpc = (is_numeric($_POST['nonsonounpc']) ? (int) $_POST['nonsonounpc'] : 0);
        $valid = true;
        if (array_key_exists("bUsername", $_REQUEST) && !empty($_REQUEST["bUsername"]) && strlen($_REQUEST["bUsername"]) <= 100) {
            $username = $_POST['bUsername'];
        } else {
            $usernameError = 'Inserire un username';
            $valid = false;
        };
        if (array_key_exists("bPassword", $_REQUEST) && !empty($_REQUEST["bPassword"]) && strlen($_REQUEST["bPassword"]) <= 200) {
            $password = $_POST['bPassword'];
        } else {
            $passwordError = 'Inserire una password';
            $valid = false;
        };
        if (array_key_exists("bNome", $_REQUEST) && !empty($_REQUEST["bNome"]) && strlen($_REQUEST["bNome"]) <= 100) {
            $nome = $_POST['bNome'];
        } else {
            $nomeError = 'Inserire un nome';
            $valid = false;
        };
        if (array_key_exists("bCognome", $_REQUEST) && !empty($_REQUEST["bCognome"]) && strlen($_REQUEST["bCognome"]) <= 100) {
            $cognome = $_POST['bCognome'];
        } else {
            $cognomeError = 'Inserire un cognome';
            $valid = false;
        };


        if (empty($nonsonounpc) or $nonsonounpc !== 17) {
            $nonsonounpcError = "Fai la somma. Non mi dirai che sei un bot, veeeeeero????";
            $valid = false;
        }

        if ($valid) {

            try {
                $pdo = database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("SELECT Count(*) FROM UTENTI WHERE Username='$username';");
                $stmt->execute();

                if ($stmt->fetchColumn() > 0) {
                    $usernameError = "Username già preso, cercane un altro. Sei già registrato? <a class='btn btn-default bg-light' href='./login.php?username=$username'>Accedi</a>";
                } else {
                    $sql = "INSERT INTO UTENTI(Username, Password,CognomeUt,NomeUt,Privilegi) values(?,?,?,?,1)";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($username, password_hash($password, PASSWORD_DEFAULT), $cognome, $nome));
                    $registrazioneCompletata = true;
                }
                database::disconnect();
            } catch (PDOException $e) {
                echo 'Errore PDO e connessione DB: <br />';
                echo 'SQLQuery: ', $sql;
                echo 'Errore: ' . $e->getMessage();
            }
        }
    } ?>
    <?php include_once('header.php') ?>
    <title>Registrazione - EasyTrain</title>
    </head>

    <body>
        <?php include_once('nav.php') ?>
        <div class="w3-container w3-sand w3-padding-16	">
            <h1 class="w3-center">Registrazione</h1>
            <form class="w3-container" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                <label for="bUsername">Username : </label>
                <input class="w3-input" maxlength="100" type="text" placeholder="Username" name="bUsername" value="<?php echo !empty($username) ? $username : ''; ?>">
                <?php if (!empty($usernameError)) : ?>
                    <div class="w3-panel w3-border-left w3-pale-red w3-border-red">
                        <span><?php echo $usernameError; ?></span>
                    </div>
                <?php endif; ?>
                <label for="bNome">Nome : </label>
                <input class="w3-input" maxlength="100" placeholder="Marco" name="bNome" type="text" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                <?php if (!empty($nomeError)) : ?>
                    <div class="w3-panel w3-border-left w3-pale-red w3-border-red">
                        <span><?php echo $nomeError; ?></span>
                    </div>
                <?php endif; ?>
                <label for="bCognome">Cognome : </label>
                <input class="w3-input" maxlength="100" placeholder="Rossi" name="bCognome" type="text" value="<?php echo !empty($cognome) ? $cognome : ''; ?>">
                <?php if (!empty($cognomeError)) : ?>
                    <div class="w3-panel w3-border-left w3-pale-red w3-border-red">
                        <span><?php echo $cognomeError; ?></span>
                    </div>
                <?php endif; ?>
                <label for="bPassword">Password : </label>
                <input class="w3-input" maxlength="200" placeholder="******" name="bPassword" type="password" value="<?php echo !empty($password) ? $password : ''; ?>">
                <?php if (!empty($passwordError)) : ?>
                    <div class="w3-panel w3-border-left w3-pale-red w3-border-red">
                        <span><?php echo $passwordError; ?></span>
                    </div>
                <?php endif; ?>
                <label for="nonsonounpc">Controllo : </label>
                <input class="w3-input" placeholder="somma 13 a 4" name="nonsonounpc" type="text" value="<?php echo !empty($nonsonounpc) ? $nonsonounpc : ''; ?>">
                <?php if (!empty($nonsonounpcError)) : ?>
                    <div class="w3-panel w3-border-left w3-pale-red w3-border-red">
                        <span><?php echo $nonsonounpcError; ?></span>
                    </div>
                <?php endif; ?>
                <br>

                <button type="submit" class="w3-btn w3-black">Registrati</button>
            </form>
            <?php if (($registrazioneCompletata)) : ?>
                <br>
                <div class="w3-panel w3-border-left w3-pale-green w3-border-green" role="alert">
                    Ti sei registrato con successo!!! <a class='w3-btn w3-black' href='./login.php'>Accedi</a>
                </div>
            <?php endif; ?>
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
        <?php include_once('footer.php') ?>
    <?php } ?>