<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

    require "../login system/functions.php";
    require "../head-footer/head.php";

    $box_pmenu = query ("SELECT * FROM box_pmenu");

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
    <h5>Pesanan Menu Anda</h5>
  </div>
  <div class="card-title">
    <button type="button" class="btn btn-primary m-3 p-2" ><a href="../index.php#menu" class="text-light" >Tambah Pesan Menu</a> </button>
  </div>
  <div class="card-body">
  <div >
<table  class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Menu</th>
            <th scope="col">Jenis Menu</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Jenis Pesanan</th>
            <th scope="col">Status</th>
            <th scope="col">Pembayaran</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
      <tbody>
    <?php $i = 1; ?>
    <?php foreach ($box_pmenu as $data ) : ?> 
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
                <td scope="row"><?= $i?></td>
                <td><?= $data["nama"]?></td>
                <td><?= $data["menu"]?></td>
                <td><?= $isi_jm?></td>
                <td><?= $data["harga"]?></td>
                <td><?= $data["jumlah"]?></td>
                <td><?= $isim?></td>
                <td><?= $isis?></td>
                <td><?= $isip?></td>
                <td><?= $data["keterangan"]?></td>
                <td>
                  <div class="d-flex flex-column m-2" >
                    <button name="ubah" class="btn btn-sm btn-success ms-2 me-2"><a href="ubah-pmenu.php?id=<?= $data["id"]?>" class="text-light">Ubah</a></button>
                    <button type="button" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Yakin ingin menghapus pesan ini ?');">
                      <a href="hapus-boxm.php?id=<?= $data["id"]?>" class="text-light" >Hapus</a></button>
                      
    <form action="tambah-pmenu.php"  method="post" class="ms-2 mt-2">
      <input type="hidden" name="id" id="id" value="<?= $data["id"]?>" >
      <input type="hidden" name="id_m" id="id_m" value="<?= $data["id_m"]?>" >
      <input type="hidden" name="id_pm" id="id_pm" value="<?= $data["id_pm"]?>" >
      <input type="text" hidden name="nama" class="form-control" id="nama"value="<?= $data["nama"]; ?>" required  >
      <input type="email" hidden class="form-control" name="email" id="email"value="<?= $data["email"]; ?>" required  >
      <input type="text" hidden name="menu" class="form-control" id="menu"value="<?= $data["menu"]; ?>" required  >
      <input type="text" hidden name="jenis_menu" class="form-control" id="jenis_menu"value="<?= $data["jenis_menu"]; ?>" required  >
      <input type="number" hidden class="form-control" name="harga" id="harga"value="<?= $data["harga"]; ?>" required  >
      <input type="number" hidden class="form-control" name="jumlah" id="jumlah"value="<?= $data["jumlah"]; ?>" required  >
      <input type="text" hidden class="form-control" name="m_pesanan" id="m_pesanan"value="<?= $data["m_pesanan"]; ?>" required  >
      <input type="text" hidden name="status_pesanan" class="form-control" id="status_pesanan" value="<?= $data["status_pesanan"]; ?>" required  >
      <input type="text" hidden name="m_pembayaran" class="form-control" id="m_pembayaran" value="<?= $data["m_pembayaran"]; ?>" required  >
      <textarea  class="form-control" hidden name="keterangan" rows="5"><?= $data["keterangan"]; ?></textarea>
      <input type="text" hidden name="file" class="form-control" id="file" value="<?= $data["file"]; ?>" required  >
      <button type="submit" name="kirim" class="btn btn-sm btn-primary text-light"    onclick="return confirm('Yakin ingin memesan menu seperti ini ?');">Proses</button>
    </form>
    </div>
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



  



<?php require "../head-footer/footer.php"; ?>