<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

    require "../login system/functions.php";
    require "../head-footer/head.php";

    $id=$_POST['id'];
    $id_m=$_POST['id_m'];
    $id_pm=$_POST['id_pm'];
    $nama = ucwords(stripcslashes($_SESSION["user"]));
    $email = $_POST["email"];
    $menu = ucwords(stripcslashes($_POST["menu"]));
    $jenis_menu = $_POST["jenis_menu"];
    $harga =  $_POST["harga"];
    $jumlah =  $_POST["jumlah"];
    $m_pesanan =  $_POST["m_pesanan"];
    $m_pembayaran =  $_POST["m_pembayaran"];
    $status_pesanan =  1;
    $m_pembayaran =  $_POST["m_pembayaran"];
    $keterangan =  strtolower(stripcslashes($_POST["keterangan"]));
    $create_at="current_timestamp()";
    $update_at="current_timestamp()";
    $file = $_POST["file"];
    
    $query= "UPDATE box_pmenu
        SET
        status_pesanan = $status_pesanan 
        WHERE id = $id ;
        ";
        mysqli_query($conn, "$query");

if ($email ==  1) {
    echo "
    <script>
        alert('Silahkan Tambahkan Detile Pemesanan Dengan Menekan Tombol Ubah!!');
        document.location.href = 'box-pmenu.php';
    </script>
     "; 
}else {
    if ($m_pembayaran  == 1) {
        $file = "Bayar Di Tempat";

        $pktn = mysqli_query($conn, "INSERT INTO pesan_menu
        VALUES('','$id_m','$id_pm','$nama','$email','$menu','$jenis_menu','$harga','$jumlah' , 
        '$m_pesanan', $status_pesanan, $m_pembayaran, '$keterangan' ,'$file', $create_at, $update_at)");

        
    
    if ($pktn > 0) {
        echo "
              
         <script>
             alert('Pesanan menu anda berhasil dikirim!, Silakahkan cek status pemesanan anda!');
             document.location.href = 'box-pmenu.php';
         </script>
          ";
      } else {
        echo "
              
         <script>
             alert('Pesanan menu anda gagal dikirim!');
             document.location.href = 'box-pmenu.php';
         </script>
          ";
      }
    }else {
        if ($file == 1) {
            echo "
            <script>
                alert('Silahkan Masukan Bukti Pembayaran!');
                document.location.href = 'box-pmenu.php';
            </script>
             ";
        } else {
            $pktn_f = mysqli_query($conn, "INSERT INTO pesan_menu
            VALUES('','$id_m','$id_pm','$nama','$email','$menu','$jenis_menu','$harga','$jumlah' , 
            '$m_pesanan', $status_pesanan, $m_pembayaran, '$keterangan' ,'$file', $create_at, $update_at)");
            
        if ($pktn_f > 0) {
            echo "
             <script>
                 alert('Pesanan menu anda berhasil dikirim!,Silakahkan cek status pemesanan anda!');
                 document.location.href = 'box-pmenu.php';
             </script>
              ";
          } else {
            echo "
             <script>
                 alert('Pesanan menu anda gagal dikirim!');
                 document.location.href = 'box-pmenu.php';
             </script>
              ";
          }
        }
    }
}

    


  

  

?>