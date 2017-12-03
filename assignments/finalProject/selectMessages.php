<?php

    include '../../dbconnection.php';
    $conn = getDatabaseConnection();
    
    $sql = "SELECT *
            FROM messages ";
    
    if(isset($_GET['username'])&&$_GET['username']!=""){
        $username = $_GET['username'];
        $sql .= "WHERE username LIKE :username ";
        if(isset($_GET['text']) && $_GET['text']!=""){
            $sql .= " AND";
        }
    }
        
    if(isset($_GET['text'])&&$_GET['text']!=""){
        $text = $_GET['text'];
        if(!isset($_GET['username']) || $_GET['username']==""){
            $sql .= "WHERE";
        }
        $sql .= " text LIKE :text ";
    }
    
    $sql .= "ORDER BY timeOfPost DESC ";
    
    if(isset($username)||isset($text)){
        $namedParameters = array();
        if(isset($username)){
            $namedParameters[':username'] = "%" . $_GET['username'] . "%";
        }
        
        if(isset($text)){
            $namedParameters[':text'] = "%" . $_GET['text'] . "%";
        }
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
    } else {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    $records = $stmt->fetchAll();
    
    echo json_encode($records);

?>