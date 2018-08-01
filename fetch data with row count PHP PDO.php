<?php
$db = new PDO('mysql:host=localhost;dbname=your_dbname;charset=utf8', 'your_username_database', 'your_password_database');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

if(isset($_POST["provinsi"]) && !empty($_POST["tahun"])){
    try {
        $stmt = $db->prepare('SELECT data_content, nama_turunan_tahun, nama_variabel_turunan FROM laporan_gini WHERE id_provinsi = :provinsi AND nama_tahun = :tahun');
        $provinsi = $_POST["provinsi"];
        $tahun    = $_POST["tahun"];
        $stmt->execute(['provinsi' => $provinsi, 'tahun' => $tahun]);
        $row_count = $stmt->rowCount();
        if($row_count > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo $row['nama_turunan_tahun'].' = '.$row['data_content'].' untuk '.$row['nama_variabel_turunan'].'<br> ';
            }
        }else{
            echo 'Data tidak tersedia';
        }
    }
    catch(PDOException $ex) {
        echo "An Error occured!".$ex->getMessage();
    }
}
?>
