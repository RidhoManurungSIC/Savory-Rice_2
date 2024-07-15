<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}
    require "../login system/functions.php";
    require "../head-footer/head.php";

    $id = $_GET["id"];
    $menu = query("SELECT * FROM menus WHERE id_masakan = $id")[0];

   

    if (isset($_POST["submit"])) {

        if (ubah_menu($_POST) > 0 )  {
            echo "
            
                <script>
                    alert('Data menu berhasil diubah!');
                    document.location.href = '../forms/data-menu.php';
                </script>
            ";
        }else {
            echo "
            
                <script>
                    alert('Data menu gagal diubah!');
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

  <!-- card -->
  <form action="" method="post" enctype="multipart/form-data">
<div class="p-4" style="margin-top: 80px;" >
    <div class="card w-75 d-grid mx-auto">
        <h5 class="card-header">Ubah Data Menu</h5>
        <div class="card-body">
            <h5 class="card-title text-center">Form Data Menu</h5>
        <div class="row">
                      <div class="col-md-12 mt-2">
                        <input type="hidden" name="id_masakan" value="<?= $menu["id_masakan"]; ?>">
                        <input type="hidden" name="gambarlama" value="<?= $menu["gambar"]; ?>">
                        <div class="form-group mt-2">
                          <label>Nama Masakan</label>
                          <input type="text" name="nama_masakan" id="nama_masakan" class="form-control" autocomplete="off" value="<?= $menu["nama_masakan"]; ?>">
                        </div>
                        <div class="form-group mt-2">
                        <label for="">Kategoti Masakan</label>
                <select name="kategori_masakan" class="form-control" required>
                  <option selected value="<?= $menu["kategori_masakan"]; ?>"><?= $menu["kategori_masakan"]; ?></option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </select>                    
                        </div>
                        <div class="form-group mt-2">
                        <label for="">Tipe Masakan</label>
                <select name="tipe_masakan" class="form-control" required>
                  <option selected value="<?= $menu["tipe_masakan"]; ?>"><?= $menu["tipe_masakan"]; ?></option>
                    <option value="1">Appetizers</option>
                    <option value="2">Breakfast</option>
                    <option value="3">Lunch</option>
                    <option value="4">Dinner</option>
                </select>                    
                        </div>
                        <div class="form-group mt-2">
                          <label>Harga</label>
                          <input type="text" name="harga" id="harga" class="form-control" autocomplete="off" value="<?= $menu["harga"]; ?>">
                        </div>
                          <!-- <div><input type="checkbox" name="konfirmasi" id="konfirmasi"><input type="file" name="img" id="img" class="form-control"></div> -->
                          <div  class="form-group  mt-3" >
                          <label for="gambar" >Gambar</label><br>
                          <img class="mt-3 mb-3" src="../assets/img_m/<?= $menu["gambar"] ?>" alt="menu.jpg" style="width: 80px;">
                          <input type="file" name="gambar" id="gambar" class="form-control w-75 text-center mx-auto">
                          </div>
                        <div class="form-group mt-3 d-grid col-6 mx-auto" >
                        <button type="submit" name="submit" class="btn btn-primary">Ubah Data</button>
                        </div>
                      </div>
                    </div>
                  </div>
        </div>
    </div>
    </form>

</body>
</html>









<?php require "../head-footer/footer.php"; ?>
