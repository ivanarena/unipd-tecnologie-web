<?php if (strtok($_SERVER["REQUEST_URI"], '?') == '/php/session.php') {
    header("location: ../index.php");
} else { ?><?php if (session_id() == '') {
                session_start();
            }
        } 
        
        
function get_prefix(){
    return trim(file_get_contents(__DIR__ ."/../url_prefix")) ?? "";
}    
?>