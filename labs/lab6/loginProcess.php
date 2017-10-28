<?php
    session_start();
    
    include '../../dbconnection.php';
    $conn= getDatabaseConnection();
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    //$sql = "SELECT * FROM tc_admin WHERE username = '$username' AND password = '$password'";
    //named parameters
    $sql = "SELECT * FROM tc_admin WHERE username = :username AND password = :password";
    $namedParameters = array();
    $namedParameters[':username']=$username;
    $namedParameters[':password']=$password;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $record = $stmt->fetch(PDO::FETCH_ASSOC);//expecting only one record
    
    if(empty($record)){
        header("Location: index.php?error=true");
    } else {
        $_SESSION['username']=$record['username'];
        $_SESSION['adminFullName']=$record['firstName']." ".$record['lastName'];
        header("Location: admin.php?error=true");
    }
?>