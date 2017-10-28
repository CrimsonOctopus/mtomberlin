<?php

include '../../dbconnection.php';

$conn = getDatabaseConnection();

function getProducts() {
    global $conn;
    $sql = "SELECT DISTINCT(deviceType)
            FROM `tc_device` 
            ORDER BY deviceType";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) {
        
        echo "<option> "  . $record['deviceType'] . "</option>";
        
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Group Project</title>
    </head>
    <body>
        <h1>Admin Login</h1>
        <form method="POST" action="loginProcess.php">
            Username: <input type="text" name="username"/><br>
            Password: <input type="password" name="password"/><br>
            <input type="submit" name="login" value="Login"/>
        </form>
    </body>
</html>