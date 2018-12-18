<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Introduction · Bootstrap</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/datatables.min.css">
        <link rel="stylesheet" href="assets/style.css">
        <style>
            .css-serial {
              counter-reset: serial-number;  /* Set the serial number counter to 0 */
            }

            .css-serial td:first-child:before {
              counter-increment: serial-number;  /* Increment the serial number counter */
              content: counter(serial-number);  /* Display the counter */
            }
            .batas-atas{
                padding-top: 25px;
            }
            .bootbox .modal-header{ /* untuk bootbox agar kembali dengan normal di BS4, hal ini dikarenakan BB beelum support BS4 */
                display: block;
            }
        </style>
    </head>
    <body>    
        <?php require 'assets/header.php';?>
        <div class="container-fluid">
            <div class="row flex-xl-nowrap">
                <?php require 'assets/sidebar.php';?>
                <main class="col-12 col-md-9 col-xl-8 py-md-3 pl-md-5 bd-content" role="main">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Provinsi</h5>
                            <table class="table css-serial" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Provinsi</th>
                                        <th scope="col">ID Provinsi</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'db_pdo.php';
                                    $dbh->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, TRUE);
                                    $stmt = $dbh->query('SELECT * from provinsi where id_prov <> 1 order by nama');
                                    while ($row = $stmt->fetch()) { ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $row['nama']; ?></td>
                                        <td><?php echo $row['id_prov']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-warning" target="_blank">Edit</a>
                                            <button type="button" class="btn-hapus btn btn-danger" id="hapusdata" value="">Hapus</button>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Data Provinsi</h5>
                            <table class="table css-serial" id="example1">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Provinsi</th>
                                        <th scope="col">ID Provinsi</th>
                                        <th scope="col">ID Kabupaten</th>
                                        <th scope="col">Opsi 1</th>
                                        <th scope="col">Opsi 2</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    
                </main>
            </div>
        </div>
        <script src="assets/js/jquery-3.3.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/datatables.js"></script>
        <script src="assets/js/bootbox.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#example').DataTable({
                    "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]]
                });
                
                $('#example1').DataTable ({
                    ajax: {
                        url     : "defer_kabupaten.php",
                        dataSrc : ""
                    },
                    columns: [
                        {
                            "data": null,
                            "defaultContent": "",
                            "targets": -1
                        },
                        { data: "prov_nama" },
                        { data: "kab_nama" },
                        { 
                            data: "id_kab",
                            "visible": false,
                            "searchable": false
                        }, {
                            data: null,
                            className: "center",
                            defaultContent: '<a href="" class="btn btn-warning editor_edit" target="_blank">Edit</a>'
                        }, {
                            data: null,
                            className: "center",
                            defaultContent: '<a href="" class="btn btn-danger editor_remove" target="_blank">Hapus</a>'
                        }
                    ],
                    deferRender: true,
                    responsive: true,
                    lengthMenu: [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]]
                });
                
                $('#example1').on('click', 'a.editor_edit', function (e) {
                    e.preventDefault();
                    var currentRow = $(this).closest("tr");
                    var col1 = currentRow.find("td:eq(1)").html(); //https://codepedia.info/editor-example/jquery-read-html-table-contained-html-element-div-span-data-example/
                    var data = col1;
                    alert(data);
                });

                $('#example1').on('click', 'a.editor_remove', function (e) {
                    e.preventDefault();
                    var currentRow  = $(this).closest("tr");
                    var col1        = currentRow.find("td:eq(2)").html();
                    var data2       = col1;
                    var el = this;
                    bootbox.dialog({
                        title: "Hapus data gini",
                        message: "Apakah anda ingin menghapus data IGI ?",
                        buttons: {
                            success: {
                                label: "Tidak",
                                className: "btn-success",
                                callback: function() {
                                    $('.bootbox').modal('hide');
                                }
                            },
                            dialog: {
                                label: "Hapus !",
                                className: "btn-danger",
                                callback: function() {
                                    $.ajax({
                                        url: 'delete.php',
                                        type: 'POST',
                                        data: { hapus : data2 }
                                    }).done(function(response){
                                        bootbox.alert(response);
                                        $(el).closest('tr').fadeOut(100, function(){
                                            $(this).remove();
                                        });
                                    }).fail(function(){
                                        bootbox.alert('Error....');
                                    })
                                }
                            }
                        }, callback: function (result) {
                            console.log('This was logged in the callback: ' + result);
                        }
                    });
                });
                
                function addRowCount(tableAttr) {
                    $(tableAttr).each(function(){
                        $('th:first-child, thead td:first-child', this).each(function(){
                            var tag = $(this).prop('tagName');
                            $(this).before('<'+tag+'>#</'+tag+'>');
                        });
                        $('td:first-child', this).each(function(i){
                            $(this).before('<td>'+(i+1)+'</td>');
                        });
                    });
                }
                addRowCount('.js-serial');
            });
        </script>
    </body>
</html>
