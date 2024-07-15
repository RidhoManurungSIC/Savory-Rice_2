<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}
    require "../login system/functions.php";
    require "../head-footer/head.php";

    $id = $_GET["id"];
    $masukan = query("SELECT * FROM pesan WHERE id = $id")[0];

    if ( $masukan["subjek"]== 1) {
        $isi_subjek = "Rasa Makanan";
      }elseif ($masukan["subjek"] == 2) {
        $isi_subjek = "Pelayanan";
      }elseif ($masukan["subjek"] == 3) {
        $isi_subjek = "Kebersihan";
      }elseif ($masukan["subjek"] == 4) {
        $isi_subjek = "Suasana";
      }else {
        $isi_subjek = "Lainnya";
      }

    if (isset($_POST["ubah_box"])) {

        if (ubah_adn($_POST) > 0 )  {
            echo "
            
                <script>
                    alert('Pesan anda berhasil diubah!');
                    document.location.href = '../forms/data-pesan.php';
                </script>
            ";
        }else {
            echo "
            
                <script>
                    alert('Pesan anda gagal diubah!');
                </script
            ";
        }    
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Update Data Menu</title>
</head>
<body>
    
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Savory Rice<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="../index.php#hero">Home</a></li>
          <li class="dropdown"><a href="#"><span>Data Referensi</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="../forms/data-user.php">Data User</a></li>
                  <li><a href="../forms/data-menu.php">Data Menu</a></li>
                  <li><a href="../forms/data-pesan.php">Data Pesan</a></li>
                </ul>
              </li>
          <li><a href="box-pmenu.php">Pesan Menu</a></li>
          <li><a href="box-paketan.php">Pesan Paket Pesta</a></li>
          <li class="dropdown"><a href="#"><span>Transaksi</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="transaksi-pm.php">Transaksi Pesanan Menu</a></li>
                  <li><a href="transaksi-p3.php">Transaksi Pesanan Paket Pesta</a></li>
                </ul>
              </li>  
          <li class="dropdown"><a href="#"><span>Laporan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="laporan-pm.php">Laporan Penjualan Menu</a></li>
                  <li><a href="laporan-p3.php">Laporan Penjualan Paket Pesta</a></li>
                </ul>
              </li>          
              <div>
          </div>
          <li><a href="input-masukan.php">Pesan</a></li>
          <li class="dropdown" style="float: right;"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li class="p-2" ><img src="../assets/img/apple-touch-icon.png" style="width: 30px; margin-right:10px;" alt="icon.png"><?= $_SESSION["user"]; ?></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <a class="btn-book-a-table me-2" href="../login system/logout.php">Logout</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <!-- form -->
  <form action="" method="post" role="form" class="d-flex flex-column bd-highlight ms-5 me-5 border border-3 rounded-2 shadow-sm" style="margin-top:100px ; padding: 30px;"  >
          <div class="row">
            <div class="col-xl-6 form-group">
              <input type="hidden" name="id" id="id" value="<?= $masukan["id"]; ?>" >
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda" value="<?= $masukan["nama"]; ?>" required  >
            </div>
            <div class="col-xl-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" value="<?= $masukan["email"]; ?>" required  >
            </div>
          </div>
          <div class="d-flex gap-2 ">
          <div class="form-group col-xl-6 mt-3 pe-3 ">
                            <select name="subjek" class="form-control" required>
                            <option selected value="<?= $masukan["subjek"]; ?>"><?= $isi_subjek?></option>
                                <option value="1">Rasa Makanan</option>
                                <option value="2">Pelayanan</option>
                                <option value="3">Kebersihan</option>
                                <option value="4">Suasana</option>
                                <option value="5">Lainnya</option>
                            </select> 
          </div>
          <div class="form-group col-xl-6 mt-3 ">
                            <select name="rating" class="form-control" required>
                            <option selected value="<?= $masukan["rating"]; ?>"><?= $masukan["rating"]; ?></option>
                                <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
                                <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                                <option value="⭐⭐⭐">⭐⭐⭐</option>
                                <option value="⭐⭐">⭐⭐</option>
                                <option value="⭐">⭐</option>
                            </select> 
          </div>
          </div>
          <div class="form-group mt-3">
            <textarea  class="form-control" name="pesan" rows="5" placeholder="pesan" required autocomplete="off" ><?= $masukan["pesan"]; ?></textarea>
          </div>
          <!-- <div><input type="file" class="form-control mt-3" name="file" id="file" placeholder="" ></div> -->
          <div class="text-center" ><button type="submit" name="ubah_box" class="btn btn-primary mt-3 col-6 mx-auto" >Kirim Pesan</button></div>
        </form><!--End Contact Form -->

</body>
</html>









<?php require "../head-footer/footer.php"; ?>
