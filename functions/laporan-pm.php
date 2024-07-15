<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

    require "../login system/functions.php";
    require "../head-footer/head.php";

    $pesanan = query ("SELECT * FROM pesan_menu WHERE status_pesanan = 3 ");

    $transfer = query("SELECT * FROM paketan WHERE bayar = 2");

  // search
  if (isset($_POST["cari"])) {
    $menus = cari_paket_pesta($_POST["keyword"]);
  }

    if (isset($_POST["transaksi"])) {
        $uang = $_POST["uang"];
        $tbayar = $_POST["total_bayar"];
    
        if ($uang < $tbayar ) {
            echo "
            <script>
                alert('Transaksi Gagal!');
            </script>
        ";
        }else {
            echo "
            <script>
                alert('Transaksi Berhasil!');
            </script>
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

  <!-- card + table -->
<div class="container" style="margin-top: 100px;" >
<div class="card p-2 mt-2 mx-auto">
  <div class="card-header">
    <h5>Input Transaksi Pesanan</h5>
  </div>
  <div class="card-body">

  <a href="print-laporanpm.php" target="_blank" class="text-light" ><button class="btn btn-primary btn-sm mb-3 me-4  p-2 w-25 ">Print Laporan</button></a>
  <!-- <form action="" method="post" class="d-flex bd-highlight" >
  <input class="form-control mb-3 me-4 bd-highlight flex-grow-1" type="text" placeholder="Search" aria-label="Search" style="width: 150px; float: right;" name="keyword" id="keyword" autocomplete="off" >
  <button type="submit" name="cari" class="btn btn-outline-success bd-highlight mb-3">Search</button>
</form> -->

  <div>
  <table  class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Id Pesanan</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Menu</th>
            <th scope="col">Jenis Menu</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Jenis Pesanan</th>
            <th scope="col">Jenis Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($pesanan as $data ) : ?> 
          <?php 
            if ($data["jenis_menu"]  == 1) {
              $isi_jm = "Appetizers";
            } elseif ($data["jenis_menu"]  == 2) {
              $isi_jm = "Breakfast";
            }elseif ($data["jenis_menu"] == 3) {
              $isi_jm = "Lunch";
            }else {
              $isi_jm = "Dinner";
            }
            
            if ($data["m_pesanan" ] == 1) {
              $isim = "Makan Di Tempat";
            }else {
              $isim = "Bawa Pulang";
            }
            
            if ($data["status_pesanan"]  == 1) {
              $isis = "Di kirim";
            }elseif ($data["status_pesanan"] == 2) {
              $isis = "Di Proses";
            }elseif ($data["status_pesanan"] == 3) {
              $isis = "Di Terima";
            }else {
              $isis = "Belum Di Kirim";
            }
        
            if ($data["m_pembayaran"] == 1) {
              $isip = "Tunai";
            }else {
              $isip = "Transfer";
            }
            ?>

            <tr>
                <td scope="row"><?= $i; ?></td>
                <td><?= $data["id_pm"]?></td>
                <td><?= $data["nama"]?></td>
                <td><?= $data["email"]?></td>
                <td><?= $data["menu"]?></td>
                <td><?= $isi_jm;?></td>
                <td><?= $data["harga"]?></td>
                <td><?= $data["jumlah"]?></td>
                <td><?= $isim;?></td>
                <td><?= $isip;?></td>
                <td><?= $isis;?></td>
                <td>
                  <div>
                    <button class="btn btn-sm btn-success ms-2 me-2"><a href="print-pm.php?id=<?= $data["id"];?>" target="_blank" class="text-light">print</a></button>
                  </td>
                  
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
</div>
    </div>
  </div>
    <!-- card + table end -->











<?php require "../head-footer/footer.php"; ?>