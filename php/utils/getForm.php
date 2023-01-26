<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
 
<body>
        <?php
 
        // servername => localhost
        // username => root
        // password => empty
        // database name => staff
        $conn = mysql_connect("127.0.0.1", "root", "password", "sanjunipero");
         
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysql_connect_error());
        }
         
        // Taking all 5 values from the form data(input)
        $Nome =  $_REQUEST['Nome'];
        $Cognome = $_REQUEST['Cognome'];
        $Email =  $_REQUEST['Email'];
        $Msg = $_REQUEST['Msg'];
         
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO FORM  VALUES ('$Nome',
            '$Cognome','$Email','$Msg')";
         
        if(mysql_query($conn, $sql)){
            echo "<h3>data stored in a database successfully."
                . " Please browse your localhost php my admin"
                . " to view the updated data</h3>";
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysql_error($conn);
        }
         
        // Close connection
        mysql_close($conn);
        ?>
</body>
 
</html>