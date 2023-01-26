<?php

    $conn = mysqli_connect("localhost", "root", "password", "sanjunipero");
            
    // Check connection
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    $Nome = $_REQUEST['Nome'];
    $Cognome = $_REQUEST['Cognome'];
    $Email = $_REQUEST['Email'];
    $Msg = $_REQUEST['Msg'];
    
    
    $sql = "INSERT INTO FORM VALUES ('$Nome', '$Cognome', '$Email', '$Msg')";

    if(mysqli_query($conn, $sql)){
        echo "<h3>data stored in a database successfully."
            . " Please browse your localhost php my admin"
            . " to view the updated data</h3>";

        echo nl2br("\n$first_name\n $last_name\n "
            . "$gender\n $address\n $email");
    } else{
        echo "ERROR: Hush! Sorry $sql. "
            . mysqli_error($conn);
    }

    mysqli_close($conn);
?>

