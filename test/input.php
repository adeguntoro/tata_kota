<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    </head>
    <body>
        <div class="container">
            <h1 class="text-center">Input Raw Data</h1>
            <hr>
            <form action="input_data.php" method="post" id="myform">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Provinsi</label>
                    <div class="col-sm-8">
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
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-8">
                        <select id="tahun" name="tahun"></select>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Gini Rasio</label>
                    <div class="col-sm-8">
                        <p id="gini-rasio"></p>
                    </div>
                </div>
                
            </form>
        </div>
    </body>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#tahun').on('change',function(){
                var tahunID = $(this).val();
                if(tahunID){
                    $.ajax({
                        type:'POST',
                        url:'test2.php',
                        data:'tahun='+tahunID,
                        success:function(html){
                            $('#gini-rasio').html(html);
                        }
                    }); 
                } else {
                    $('#kecamatan').html('<option value="">Select state first</option>'); 
                }
            });
        });
    </script>
    <script>
        // Source : http://jsfiddle.net/t8fdh/ and https://stackoverflow.com/questions/19731767/to-generate-years-automatically-in-javascript-dropdown
        var min = 2000,
        max = new Date().getFullYear(),
        select = document.getElementById('tahun');
        
        for (var i = min; i<=max; i++){
            var opt = document.createElement('option');
            opt.value = i;
            opt.innerHTML = i;
            select.appendChild(opt);
        }
        
        //select.value = new Date().getFullYear();
    </script>
</html>
