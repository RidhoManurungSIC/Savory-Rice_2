<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../../login system/login.php");
  exit;
}

    require "../../login system/functions.php";
    require "../head-footer/head.php";

    $user = ucwords(stripcslashes($_SESSION["user"]));
    $id=$_POST['id'];
    $nama=ucwords(stripcslashes($_POST['nama']));
    $email=strtolower(stripcslashes($_POST['email']));
    $subjek=$_POST['subjek'];
    $rating=$_POST['rating'];
    $pesan=strtolower(stripcslashes($_POST['pesan']));
    $status =  3;
    $file = "";
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";

    $psn = mysqli_query($conn, "INSERT INTO pesan
    VALUES('','$user','$nama','$email','$subjek','$rating','$pesan', $status, '$file',  $create_at, $update_at)");

  

  if ($psn > 0) {
    echo "
          
     <script>
         alert('Pesan anda berhasil dikirim!');
         document.location.href = 'input-masukan.php';
     </script>
      ";
  } else {
    echo "
          
     <script>
         alert('Pesan anda gagal dikirim!');
         document.location.href = 'input-masukan.php';
     </script>
      ";
  }

?>