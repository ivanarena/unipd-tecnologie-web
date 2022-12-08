<?php require_once("session.php");
if (!isset($_SESSION["loggato"])) {
    header("location: ./login.php");
} else {  ?>
    <?php require_once('header.php'); ?>
    <title>Index</title>
    </head>

    <body>
        <?php require_once('nav.php'); ?>
        <div class="w3-container w3-sand w3-padding-16">
            <h1 class="w3-center">Lista dei Film</h1>
            <div class="w3-container w3-sand w3-padding-16">
                <?php if (array_key_exists("ordina", $_GET) && $_GET["ordina"] == "si") {
                    echo '<a class="w3-right w3-btn w3-black" href="./index.php">Non ordinare</a>';
                } else {
                    echo '<a class="w3-right w3-btn w3-black" href="./index.php?ordina=si" >Ordina (Query a)</a>';
                } ?>
            </div>
            <?php
            require_once("database.php");
            $pdo = database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $sql = "SELECT * FROM FILM;";
            if (array_key_exists("ordina", $_REQUEST) && !empty($_REQUEST["ordina"]) && $_REQUEST["ordina"] === "si") {
                $sql = "SELECT * FROM FILM ORDER BY FILM.NomeGen, FILM.AnnoProd";
            }

            $contatore = 3;
            foreach ($pdo->query($sql)->fetchAll() as $film) {
                if ($contatore == 3) {
                    echo '<div class="w3-row-padding">';
                    $contatore = $contatore - 1;
                }
                echo '
                    <div class="w3-third w3-container w3-margin-bottom "><div class="ombra">
                        <video width="100%" height:"auto"; controls poster="' . $film["ImgPostFilm"] . '" style="height:250px; background-color:black;">
                        <source src="' . $film["UrlTrailer"] . '" type="video/mp4" >
                            Your browser does not support the video tag or the file format of this video.
                        </video>
                        <a href="./film.php?TitoloFilm=' . urlencode($film["TitoloFilm"])
                    . '">
                            <div class="w3-container w3-white">
                                <p><b>' . $film["TitoloFilm"] . '</b></p>
                                <p>Genere: ' . $film["NomeGen"] . '</p>
                                <p>Anno Produzione: ' . $film["AnnoProd"] . '</p>
                                <p>Durata: ' . $film["Durata"] . ' min</p>
                            </div>
                        </a></div><div><a class="w3-button w3-black" href="./film.php?TitoloFilm=' . urlencode($film["TitoloFilm"])
                    . '">Guarda</a>';
                if (isset($_SESSION["loggato"]) && $_SESSION["loggato"] == 2) {
                    echo '<a class="w3-button w3-black" href="./update.php?TitoloFilm=' . urlencode($film["TitoloFilm"])
                        . '">Modifica</a><a class="w3-button w3-black" href="./delete.php?TitoloFilm=' . urlencode($film["TitoloFilm"])
                        . '">Cancella</a>';
                }
                echo '</div></div>';
                if ($contatore == 0) {
                    echo '</div>';
                    $contatore = 3;
                }
            }
            database::disconnect();
            ?>
        </div>
        </div>

        <?php include_once('footer.php'); ?><?php } ?>