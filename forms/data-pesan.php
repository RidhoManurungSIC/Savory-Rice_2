<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}
    require "../login system/functions.php";
    require "../head-footer/head.php";

  // pagination
  $jumlahDataPerhalaman = 10;
  $jumlahdata = count(query("SELECT * FROM pesan"));
  $jumlahHalaman = ceil($jumlahdata / $jumlahDataPerhalaman);
  $hamalanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
  $awalData = ($jumlahDataPerhalaman * $hamalanAktif) - $jumlahDataPerhalaman;

  $pesan = query ("SELECT pesan.id,pesan.pengguna,pesan.nama,pesan.email,pesan.subjek,
  subjek.keterangan,pesan.rating,pesan.pesan, pesan.detile_pesan,status_pesan.status, pesan.file
  FROM pesan INNER JOIN subjek ON pesan.subjek = subjek.id
  INNER JOIN status_pesan ON pesan.detile_pesan = status_pesan.id");
  
    // search
    if (isset($_POST["cari"])) {
      $pesan = cari_pesan($_POST["keyword"]);
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
                  <li><a href="data-user.php">Data User</a></li>
                  <li><a href="data-menu.php">Data Menu</a></li>
                  <li><a href="data-pesan.php">Data Pesan</a></li>
                </ul>
              </li>
          <li><a href="../functions/box-pmenu.php">Pesan Menu</a></li>
          <li><a href="../functions/box-paketan.php">Pesan Paket Pesta</a></li>
          <li class="dropdown"><a href="#"><span>Transaksi</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="../functions/transaksi-pm.php">Transaksi Pesanan Menu</a></li>
                  <li><a href="../functions/transaksi-p3.php">Transaksi Pesanan Paket Pesta</a></li>
                </ul>
              </li>  
          <li class="dropdown"><a href="#"><span>Laporan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="../functions/laporan-pm.php">Laporan Penjualan Menu</a></li>
                  <li><a href="../functions/laporan-p3.php">Laporan Penjualan Paket Pesta</a></li>
                </ul>
              </li>          
              <div>
          </div>
          <li><a href="../functions/input-masukan.php">Pesan</a></li>
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
<div class="container" style="margin-top: 100px; padding: 0;" >
<div class="card mb-3">
  <div class="card-header">
    <h5>Data Masukan / Pesan</h5>
  </div>
  <div class="card-body">

  <form action="" method="post" class="d-flex bd-highlight" >
  <button type="button" class="btn btn-primary btn-sm mb-3 me-5 p-2 bd-highlight "><a href="../index.php#contact" class="text-light">Tambah Pesan</a></button>
    <input class="form-control mb-3 me-4 bd-highlight flex-grow-1" type="text" placeholder="Search" aria-label="Search" style="width: 150px; float: right;" name="keyword" id="keyword" autocomplete="off" >
    <button type="submit" name="cari" class="btn btn-outline-success bd-highlight mb-3 me-3">Search</button>
</form>

  <div>
<table  class="table table-bordered table-striped table-hover" >
<div class="d-flex flex-row" >
    <thead>
        <tr>
        <th scope="col">No</th>
            <th scope="col">Pengguna</th>
            <th scope="col">Nama Pengirim</th>
            <th scope="col">Email</th>
            <th scope="col">Subjek</th>
            <th scope="col">Keterangan Subjek</th>
            <th scope="col">Rating</th>
            <th scope="col">Pesan</th>
            <th scope="col">Status Pesan</th>
            <th scope="col">Keterangan Status Pesan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
</div>
<div class="d-flex flex-row" >
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($pesan as $data ) : ?> 
            <tr>
                <td scope="row"><?= $i ?></td>
                <td><?= $data["pengguna"]?></td>
                <td><?= $data["nama"]?></td>
                <td><?= $data["email"]?></td>
                <td><?= $data["subjek"]?></td>
                <td><?= $data["keterangan"]?></td>
                <td><?= $data["rating"]?></td>
                <td><?= $data["pesan"]?></td>
                <td><?= $data["detile_pesan"]?></td>
                <td><?= $data["status"]?></td>
                <td class="d-flex flex-column" >
                    <button class="btn btn-sm btn-success ms-2 me-2"><a href="../functions/ubah-aduan.php?id=<?= $data["id"];?>" class="text-light">Ubah</a></button>
                    <button class="btn btn-sm btn-danger" ><a href="../functions/hapus-pesan.php?id=<?= $data["id"];?>" class="text-light" onclick="return confirm('Yakin ingin mengahpus pesan ini ?');">Hapus</a></button>
                </td>
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    </div>
  </table>
          <!-- pagination -->
<nav class="d-flex justify-content-end me-2" >
  <ul class="pagination">
    <li class="page-item ">
    <?php if($hamalanAktif > 1) : ?>
      <a class="page-link" href="?halaman=<?= $hamalanAktif - 1?>">Previous</a>
      <?php endif ; ?>
    </li>

    <li class="page-item">
    <?php for($i = 1; $i <= $jumlahHalaman; $i++) :?>
      <?php if($i == $hamalanAktif ) : ?>
      <a class="page-link" href="?halaman=<?= $i;?>" style="font-weight: bold; color: red;"><?= $i; ?></a>
      <?php else : ?>
        <li class="page-item" >
            <a class="page-link" href="?halaman=<?= $i;?>"><?= $i; ?></a>
        </li>
      <?php endif; ?>
      <?php endfor;  ?>
    </li>

    <li class="page-item">
    <?php if($hamalanAktif < $jumlahHalaman) : ?>
      <a class="page-link" href="?halaman=<?= $hamalanAktif + 1?>">Next</a>
    <?php endif ; ?>
    </li>

  </ul>
</nav>
</div>
    </div>
</div>
<!-- card + table end -->
</div>
    </div>
  </div>

<?php require "../head-footer/footer.php"; ?>