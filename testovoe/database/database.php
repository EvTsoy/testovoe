<?php

define("DB", "mysql:host=db;dbname=testovoe");
define("USERNAME", "root");
define("PASSWORD", "password");

$options = array(PDO::ATTR_PERSISTENT => true);

try{
    $conn = new PDO(DB, USERNAME, PASSWORD, $options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connection successful";

}catch (PDOException $ex){
    echo "A database error occurred ".$ex->getMessage();
}
