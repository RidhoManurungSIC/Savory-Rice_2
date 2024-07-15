<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];
if (hapus_pesan($id) > 0) {
    echo "
            <script>
                alert('Pesan berhasil dihapus!');
                document.location.href = '../forms/data-pesan.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('Pesan gagal dihapus!');
                document.location.href = '../forms/data-pesan.php';
            </script>
        ";
}

?>