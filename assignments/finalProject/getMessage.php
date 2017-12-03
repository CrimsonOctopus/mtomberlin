<?php

    include '../../dbconnection.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT *
            FROM messages WHERE messageId = :messageId";
            
    $namedParameters = array();
    $namedParameters[':messageId'] = $_GET['messageId'];
        
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting only one record
    
    echo json_encode($record);

?>