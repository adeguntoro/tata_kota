<html>
    <head>
        <meta charset="utf-8">
        <?php require_once ('header.php'); ?>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/datatables.min.css">
        <style>
            .ade {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        <?php require_once ('navbar.php'); ?>
        <div class="container ade">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Provinsi</th>
                        <th scope="col">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                require_once ('db.php');
                $dbName = 'tata_kota1';

                $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                if ($db->connect_error) {
                    die("Connection failed: " . $db->connect_error);
                }
                    $sql = "SELECT * from provinsi where id_prov <> 01";
                    $result = $db->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $id = $row['id_prov'];
                            ?>
                    <tr>
                        <td><?php echo $row['id_prov'] ?></td>
                        <td><?php echo $row['nama']?></td>
                        <td>
                            <a id="e<?php echo $id; ?>" href="lihat_chart.php<?php echo '?id='.$id; ?>" class="btn btn-success">Lihat Chart</a>
                            
                        </td>
                    </tr>
                        <?php }
                    } else {
                        echo "0 results";
                    }

                    $db->close();
                ?>
                </tbody>
            </table>
        </div>
        <?php require_once ('js.php'); ?>
        <script src="js/datatables.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
                } );
            } );
        </script>
    </body>
</html>