<?php

$host = 'localhost';//cloud 9
$dbname = 'tcp';
$username = 'root';
$password = '';
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

function getUsersAndDepartments() {
    global $dbConn;
    
    $sql = "SELECT firstName, lastName FROM `tc_user`
            INNER JOIN tc_checkout
            ON tc_user.userId = tc_checkout.userId
            INNER JOIN tc_device
            ON tc_checkout.deviceId = tc_device.deviceId
            WHERE deviceType = 'Tablet'";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);
    foreach ($records as $record) {
        
        echo $record['firstName'] . '  ' . $record['lastName'] .  '  ' . $record['deptName'] . "<br />";
        
    }
    
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>SQL Joins </title>
    </head>
    <body>

        <h2> Users who checked out tablets: </h2>

        <?=getUsersAndDepartments()?>


    </body>
</html>