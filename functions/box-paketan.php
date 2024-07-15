<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

    require "../login system/functions.php";
    require "../head-footer/head.php";

    $box_pesan = query ("SELECT box_paketan.id,box_paketan.akun,box_paketan.nama,box_paketan.email,
    box_paketan.nohp,box_paketan.tanggal,box_paketan.jam,box_paketan.orang,
    box_paketan.keterangan,box_paketan.id_p,box_paketan.status,status_paket.status_paket,box_paketan.bayar,
    pembayaran.tipe_pembayaran,box_paketan.jpaketan,model_paket.jpaket,box_paketan.file
    FROM box_paketan INNER JOIN status_paket ON box_paketan.status = status_paket.id
    INNER JOIN pembayaran ON box_paketan.bayar = pembayaran.id
    INNER JOIN model_paket ON box_paketan.jpaketan = model_paket.id");
    

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
    <h5>Paket Pesta Anda</h5>
  </div>
  <div class="card-title">
    <button type="button" class="btn btn-primary m-3 p-2" ><a href="../index.php#book-a-table" class="text-light" >Tambah Paket Pesta</a> </button>
  </div>
  <div class="card-body">
  <div >
<table  class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">No Hp</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Jam</th>
            <th scope="col">Orang</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Paket</th>
            <th scope="col">Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1; ?>
    <?php foreach ($box_pesan as $data ) : ?> 
            <tr>
                <td scope="row"><?= $i?></td>
                <td><?= $data["nama"]?></td>
                <td><?= $data["email"]?></td>
                <td><?= $data["nohp"]?></td>
                <td><?= $data["tanggal"]?></td>
                <td><?= $data["jam"]?></td>
                <td><?= $data["orang"]?></td>
                <td><?= $data["keterangan"]?></td>
                <td><?= $data["jpaket"]?></td>
                <td><?= $data["tipe_pembayaran"]?></td>
                <td><?= $data["status_paket"]?></td>
                <td>
                  <div class="d-flex flex-column m-2" >
                    <button class="btn btn-sm btn-success ms-2 me-2"><a href="ubah-paketan.php?id=<?= $data["id"]?>" class="text-light">Ubah</a></button>
                    <button type="button" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Yakin ingin menghapus pesan ini ?');">
                      <a href="hapus-boxp.php?id=<?= $data["id"]?>" class="text-light" >Hapus</a></button>
                      
    <form action="tambah-paketan.php"  method="post" class="ms-2 mt-2">
      <input type="hidden" name="id" id="id" value="<?= $data["id"]?>" >
      <input type="hidden" name="id_p" id="id_p" value="<?= $data["id_p"]?>" >
      <input type="text" hidden name="nama" class="form-control" id="nama"value="<?= $data["nama"]; ?>" required  >
      <input type="email" hidden class="form-control" name="email" id="email"value="<?= $data["email"]; ?>" required  >
      <input type="text" hidden name="nohp" class="form-control" id="nohp"value="<?= $data["nohp"]; ?>" required  >
      <input type="date" hidden class="form-control" name="tanggal" id="tanggal"value="<?= $data["tanggal"]; ?>" required  >
      <input type="time" hidden class="form-control" name="jam" id="jam"value="<?= $data["jam"]; ?>" required  >
      <input type="number" hidden class="form-control" name="orang" id="orang"value="<?= $data["orang"]; ?>" required  >
      <textarea  class="form-control" hidden name="keterangan" rows="5"><?= $data["keterangan"]; ?></textarea>
      <input type="text" hidden name="status" class="form-control" id="status" value="<?= $data["status"]; ?>" required  >
      <input type="text" hidden name="bayar" class="form-control" id="bayar" value="<?= $data["bayar"]; ?>" required  >
      <input type="text" hidden name="jpaketan" class="form-control" id="jpaketan" value="<?= $data["jpaketan"]; ?>" required  >
      <input type="text" hidden name="file" class="form-control" id="file" value="<?= $data["file"]; ?>" required  >
      <button type="submit" name="kirim" class="btn btn-sm btn-primary text-light"    onclick="return confirm('Yakin ingin mengirim paket pesta ini ?');">Proses</button>
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