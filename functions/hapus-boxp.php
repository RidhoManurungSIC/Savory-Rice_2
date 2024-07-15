<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];

if (hapus_boxp($id) > 0) {
    echo "
            <script>
                alert('Pesanana paket pesta berhasil dihapus!');
                document.location.href = 'box-paketan.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('Pesanan paket pesta gagal dihapus!');
                document.location.href = 'box-paketan.php';
            </script>
        ";
}

?>