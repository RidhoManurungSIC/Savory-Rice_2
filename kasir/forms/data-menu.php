<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../../login system/login.php");
  exit;
}
    require "../../login system/functions.php";
    require "../head-footer/head.php";

  // pagination
  $jumlahDataPerhalaman = 10;
  $jumlahdata = count(query("SELECT * FROM menus"));
  $jumlahHalaman = ceil($jumlahdata / $jumlahDataPerhalaman);
  $hamalanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
  $awalData = ($jumlahDataPerhalaman * $hamalanAktif) - $jumlahDataPerhalaman;

    $menus = query ("SELECT menus.id_masakan,menus.nama_masakan,menus.kategori_masakan,menus.tipe_masakan,menus.harga,menus.gambar,tipe_masakan.jenis_masakan
    FROM menus INNER JOIN tipe_masakan WHERE menus.tipe_masakan = tipe_masakan.id  LIMIT $awalData, $jumlahDataPerhalaman");
    
    // search
    if (isset($_POST["cari"])) {
      $menus = cari_menu($_POST["keyword"]);
    }

  // add new menu
  if (isset($_POST["addmenu"])) {

    echo "
            <script>
                alert('Anda Tidak Memiliki Akses!');
                // document.location.href = '../forms/data-menu.php';
            </script>
        ";
    
    // if (addmenu($_POST) > 0) {
    //     echo "
    //         <script>
    //             alert('Menu baru berhasil di tambahkan!');
    //             document.location.href = '../forms/data-menu.php';
    //         </script>
    //     ";
        
    // }else {
    //     echo mysqli_error($conn);
    // }

}
?>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="../index.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Savory Rice<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="../#hero">Home</a></li>
          <li class="dropdown"><a href="#"><span>Data Referensi</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="data-user.php">Data User</a></li>
                  <li><a href="data-menu.php">Data Menu</a></li>
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
          <li class="dropdown" style="float: right;"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li class="p-2" ><img src="../../assets/img/apple-touch-icon.png" style="width: 30px; margin-right:10px;" alt="icon.png"><?= $_SESSION["user"]; ?></li>
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
    <h5>Data Menus</h5>
  </div>
  <div class="card-body">

  <form action="" method="post" class="d-flex bd-highlight" >
  <button type="button" class="btn btn-primary btn-sm mb-3 me-5 p-2 bd-highlight " data-bs-toggle="modal" data-bs-target="#addmenu">Tambah Menu</button>
    <input class="form-control mb-3 me-4 bd-highlight flex-grow-1" type="text" placeholder="Search" aria-label="Search" style="width: 150px; float: right;" name="keyword" id="keyword" autocomplete="off" >
    <button type="submit" name="cari" class="btn btn-outline-success bd-highlight mb-3 me-3">Search</button>
</form>

  <div>
<table  class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Masakan</th>
            <th scope="col">kategori Masakan</th>
            <th scope="col">Harga</th>
            <th scope="col">Gambar</th>
            <th scope="col">Tipe Masakan</th>
            <th scope="col">Jenis Masakan</th>
            <!-- <th scope="col">Aksi</th> -->
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($menus as $data ) : ?> 
            <tr>
                <td scope="row"><?= $i ?></td>
                <td><?= $data["nama_masakan"]?></td>
                <td><?= $data["kategori_masakan"]?></td>
                <td><?= $data["harga"]?></td>
                <td><img src="../../assets/upload/<?= $data["gambar"]; ?>" alt="menu.jpg"  width="80"></td>
                <td><?= $data["tipe_masakan"]?></td>
                <td><?= $data["jenis_masakan"]?></td>
                <!-- <td>
                    <button class="btn btn-sm btn-success ms-2 me-2"><a href="../functions/ubah-menu.php?id=<?= $data["id_masakan"];?>" class="text-light">Ubah</a></button>
                    <button class="btn btn-sm btn-danger" ><a href="../functions/hapus-menu.php?id=<?= $data["id_masakan"];?>" class="text-light" onclick="return confirm('Yakin ingin mengahpus menu ini ?');">Hapus</a></button>
                </td> -->
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
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
</div>
<!-- card + table end -->


    <!-- modals -->
<div class="modal fade" id="addmenu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Menu Baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                  <div class="row p-2">
                      <div class="col-md-12 mt-2">
                        <div class="form-group mt-2">
                          <label>Nama Masakan</label>
                          <input type="text" name="nama_masakan" id="nama_masakan" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group mt-2">
                        <label for="kategori_masakan">Kategori Masakan</label>
                            <select name="kategori_masakan" class="form-control" required>
                            <option selected value="0"></option>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                            </select>                           
                          </div>

                        <div class="form-group mt-2">
                        <label for="tipe_masakan">Tipe Masakan</label>
                            <select name="tipe_masakan" class="form-control" required>
                            <option selected value="0"></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>                    
                        </div>

                        <div class="form-group mt-2">
                          <label>Harga</label>
                          <input type="text" name="harga" id="harga" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group mt-2 mb-4 d-flex justify-content-between">
                          <div class="ms-3"><img src="../../assets/img/menu/menu-item-1.png" alt="menu.jpg" style="width: 120px;"></div>
                          <!-- <div><input type="checkbox" name="konfirmasi" id="konfirmasi"><input type="file" name="img" id="img" class="form-control"></div> -->
                          <div class="ms-5">
                          <label for="gambar">Gambar</label>
                          <input type="file" name="gambar" id="gambar" class="form-control">
                          </div>
                        </div>
                        
                        <div class="form-group mt-3 d-grid col-6 mx-auto" >
                        <button type="submit" name="addmenu" class="btn btn-primary">Tambahkan</button>
                        </div>
                      </div>
                    </div>
                      </div>
                    </div>
                  </div>
          </form>
      </div>
    </div>
  </div>

<?php require "../head-footer/footer.php"; ?>