<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];
if (hapus_menu($id) > 0) {
    echo "
            <script>
                alert('Menu berhasil dihapus!');
                document.location.href = '../forms/data-menu.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('Menu gagal dihapus!');
                document.location.href = '../forms/data-menu.php';
            </script>
        ";
}

?>