<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];


if (konfirmasipm($id) > 0) {
    echo "
            <script>
                alert('Pesanana menu anda berhasil dikonfirmasi!');
                document.location.href = 'transaksi-pm.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('Pesanan menu anda gagal dikonfirmasi!');
                document.location.href = 'transaksi-pm.php';
            </script>
        ";
}

?>