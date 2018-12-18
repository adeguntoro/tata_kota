<?
require_once 'db_pdo.php';

$id_hapus = $_POST['hapus'];

$order = $dbh->prepare('DELETE FROM kabupaten WHERE nama = '$id_hapus'');

$order->execute();

if($order->execute()){
    echo "Data Berhasil di hapus";
} else {
    echo "Maaf, gagal";
}
?>