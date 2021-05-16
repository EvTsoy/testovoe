<?php
header('Access-Control-Allow-Origin: *');
include_once '../init.php';
// $seed();

if (isset($_GET['branch_id'])) {
    $branch_id = $_GET['branch_id'];
    $statement = $conn->prepare("
    SELECT * FROM workers INNER JOIN branches ON (workers.branch_id=branches.id) WHERE branches.id = '$branch_id'
    ORDER BY first_name
    ");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);
    print(json_encode($results));
}
