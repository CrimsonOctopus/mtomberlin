<?php
include '../../dbconnection.php';
$conn = getDatabaseConnection();

$sql = "INSERT INTO searchTerms
        (term)
        VALUES
        (:term)";
$namedParameters = array();
$namedParameters[':term'] = $_GET['term'];

$stmt = $conn->prepare($sql);
$stmt->execute($namedParameters);
?>