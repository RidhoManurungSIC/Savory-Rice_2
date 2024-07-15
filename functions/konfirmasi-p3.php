<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];


if (konfirmasip3($id) > 0) {
    echo "
            <script>
                alert('Pesanana paket pesta berhasil dikonfirmasi!');
                document.location.href = 'transaksi-p3.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('Pesanan paket pesta gagal dikonfirmasi!');
                document.location.href = 'transaksi-p3.php';
            </script>
        ";
}

?>