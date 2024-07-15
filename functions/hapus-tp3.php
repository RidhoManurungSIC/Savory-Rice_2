<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];
if (hapus_tp3($id) > 0) {
    echo "
            <script>
                alert('pesanan berhasil dihapus!');
                document.location.href = 'transaksi-p3.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('pesanan gagal dihapus!');
                document.location.href = 'transaksi-p3.php';
            </script>
        ";
}

?>