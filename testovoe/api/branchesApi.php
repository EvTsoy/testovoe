<?php
header('Access-Control-Allow-Origin: *');
include_once '../init.php';
// $seed();

$statement = $conn->prepare("SELECT * FROM branches");
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
print(json_encode($results));
