<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

    require "../login system/functions.php";
    require "../head-footer/head.php";

    $id=$_POST['id'];
    $id_p=$_POST['id_p'];
    $akun = ucwords(stripcslashes($_SESSION["user"]));
    $nama = ucwords(stripcslashes($_POST["nama"]));
    $email = strtolower(stripcslashes($_POST["email"]));
    $nohp = $_POST["nohp"];
    $tanggal =  $_POST["tanggal"];
    $jam =  $_POST["jam"];
    $orang =  $_POST["orang"];
    $keterangan =  strtolower(stripcslashes($_POST["keterangan"]));
    $status =  1;
    $bayar =  $_POST["bayar"];
    $jpaketan =  $_POST["jpaketan"];
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";
    $file = $_POST["file"];
    
    $query= "UPDATE box_paketan
        SET
        status = $status 
        WHERE id = $id ;
        ";
        mysqli_query($conn, "$query");

    if ($bayar == 1) {
        $file = "Bayar Di Tempat";

        $pktn = mysqli_query($conn, "INSERT INTO paketan
        VALUES('', '$id_p', '$akun','$nama','$email','$nohp','$tanggal','$jam', '$orang' , 
        '$keterangan', $status, $bayar, $jpaketan , '$file' , $create_at, $update_at)");

        
    
    if ($pktn > 0) {
        echo "
              
         <script>
             alert('Pesanan paket pesta anda berhasil dikirim!, Silakahkan cek status pemesanan anda');
             document.location.href = 'box-paketan.php';
         </script>
          ";
      } else {
        echo "
              
         <script>
             alert('Pesanan paket pesta anda gagal dikirim!');
             document.location.href = 'box-paketan.php';
         </script>
          ";
      }
    }else {
        if (empty($file)) {
            echo "
            <script>
                alert('Silahkan Masukan Bukti Pembayaran');
                document.location.href = 'box-paketan.php';
            </script>
             ";
        } else {
            $pktn_f = mysqli_query($conn, "INSERT INTO paketan
            VALUES('','$id_p','$akun','$nama','$email','$nohp','$tanggal','$jam', '$orang' , 
            '$keterangan', $status, $bayar, $jpaketan , '$file' , $create_at, $update_at)");
        
        if ($pktn_f > 0) {
            echo "
             <script>
                 alert('Pesanan paket pesta anda berhasil dikirim!,Silakahkan cek status pemesanan anda');
                 document.location.href = 'box-paketan.php';
             </script>
              ";
          } else {
            echo "
             <script>
                 alert('Pesanan paket pesta anda gagal dikirim!');
                 document.location.href = 'box-paketan.php';
             </script>
              ";
          }
        }
    }


  

  

?>