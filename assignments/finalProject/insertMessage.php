<?php
include '../../dbconnection.php';
$conn = getDatabaseConnection();

$sql = "INSERT INTO messages
        (username, text)
        VALUES
        (:username, :text)";
$namedParameters = array();
$namedParameters[':text'] = $_GET['text'];
$namedParameters[':username'] = $_GET['username'];

$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
?>