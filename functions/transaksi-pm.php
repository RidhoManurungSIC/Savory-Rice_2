<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

    require "../login system/functions.php";
    require "../head-footer/head.php";

    $pesanan = query ("SELECT * FROM pesan_menu");

    $transfer = query("SELECT * FROM pesan_menu WHERE m_pembayaran = 2");

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

  <form action="" method="post" class="d-flex bd-highlight" >
  <button type="button" class="btn btn-primary btn-sm mb-3 me-4  p-2 bd-highlight w-25 "  data-bs-toggle="modal" data-bs-target="#transfer">Transfer</button>
  <input class="form-control mb-3 me-4 bd-highlight flex-grow-1" type="text" placeholder="Search" aria-label="Search" style="width: 150px; float: right;" name="keyword" id="keyword" autocomplete="off" >
  <button type="submit" name="cari" class="btn btn-outline-success bd-highlight mb-3">Search</button>
</form>

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
                  <div class="d-flex flex-column m-2">
                    <?php 
                    if ($data["m_pembayaran"] == 1) {
                      $isi = $data['id'];
                      $btn = "<button class= 'btn btn-sm btn-primary'><a href='transaksi.php?tn=$isi' class='text-light' >Proses</a></button> ";
                      $btn2 = "<button type='button' class='btn btn-primary btn-sm'  data-bs-toggle='modal' data-bs-target='#$isi'>Proses</button>";
                        echo $btn2;

                    }
                    ?>
                    <button class="btn btn-sm btn-warning mt-2 mb-2"><a href="konfirmasi-pm.php?id=<?= $data["id"];?>&id_pm=<?= $data["id_pm"];?>" class="text-light" onclick="return confirm('Yakin ingin mengkonfirmasi pesanan ini ?');">Konfirmasi</a></button>
                    <button class="btn btn-sm btn-success ms-2 me-2"><a href="print-pm.php?id=<?= $data["id"];?>" target="_blank" class="text-light">print</a></button>
                    <button class="btn btn-sm btn-danger ms-2 me-2 mt-2"><a href="hapus-tpm.php?id=<?= $data["id"];?>" onclick="return confirm('Yakin ingin menghapus pesanan ini ?');"  class="text-light">hapus</button>
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
    <!-- card + table end -->


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

            $hg = $data["harga"];
            $jb = $data["jumlah"];
            $tb = $jb * $hg;
            ?>
            
<!-- modal tunai -->
<div class="modal fade" id="<?= $data["id"]?>" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel1">Input Transaksi Tunai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                  <div class="row p-2">
                  <div class="col-md-8">
                        <div class="det">
                            <p>Id Pemesanan : <?= $data["id_pm"] ?></p>
                            <p>Nama : <?= $data["nama"] ?></p>
                            <p>Menu : <?= $data["menu"] ?></p>
                            <p>Jenis Menu : <?= $isi_jm; ?></p>
                            <p>Tanggal Pesan : <?= $data["create_at"]?></p>
                            <p>Metode Pembayaran : <?= $isip;?></p>
                            <p>Status : <?= $isis;?></p>
                        </div>
                    <table class="table table-bordered table-hover table-striped" id="tabel">
                        <thead>
                            <tr> 
                                <th>No</th>
                                <th>Nama Pesanan</th>
                                <th>Email Pesanan</th>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Harga Total</th>
                            </tr>
                        </thead>
                            <tbody>
                                    <tr class="text-small">
                                        <td><?= $i;?></td>
                                        <td><?= $data["nama"]?></td>
                                        <td><?= $data["email"]?></td>
                                        <td><?= $data["menu"]?></td>
                                        <td>Rp.<?= $data["harga"]?></td>
                                        <td><?= $data["jumlah"]?></td>
                                        <td>Rp. <?= $tb;?></td>
                                    </tr>
                            </tbody>
                            <tbody></tbody>
                    </table>
                </div>
                <div class="col-md-4 mt-3">
                    <form action="" method="POST" >
                        <div class="form-group">
                            <label for="">Total Harga</label>
                            <input disabled type="text" name="total_harga" readonly required value="<?= $data["harga"] ?>" class="form-control hartot" placeholder="Total Harga">
                        </div>
                        <div class="form-group">
                            <label for="">Total Bayar</label>
                            <input type="number" readonly class="form-control totbayar" required value="<?= $tb; ?>" name="total_bayar" placeholder="Total Bayar">
                        </div>
                        <div class="form-group">
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <input type="number" min="1" class="form-control uang" required name="uang" placeholder="Uang">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="transaksi" class="btn  btn-primary btn-block w-100 mt-2">Bayar</button>
                    </form>
                </div>
                  </div>
                  </div>
          </form>
      </div>
    </div>
</div>
<?php $i++; ?>
<?php endforeach; ?>


<!-- modal transfer -->
<div class="modal fade" id="transfer" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel2">Bukti Pembayaran Transaksi Transfer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body">
                  <div class="row p-2">
                  <div class="form-group">
                        <label for="id">Pesanan Paket Pesta</label>
                            <select name="id" class="form-control" required>
                            <option selected disabled>---Atas Nama---</option>
                            <?php foreach ($transfer as $data ) : ?>
                                <option value="<?= $data["id"]?>"><?= $data["nama"]?></option>
                            <?php endforeach; ?>
                            </select>       

                        <label for="id" class="mt-3">Bukti Transfer</label>
                            <?php foreach ($transfer as $data ) : ?>
                                <p>
                                    <?= $data["nama"]?>
                                    <a href="../assets/bukti_pembayaran/<?= $data["file"]?>" target="_blank" rel="noopener noreferrer">file</a>
                            </p>
                                <!-- <img src="../assets/bukti_pembayaran/<?= $data["file"]?>" alt="bukti.jpg" width="100px" class="card-img-top" ><br> -->
                            <?php endforeach; ?>
                            </select>                           
                          </div>
    </form>
                </div>
    </div>
</div>





<?php require "../head-footer/footer.php"; ?>