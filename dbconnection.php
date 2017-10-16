<?php
function getDatabaseConnection(){
    $host = 'us-cdbr-iron-east-05.cleardb.net';//cloud 9
    $dbname = 'heroku_0f5cc24af187a3f';
    $username = 'b3d9df8340a3c9';
    $password = '8f3e3255';
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    return $dbConn;
}
?>