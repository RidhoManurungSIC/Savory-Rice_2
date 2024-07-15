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
  $jumlahdata = count(query("SELECT * FROM users"));
  $jumlahHalaman = ceil($jumlahdata / $jumlahDataPerhalaman);
  $hamalanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
  $awalData = ($jumlahDataPerhalaman * $hamalanAktif) - $jumlahDataPerhalaman;

    $users = query ("SELECT users.id,users.username,users.email,users.password,users.id_akses,akses.tipe_akses 
    FROM users INNER JOIN akses WHERE users.id_akses = akses.id_akses  LIMIT $awalData, $jumlahDataPerhalaman");
    // search
    if (isset($_POST["cari"])) {
      $users = cari_user($_POST["keyword"]);
  }

  // registrasion
  if (isset($_POST["register_akses"])) {
    
    if (registrasi_akses($_POST) > 0) {
        echo "
            <script>
                alert('User baru berhasil di tambahkan!');
                document.location.href = '../forms/data-user.php';
            </script>
        ";
    }else {
        echo mysqli_error($conn);
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
<div class="container" style="margin-top: 100px;" >
<div class="card p-2 mt-2 mx-auto">
  <div class="card-header">
    <h5>Data Users</h5>
  </div>
  <div class="card-body">

  <form action="" method="post" class="d-flex bd-highlight" >
  <button type="button" class="btn btn-primary btn-sm mb-3 me-5 p-2 bd-highlight " data-bs-toggle="modal" data-bs-target="#register">Register User</button>
    <input class="form-control mb-3 me-4 bd-highlight flex-grow-1" type="text" placeholder="Search" aria-label="Search" style="width: 150px; float: right;" name="keyword" id="keyword" autocomplete="off" >
    <button type="submit" name="cari" class="btn btn-outline-success bd-highlight mb-3 me-3">Search</button>
</form>

  <div >
<table  class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Id Akses</th>
            <th scope="col">Tipe Akses</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($users as $data ) : ?> 
            <tr>
                <td scope="row"><?= $i ?></td>
                <td><?= $data["username"]?></td>
                <td><?= $data["email"]?></td>
                <td><?= $data["id_akses"]?></td>
                <td><?= $data["tipe_akses"]?></td>
                <td>
                    <button class="btn btn-sm btn-success ms-2 me-2"><a href="../functions/ubah-user.php?id=<?= $data["id"];?>" class="text-light">Ubah</a></button>
                    <button class="btn btn-sm btn-danger" ><a href="../functions/hapus-user.php?id=<?= $data["id"];?>" class="text-light" onclick="return confirm('Yakin ingin mengahpus user ini ?');">Hapus</a></button>
                </td>
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
<div class="modal fade" id="register" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User Baru</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST">
                  <div class="modal-body">
                  <div class="row p-2">
                      <div class="col-md-12 mt-2">
                        <div class="form-group mt-2">
                          <label>Username</label>
                          <input type="text" name="username" id="username" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group mt-2">
                          <label>Password</label>
                          <input type="password" name="password" id="password" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group mt-2">
                          <label>Email</label>
                          <input type="text" name="email" id="email" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group mt-2">
                        <label for="">Id Akses</label>
                <select name="id_akses" class="form-control" required>
                  <option selected value="0">Id Akses</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>                    
                        </div>
                        <div class="form-group mt-3 d-grid col-6 mx-auto" >
                        <button type="submit" name="register_akses" class="btn btn-primary" onclick="return confirm('Apakah data user sudah sesuai ?');">Sign Up</button>
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