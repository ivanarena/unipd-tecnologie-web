<?php if (strtok($_SERVER["REQUEST_URI"], '?') == '/php/session.php') {
    header("location: ../index.php");
} else { ?><?php if (session_id() == '') {
                session_start();
            }
        } ?>