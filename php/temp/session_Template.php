
<?php if (strtok($_SERVER["REQUEST_URI"], '?') == '/EasyTrain/session.php') {
    header("location: ./index.php");
} else { ?><?php if (session_id() == '') {
                session_start();
            }
        } ?>
