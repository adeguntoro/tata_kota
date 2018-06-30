<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body>
        <?php
        $get_id = $_GET['id'];
        require_once ('db.php');
        $dbName = 'tata_kota1';

        $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
            $sql = "SELECT * from provinsi where id_prov = $get_id";
            $result = $db->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $nama    = $row['nama'];
                }
            } else {
                echo "0 results";
            }

            $db->close();
        ?>
        <div class="container">
            
            <canvas id="mycanvas"></canvas>
            
        </div>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/Chart.js"></script>
        <script>
            $(document).ready(function(){
                $.ajax({
                    url     : "baca_chart.php",
                    type    : "GET",
                    success : function(data){
                        var FilterID = data.filter(function(elemment) {
                            return elemment.id_provinsi == "<?php echo $get_id ; ?>" && elemment.nama_variabel_turunan == "Perkotaan";
                        });
                        
                        if (FilterID.length == 0){
                            alert('maaf data anda kosong');
                        }
                        
                        var arr = FilterID;
                        var myJSON = JSON.stringify(arr);
                                                
                        var data_tahun      = [];
                        var data_gini       = [];
                        var nama_provinsi   = [];
                        var nama_provinsi   = [];

                        for( var i in FilterID ) {
                            data_tahun.push(FilterID[i].nama_turunan_tahun +" "+ FilterID[i].nama_tahun);
                            data_gini.push(FilterID[i].data_content);
                        }
                        
                        var chartdata = {
                            labels: data_tahun,
                            datasets: [
                                {
                                    label: "Provinsi "+"<?php echo $nama ?>",
                                    fill: false,
                                    lineTension: 0,
                                    backgroundColor: "rgba(59, 89, 152, 0.75)",
                                    borderColor: "rgba(59, 89, 152, 1)",
                                    pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                                    pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                                    data: data_gini
                                }
                            ]
                        };
                        var ctx = $( "#mycanvas" );
                        var LineGraph = new Chart( ctx, {
                            type: 'bar',
                            data: chartdata,
                            options: {
                                scales: {
                                    xAxes: [{
                                        ticks: {
                                            autoSkip: false,
                                            maxRotation: 90,
                                            minRotation: 90
                                        }
                                    }],
                                    yAxes: [{
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Rasio gini' 
                                        }
                                    }]
                                }
                            }
                        });
                        
                    }
                });
            });
        </script>
        </body>
</html>