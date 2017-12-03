<?php
    session_start();
    
    include '../../dbconnection.php';
    $conn= getDatabaseConnection();
    
    $username = $_POST['newusername'];
    $password = sha1($_POST['newpassword']);
    
    $sql = "INSERT INTO users
        (username, password)
        VALUES
        (:username, :password)";
    $namedParameters = array();
    $namedParameters[':password'] = $password;
    $namedParameters[':username'] = $username;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    
    $_SESSION['username']=$username;
    header("Location: index.php?error=false");
?>