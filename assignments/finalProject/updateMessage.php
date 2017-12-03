<?php
include '../../dbconnection.php';
$conn = getDatabaseConnection();

$sql = "UPDATE messages
        SET username = :username, text = :text
        WHERE messageId = :messageId";
$namedParameters = array();
$namedParameters[':text'] = $_GET['text'];
$namedParameters[':username'] = $_GET['username'];
$namedParameters[':messageId'] = $_GET['messageId'];

$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
?>