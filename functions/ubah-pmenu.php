<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

    require "../login system/functions.php";
    require "../head-footer/head.php";

    $id = $_GET["id"];
    $box_pmenu = query("SELECT * FROM box_pmenu WHERE id = $id")[0];

    if ($box_pmenu["jenis_menu"]  == 1) {
        $isi_jm = "Appetizers";
      } elseif ($box_pmenu["jenis_menu"]  == 2) {
        $isi_jm = "Breakfast";
      }elseif ($box_pmenu["jenis_menu"] == 3) {
        $isi_jm = "Lunch";
      }else {
        $isi_jm = "Dinner";
      }
      
      if ($box_pmenu["m_pesanan" ] == 1) {
        $isim = "Makan Di Tempat";
      }else {
        $isim = "Bawa Pulang";
      }
      
      if ($box_pmenu["status_pesanan"]  == 1) {
        $isis = "Di kirim";
      }elseif ($box_pmenu["status_pesanan"] == 2) {
        $isis = "Di Proses";
      }elseif ($box_pmenu["status_pesanan"] == 3) {
        $isis = "Di Terima";
      }else {
        $isis = "Belum Di Kirim";
      }
  
      if ($box_pmenu["m_pembayaran"] == 1) {
        $isip = "Tunai";
      }else {
        $isip = "Transfer";
      }

      if (isset($_POST["umenu"])) {

        if (ubah_boxm($_POST) > 0 )  {
            echo "
                <script>
                    alert('Pesanan menu anda berhasil diubah!');
                    document.location.href = 'box-pmenu.php';
                </script>
            ";
        }else {
            echo "
            
                <script>
                    alert('Pesanan menu anda gagal diubah!');
                </script
            ";
        }    
    }
?>


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
        <h5 class="card-header">Ubah Data Pesanan Menu</h5>
        <div class="card-body">
            <h5 class="card-title text-center">Form Data Pemesanan Menu</h5>
        <div class="row">
                      <div class="col-md-12 mt-2">
                        <input type="hidden" name="id" value="<?= $box_pmenu["id"]; ?>">
                        <div class="row">
                        <div class="form-group col-md-4 mt-2">
                          <label>Nama</label>
                          <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?= $box_pmenu["nama"]; ?>">
                        </div>
                        <div class="form-group col-md-4 mt-2">
                          <label>Email</label>
                          <input type="email" name="email" id="email" class="form-control" autocomplete="off"?>
                        </div>
                        <div class="form-group col-md-4" style="margin-top: 35px;" >
                          <label>Menu Anda : <?= $box_pmenu["menu"]; ?></label>
                        </div>
                        </div>
                        
                        <div class="row">
                        <div class="form-group mt-2">
                        <label for="">Menu</label>
                <select name="menu" class="form-control" required>
                  <option selected value="<?= $box_pmenu["id_m"]; ?>"><?= $box_pmenu["menu"]; ?></option>
                    <option value="1">Selada Khas Banjar</option>
                    <option value="2">Otak Otak Khas Melayu</option>
                    <option value="3">Salad Nusantara</option>
                    <option value="4">Strawberry Salad Drink</option>
                    <option value="5">Fruit Salad Jelly Drink</option>
                    <option value="6">Fresh Fruit With Calamansi Juice</option>
                    <option value="7">Bubur Ayam</option>
                    <option value="8">Nasi Uduk</option>
                    <option value="9">Soto</option>
                    <option value="10">Lemon Water</option>
                    <option value="11">Ginger Tea</option>
                    <option value="12">Breakfast Blend Coffe</option>
                    <option value="13">Beff Teriyaki</option>
                    <option value="14">Salad Ayam</option>
                    <option value="15">Tempura Udang</option>
                    <option value="16">Cendol Ice</option>
                    <option value="17">Milkshake Banana Split</option>
                    <option value="18">Energy Smoothie</option>
                    <option value="19">Spageti Carbonara</option>
                    <option value="20">Baked Salmon</option>
                    <option value="21">Pesto Chicken Baked</option>
                    <option value="22">Iced Milk Coffe</option>
                    <option value="23">Teh Tarik</option>
                    <option value="24">Iced Dawet</option>
                </select>       
                        </div>

                        <div class="form-group col-md-4 mt-2">
                          <label>Harga Menu Awal</label>
                          <input type="text" disabled class="form-control" autocomplete="off" value="<?= $box_pmenu["harga"]; ?>">
                        </div>

                        <div class="form-group col-md-4 mt-2">
                          <label>Jumlah</label>
                          <input type="number" name="jumlah" id="jumlah" class="form-control" autocomplete="off" value="<?= $box_pmenu["jumlah"]; ?>">
                        </div>

                        <div class="form-group col-md-4 mt-2">
                        <label for="">Jenis Pesanan</label>
                <select name="m_pesanan" class="form-control" required>
                  <option selected value="<?= $box_pmenu["m_pesanan"]; ?>"><?= $isim; ?></option>
                    <option value="1">Makan Di Tempat</option>
                    <option value="2">Bawa Pulang</option>
                </select>                    
                        </div>

                        <div class="form-group col-md-6 mt-2">
                        <label for="">Pembayaran</label>
                <select name="m_pembayaran" class="form-control" required>
                  <option selected value="<?= $box_pmenu["m_pembayaran"]; ?>"><?= $isip; ?></option>
                    <option value="1">Tunai</option>
                    <option value="2">Transfer</option>
                </select>                    
                        </div>

                        <div class="form-group col-md-6 mt-2">
                          <label>Bukti Pembayaran <i><b>(Transfer)</b></i></label>
                          <input type="file" name="file" id="file" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group col-md-12 mt-2">
                          <label>Keterangan</label>
                          <textarea  class="form-control" name="keterangan" rows="5" placeholder="keterangan" required autocomplete="off" ><?= $box_pmenu["keterangan"]; ?></textarea>
                          </div>
                          </div>

                        <div class="form-group mt-3 d-grid col-6 mx-auto" >
                        <button type="submit" name="umenu" class="btn btn-primary">Ubah Pesanan Menu</button>
                        </div>
                      </div>
                    </div>
                  </div>
        </div>
    </div>
    </form>
  

    

    <?php require "../head-footer/footer.php"; ?>
