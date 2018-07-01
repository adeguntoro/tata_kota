<?php

include('db.php');

if(isset($_POST["id_prov"]) && !empty($_POST["id_prov"])){
    $query = $db->query("SELECT * FROM kabupaten WHERE id_prov = ".$_POST['id_prov']." ORDER BY nama ASC");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">Pilih Kabupaten</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option name="'.$row['id_kab'].'" value="'.$row['id_kab'].'">'.$row['nama'].'</option>';
        }
    }else{
        echo '<option value="">Kabupaten Tidak Tersedia</option>';
    }
}

?>