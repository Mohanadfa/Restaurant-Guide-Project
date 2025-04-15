
<?php
    define('servername' , 'localhost');
    define('username' , 'root');
    define('password' , '');
    $dbname = "Redb";
    $connDB = new mysqli(servername, username, password);
    $dbCreate = "CREATE DATABASE IF NOT EXISTS $dbname";
    
    if (!$connDB) die("Connection failed<br/>") ;
    //else echo "connection OK<br/>";
    if (mysqli_query($connDB, $dbCreate)) echo "";
  // echo " DB creating successfully<br/>";
    else echo "error creating DB<br/>";
    mysqli_close($connDB);
    /***** END create DB ******/
    /*** create Connection ****/
    $conn = new mysqli(servername, username, password, $dbname);
    if (!$conn) echo("Connection failed<br/>") ;
    //else echo "connection OK<br/>";
	
	/*** Create table ***/
    $sql = "CREATE TABLE IF NOT EXISTS emp(
        username VARCHAR(100),
        password VARCHAR(100),
        email VARCHAR(100))";
    $retval = mysqli_query( $conn,$sql );
    if(! $retval ) echo('Could not create table: ');
   // else echo "Table created successfully<br/>";
?>