<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";

$id = $_GET["id"];
if (hapus_user($id) > 0) {
    echo "
            <script>
                alert('user berhasil dihapus!');
                document.location.href = '../forms/data-user.php';
            </script>
        ";
}else {
    echo "
            <script>
                alert('data gagal dihapus!');
                document.location.href = '../forms/data-user.php';
            </script>
        ";
}

?>