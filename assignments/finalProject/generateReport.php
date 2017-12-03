<?php

    include '../../dbconnection.php';
    $conn = getDatabaseConnection('forum');
    
    if(isset($_GET['type'])){
        switch($_GET['type']){
            case "count":
                if(isset($_GET['startDate']) && isset($_GET['endDate'])){
                    $startDate = $_GET['startDate'];
                    $endDate = $_GET['endDate'];
                    $sql = "SELECT COUNT(messageId) FROM messages WHERE timeOfPost > :startDate AND timeOfPost < :endDate";
                    
                    $namedParameters = array();
                    $namedParameters[':startDate'] = $startDate;
                    $namedParameters[':endDate'] = $endDate;
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->execute($namedParameters);
                    $record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting only one record
                    echo json_encode($record);
                }
                break;
            case "joined":
                if(isset($_GET['selectedUsername'])){
                    $username = $_GET['selectedUsername'];
                    $sql = "SELECT MIN(timeOfPost) FROM messages WHERE username = :username";
                    
                    $namedParameters = array();
                    $namedParameters[':username'] = $username;
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->execute($namedParameters);
                    $record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting only one record
                    echo json_encode($record);
                }
                break;
            case "last":
                if(isset($_GET['selectedUsername'])){
                    $username = $_GET['selectedUsername'];
                    $sql = "SELECT MAX(timeOfPost) FROM messages WHERE username = :username";
                    
                    $namedParameters = array();
                    $namedParameters[':username'] = $username;
                    
                    $stmt = $conn->prepare($sql);
                    $stmt->execute($namedParameters);
                    $record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting only one record
                    echo json_encode($record);
                }
                break;
        }
    }

?>