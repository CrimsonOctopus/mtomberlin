<?php
include '../../dbconnection.php';
$conn = getDatabaseConnection();

$sql = "SELECT *
        FROM searchTerms";
        
$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
$records = $stmt->fetchAll();//expecting only one record

//print_r($records);

echo json_encode($records);
?>