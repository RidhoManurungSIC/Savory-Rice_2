<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];

if (hapus_box($id) > 0) {
    echo "
            <script>
                alert('Pesan berhasil dihapus!');
                document.location.href = 'input-masukan.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('Pesan gagal dihapus!');
                document.location.href = 'input-masukan.php';
            </script>
        ";
}

?>