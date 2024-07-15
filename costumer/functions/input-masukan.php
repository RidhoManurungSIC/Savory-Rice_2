<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../../login system/login.php");
  exit;
}

    require "../../login system/functions.php";
    require "../head-footer/head.php";

    $akn = $_SESSION["user"];
    $box_pesan = query ("SELECT box_pesan.id,box_pesan.nama,box_pesan.email,box_pesan.subjek,
    subjek.keterangan,box_pesan.rating,box_pesan.pesan,box_pesan.status,status_pesan.status
    FROM box_pesan INNER JOIN subjek ON box_pesan.subjek = subjek.id
    INNER JOIN status_pesan ON box_pesan.status = status_pesan.id WHERE box_pesan.pengguna = '$akn' ");
  

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
          <li><a href="box-pmenu.php">Pesan Menu</a></li>
          <li><a href="box-paketan.php">Pesan Paket Pesta</a></li>
          <li><a href="input-masukan.php">Pesan</a></li>
          <li class="dropdown" style="float: right;"><a href="#"><span>Profil</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li class="p-2" ><img src="../../assets/img/apple-touch-icon.png" style="width: 30px; margin-right:10px;" alt="icon.png"><?= $_SESSION["user"]; ?></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

      <a class="btn-book-a-table me-2" href="../../login system/logout.php">Logout</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

<!-- card + table -->
<div class="container" style="margin-top: 100px;" >
<div class="card p-2 mt-2 mx-auto">
  <div class="card-header">
    <h5>Pesan Anda</h5>
  </div>
  <div class="card-title">
    <button type="button" class="btn btn-primary m-3 p-2" ><a href="../index.php#contact" class="text-light" >Tambah Masukan</a> </button>
  </div>
  <div class="card-body">
  <div >
<table  class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Subjek</th>
            <th scope="col">Rating</th>
            <th scope="col">Pesan</th>
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
                <td><?= $data["keterangan"]?></td>
                <td><?= $data["rating"]?></td>
                <td><?= $data["pesan"]?></td>
                <td>
                  <div class="d-flex" >
                    <button class="btn btn-sm btn-success ms-2 me-2"><a href="ubah-masukan.php?id=<?= $data["id"]?>" class="text-light">Ubah</a></button>
                    <!-- <button type="button" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus pesan ini ?');">
                      <a href="hapus-box.php?id=<?= $data["id"]?>" class="text-light" >Hapus</a></button> -->
                      
    <form action="tambah-pesan.php" method="post" class="ms-2">
      <input type="hidden" name="id" id="id" value="<?= $data["id"]?>" >
      <input type="text" hidden name="nama" class="form-control" id="nama"value="<?= $data["nama"]; ?>" required  >
      <input type="email" hidden class="form-control" name="email" id="email"value="<?= $data["email"]; ?>" required  >
      <select name="subjek" hidden class="form-control" required>
        <option selected value="<?= $data["subjek"]; ?>"></option>
      </select> 
      <select name="rating" hidden class="form-control" required>
        <option selected value="<?= $data["rating"]; ?>"></option>
      </select> 
      <textarea  class="form-control" hidden name="pesan" rows="5"><?= $data["pesan"]; ?></textarea>
      <button type="submit" name="kirim" class="btn btn-sm btn-primary text-light" onclick="return confirm('Yakin ingin mengirim pesan ini ?');">Proses</button>
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