<?php
include('db.php');

if(isset($_POST["tahun"]) && !empty($_POST["tahun"])){ 
    
    //$query = $db->query("SELECT data_content FROM laporan_gini WHERE id_provinsi = ".$_POST['provinsi']." && nama_tahun = ".$_POST['tahun']." && nama_variabel_turunan = 'perkotaan' ");
    
    //$query = $db->query("SELECT data_content FROM laporan_gini WHERE nama_tahun = ".$_POST['tahun']."");
    $query = $db->query("SELECT data_content FROM laporan_gini WHERE nama_tahun = ".$_POST['tahun']." && id_provinsi = ".$_POST['provinsi']." && nama_variabel_turunan = 'perkotaan'");

    $rowCount = $query->num_rows;
    
    if($rowCount > 0){
        while($row = $query->fetch_assoc()){ 
            echo '<h1>'.$row['data_content'].'</h1> ';
        }
    }else{
        echo '<h1>error</h1>';
    }
}
?>