<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            
        </title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <form action="" method="post" id="form">
            <?php

            require_once('db.php');
            $query = $db->query("SELECT * from provinsi where id_prov <> 01 order by nama asc");

            $rowCount = $query->num_rows;
            ?>
                <select name="provinsi" id="provinsi" >
                <option value="">Pilih Provinsi</option>
                <?php

                if($rowCount > 0){
                    while($row = $query->fetch_assoc()){ 
                        echo '<option value="'.$row['id_prov'].'">'.$row['nama'].'</option>';
                    }
                }else{
                    echo '<option value="">Ada Masalah</option>';
                }
                ?>
                </select>
                <select name="kabupaten" id="kabupaten">
                    <option>Pilih Kabupaten</option>
                </select>

                <input type="text" name="" required>

                <button type="submit" class="btn bg-success" name="kirim" id="submit">Submit</button>
                
            </form>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#provinsi').on('change',function(){
                    var provinsiID = $(this).val();
                    if(provinsiID){
                        $.ajax({
                            type:'POST',
                            url:'kecamatan.php',
                            data:'id_prov='+provinsiID,
                            success:function(html){
                                $('#kabupaten').html(html);
                                $('#kecamatan').html('<option value="">Pilih daerah terlebih dahulu</option>'); 
                            }
                        }); 
                    }else{
                        $('#kabupaten').html('<option value="">Select country first</option>');
                        $('#kecamatan').html('<option value="">Select state first</option>'); 
                    }
                });

                $('#kabupaten').on('change',function(){
                    var kabupatenID = $(this).val();
                    if(kabupatenID){
                        $.ajax({
                            type:'POST',
                            url:'kecamatan.php',
                            data:'id_kab='+kabupatenID,
                            success:function(html){
                                $('#kecamatan').html(html);
                            }
                        }); 
                    }else{
                        $('#kecamatan').html('<option value="">Select state first</option>'); 
                    }
                });
            });
        </script>
    </body>
</html>