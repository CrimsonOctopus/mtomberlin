<?php
include '../../dbconnection.php';
$conn = getDatabaseConnection();

$sql = "DELETE FROM messages WHERE messageId = ".$_GET['messageId'];

$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
?>