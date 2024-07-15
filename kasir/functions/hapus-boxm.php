<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../../login system/login.php");
  exit;
}

require "../../login system/functions.php";

$id = $_GET["id"];

if (hapus_boxm($id) > 0) {
    echo "
            <script>
                alert('Pesanana menu berhasil dihapus!');
                document.location.href = 'box-pmenu.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('Pesanan menu gagal dihapus!');
                document.location.href = 'box-pmenu.php';
            </script>
        ";
}

?>