<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../../login system/login.php");
  exit;
}

    require "../../login system/functions.php";
    require "../head-footer/head.php";

    $id = $_GET["id"];
    $masukan = query("SELECT * FROM box_paketan WHERE id = $id")[0];

    if ( $masukan["bayar"]== 1) {
        $isi_bayar = "Tunai";
      }else {
        $isi_bayar = "Transfer";
      }

    if ( $masukan["jpaketan"]== 1) {
        $isi_jpaketan = "Paket Pesta Pernikahan";
      }elseif ($masukan["jpaketan"]== 2) {
        $isi_jpaketan = "Paket Pesta Keluarga";
      }else {
        $isi_jpaketan = "Paket Pesta Ulang Tahun";
      }

      if (isset($_POST["paketan"])) {

        if (ubah_boxK($_POST) > 0 )  {
            echo "
                <script>
                    alert('Pesanan paket pesta anda berhasil diubah!');
                    document.location.href = 'box-paketan.php';
                </script>
            " . $akun;
        }else {
            echo "
            
                <script>
                    alert('Pesanan paket pesta anda gagal diubah!');
                </script
            ";
        }    
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

  <main id="main">
<!-- ======= Book A Table Section ======= -->
<section id="book-a-table" class="book-a-table" style="margin-top: 60px;" >
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Pesan Paket Pesta Anda</h2>
        </div>

        <div class="row g-0">

          <div class="col-lg-4 reservation-img" style="background-image: url(../../assets/img/reservation.jpg);" data-aos="zoom-out" data-aos-delay="200"></div>

          <div class="col-lg-8 d-flex align-items-center reservation-form-bg">

            <form action="" method="post" enctype="multipart/form-data" role="form" data-aos="fade-up" class="p-4" >
              <div class="row gy-4">
                <input type="text" hidden name="id" id="id" value="<?= $masukan["id"]; ?>" >
                <input hidden type="text" name="akun" id="akun" value="<?= $_SESSION["user"] ?>" >
                <div class="col-lg-4 col-md-6">
                  <input type="text" name="nama" class="form-control" id="nama" value="<?= $masukan["nama"]; ?>" placeholder="Nama Anda" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="email" class="form-control" name="email" id="email" value="<?= $masukan["email"]; ?>" placeholder="Email Anda" data-rule="email" data-msg="Please enter a valid email">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="text" class="form-control" name="nohp" id="nohp" value="<?= $masukan["nohp"]; ?>" placeholder="No Hp Anda" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="date" name="tanggal" class="form-control" value="<?= $masukan["tanggal"]; ?>" id="tanggal" placeholder="Tangal" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="time" class="form-control" name="jam" id="jam" value="<?= $masukan["jam"]; ?>" placeholder="Waktu" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="number"  class="form-control" name="orang" value="<?= $masukan["orang"]; ?>" id="orang" placeholder="Jumlah Orang" data-rule="minlen:1" data-msg="Please enter at least 1 chars">
                </div>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="keterangan" id="keterangan" rows="5" placeholder="Pesan Anda"><?= $masukan["keterangan"]; ?></textarea>
              </div>

              <div class="row g-0">
              <div class="form-group col-xl-6 mt-3 pe-3 ">
                <label for="bayar">Tipe Pembayaran</label>
                            <select name="bayar" class="form-control" required>
                            <option selected value="<?= $masukan["bayar"]; ?>"><?= $isi_bayar?></option>
                                <option value="1">Tunai</option>
                                <option value="2">Transfer</option>
                            </select> 
                </div>
              
              <div class="form-group col-xl-6 mt-3 pe-3 ">
                <label for="jpaketan">Jenis Paket Pesta</label>
                            <select name="jpaketan" class="form-control" required>
                            <option selected value="<?= $masukan["jpaketan"]; ?>"><?= $isi_jpaketan?></option>
                                <option value="1">Paket Pesta Pernikahan</option>
                                <option value="2">Paket Pesta Keluarga</option>
                                <option value="3">Paket Pesta Ulang Tahun</option>
                            </select> 
                </div>

                <div class="form-group mt-2 mb-2">
                    <label for="file">Bukti Pembayaran <b><i>(Transfer)</i></b></label><br>
                    <input type="file" name="file" id="file">
                </div>
                </div>
              
              <div class="text-center"><button class="btn btn-primary mt-3 col-6 mx-auto" type="submit" name="paketan" >Pesan Paket Pesta </button></div>
            </form>
          </div><!-- End Reservation Form -->

        </div>

      </div>
    </section><!-- End Book A Table Section -->
    </main>

    <?php require "../head-footer/footer.php"; ?>
