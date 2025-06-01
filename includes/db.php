<?php
// Database Pre-requisites
$host = "localhost";
$db_name = "openquotes";
$db_user = "root";
$db_pass = "";

try{
    // Establish connection
    $dsn = "mysql:host=$host;dbname=$db_name";
    $conn = new PDO($dsn, $db_user, $db_pass);

} catch(PDOException $err) {
    // Check connection
    echo "Database Connection Failed. ". $err->getMessage();
    exit();
}
?>