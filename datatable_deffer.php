<?php

header('Content-Type: application/json');

require_once('simple_db.php');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
  die("Connection failed: " . $mysqli->error);
}

$query = sprintf("select kabupaten.id_kab, kecamatan.id_kab, kecamatan.nama AS kec_nama, kabupaten.nama AS kab_nama from kecamatan inner join kabupaten on  kabupaten.id_kab = kecamatan.id_kab");

$result = $mysqli->query($query);
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
$result->close();
$mysqli->close();
print json_encode($data);
