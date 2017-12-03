<?php
    session_start();
    
    include '../../dbconnection.php';
    $conn= getDatabaseConnection();
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $namedParameters = array();
    $namedParameters[':username']=$username;
    $namedParameters[':password']=$password;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting only one record
    
    
    if(!empty($record)){
        $_SESSION['username']=$record['username'];
        $_SESSION['userFullName']=$record['firstName']." ".$record['lastName'];
        header("Location: index.php?error=false");
    } else {
        header("Location: userLogin.php?error=true");
    }
?>