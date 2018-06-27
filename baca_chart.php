<?php

header('Content-Type: application/json');

require_once('simple_db.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}
$query = sprintf("SELECT * from laporan_gini");

$result = $mysqli->query($query);
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
$result->close();
$mysqli->close();
print json_encode($data);
