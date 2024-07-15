<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: ../login system/login.php");
    exit;
}

    require '../login system/functions.php';
    require '../head-footer/head.php';

    $makanan_1 = query("SELECT * FROM menus WHERE kategori_masakan = 'Makanan'AND tipe_masakan  = 1 ");
    $minuman_1 = query("SELECT * FROM menus WHERE kategori_masakan = 'Minuman'AND tipe_masakan  = 1 ");
    $makanan_2 = query("SELECT * FROM menus WHERE kategori_masakan = 'Makanan'AND tipe_masakan  = 2 ");
    $minuman_2 = query("SELECT * FROM menus WHERE kategori_masakan = 'Minuman'AND tipe_masakan  = 2 ");
    $makanan_3 = query("SELECT * FROM menus WHERE kategori_masakan = 'Makanan'AND tipe_masakan  = 3 ");
    $minuman_3 = query("SELECT * FROM menus WHERE kategori_masakan = 'Minuman'AND tipe_masakan  = 3 ");
    $makanan_4 = query("SELECT * FROM menus WHERE kategori_masakan = 'Makanan'AND tipe_masakan  = 4 ");
    $minuman_4 = query("SELECT * FROM menus WHERE kategori_masakan = 'Minuman'AND tipe_masakan  = 4 ");
    $menu_order = query("SELECT * FROM menus");

    if (isset($_POST["tambah_box"])) {
    
      if (addbox($_POST) > 0) {
          echo "
              <script>
                  alert('Pesan Anda berhasil di tambahkan!');
                  document.location.href = 'functions/input-masukan.php';
              </script>
          ";
      }else {
          echo mysqli_error($conn);
      }
  
  }

    if (isset($_POST["paketan"])) {
    
      if (addboxp($_POST) > 0) {
          echo "
              <script>
                  alert('Pesan Paket Pesta Anda berhasil di tambahkan!, Pastikan Melengkapi Detile Pemesanan Dengan Menekan Tombol Ubah!');
                  document.location.href = 'functions/box-paketan.php';
              </script>
          ";
      }else {
          echo mysqli_error($conn);
      }
  }


    if (isset($_POST["pmasakan"])) {
    
      if (addboxm($_POST) > 0) {
          echo "
              <script>
                  alert('Pesan Menu Anda berhasil di tambahkan, Pastikan Melengkapi Detile Pemesanan Dengan Menekan Tombol Ubah!');
                  document.location.href = 'functions/box-pmenu.php';
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
          <li><a href="#hero">Home</a></li>
          <li class="dropdown"><a href="#"><span>Data Referensi</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="forms/data-user.php">Data User</a></li>
                  <li><a href="forms/data-menu.php">Data Menu</a></li>
                </ul>
              </li>
          <li><a href="functions/box-pmenu.php">Pesan Menu</a></li>
          <li><a href="functions/box-paketan.php">Pesan Paket Pesta</a></li>

              <li class="dropdown"><a href="#"><span>Transaksi</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="functions/transaksi-pm.php">Transaksi Pesanan Menu</a></li>
                  <li><a href="functions/transaksi-p3.php">Transaksi Pesanan Paket Pesta</a></li>
                </ul>
              </li>  
          <li class="dropdown"><a href="#"><span>Laporan</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="functions/laporan-pm.php">Laporan Penjualan Menu</a></li>
                  <li><a href="functions/laporan-p3.php">Laporan Penjualan Paket Pesta</a></li>
                </ul>
              </li>          
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

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">Nikmati Makanan<br>Lezat Dan Sehat Anda</h2>
          <p data-aos="fade-up" data-aos-delay="100">Datang dan rasakan sendiri pengalaman kuliner yang tak terlupakan di Savory Rice.</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#menu" class="btn-book-a-table">Order Now!</a>
            <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="../assets/img/hero-img.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="zoom-out">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Clients</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>
    </section><!-- End Stats Counter Section -->

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Menu</h2>
          <p>Lihat Menu <span>Lezat Kami</span></p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

          <li class="nav-item">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-starters">
              <h4>Appetizers</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-breakfast">
              <h4>Breakfast</h4>
            </a><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-lunch">
              <h4>Lunch</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-dinner">
              <h4>Dinner</h4>
            </a>
          </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

          <div class="tab-pane fade active show" id="menu-starters">
            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Appetizers</h3>
            </div>

            <div class="row gy-5">
              <!-- makanan -->
          <?php foreach ($makanan_1 as $menu ) : ?>
              <b class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                  <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- treeger -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </b><!-- Menu Item -->
          <?php endforeach; ?>


            <!-- minuman -->
            <?php foreach ($minuman_1 as $menu ) : ?>
              <div class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- treeger -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </div>
              <?php endforeach; ?><!-- Menu Item -->

            </div>
          </div><!-- End Starter Menu Content -->

          <div class="tab-pane fade" id="menu-breakfast">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Breakfast</h3>
            </div>

            <div class="row gy-5">

              <!-- makanan -->
              <?php foreach ($makanan_2 as $menu ) : ?>
              <div class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                  <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- tregger -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </div>
              <?php endforeach; ?><!-- Menu Item -->

              <!-- minuman -->
              <?php foreach ($minuman_2 as $menu ) : ?>
              <div class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                  <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- tregger -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </div>
              <?php endforeach; ?><!-- Menu Item -->

            </div>
          </div><!-- End Breakfast Menu Content -->

          <div class="tab-pane fade" id="menu-lunch">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Lunch</h3>
            </div>

            <div class="row gy-5">

              <!-- makanan -->
              <?php foreach ($makanan_3 as $menu ) : ?>
              <div class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                  <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- tregger -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </div>
              <?php endforeach; ?><!-- Menu Item -->

              <!-- minuman -->
              <?php foreach ($minuman_3 as $menu ) : ?>
              <div class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- tregger -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </div>
              <?php endforeach; ?><!-- Menu Item -->

            </div>
          </div><!-- End Lunch Menu Content -->

          <div class="tab-pane fade" id="menu-dinner">

            <div class="tab-header text-center">
              <p>Menu</p>
              <h3>Dinner</h3>
            </div>

            <div class="row gy-5">

              <!-- makanan -->
              <?php foreach ($makanan_4 as $menu ) : ?>
              <div class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                  <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- tregger -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </div>
              <?php endforeach; ?><!-- Menu Item -->

              <!-- minuman -->
              <?php foreach ($minuman_4 as $menu ) : ?>
              <div class="col-lg-4 menu-item">
                <a href="../assets/upload/<?= $menu["gambar"]; ?>" class="glightbox">
                  <img src="../assets/upload/<?= $menu["gambar"]; ?>" class="menu-img img-fluid" style="width: 250px; height: 250px;" alt="menu.jpg">
                </a>
                <h4><?= $menu["nama_masakan"]; ?></h4>
                <!-- <p class="ingredients">
                  Lorem, deren, trataro, filede, nerada
                </p> -->
                <p class="price">
                  Rp <?= $menu["harga"]; ?>
                </p>
                <div class="d-grid col-6 mx-auto">
                  <!-- tregger -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?= $menu["id_masakan"]; ?>" >Buy</button>
                </div>
              </div>
              <?php endforeach; ?><!-- Menu Item -->

            </div>
          </div><!-- End Dinner Menu Content -->

        </div>

      </div>
    </section><!-- End Menu Section -->

    <?php foreach ($menu_order as $menu ) : ?>
    <!-- modals -->
<div class="modal fade" id="<?= $menu["id_masakan"]; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Pesan Menu</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="" method="POST">
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-6">
                        <img src="../assets/upload/<?= $menu["gambar"]; ?>" alt="menu.jpg" class="card-img-top" style="width: 350px; height: 350px;" >
                      </div>
                      <div class="col-md-6">
                        <input type="hidden" name="id_masakan" value="<?= $menu["id_masakan"]; ?>">
                        <input type="hidden" name="username" value="<?= $_SESSION["user"];?>">
                        <input type="hidden" name="jmenu" value="<?= $menu["tipe_masakan"]?>">
                        <div class="form-group mt-2">
                          <label></label>
                          <input type="text" name="menu" readonly class="form-control" value="<?= $menu["nama_masakan"]; ?>">
                        </div>
                        <div class="form-group mt-2">
                          <label>Harga</label>
                          <input type="text" name="harga" readonly class="form-control" value="<?= $menu["harga"]; ?>">
                        </div>
                        <div class="form-group mt-2">
                          <label>Jumlah Pesanan</label>
                          <input type="number" class="form-control" name="jumlah" value="1" min="1" max="20">
                        </div>
                        <div class="form-group mt-2">
                        <label for="metode_pesanan">Metode Pesanan</label>
                <select name="metode_pesanan" class="form-control" required>
                  <option selected value="0">-- Pilih Metode Pemesanan --</option>
                    <option value="1">Makan Di Tempat</option>
                    <option value="2">Bawa Pulang</option>
                </select>                    
                        </div>
                        <div class="form-group mt-2">
                        <label for="jbayar">Jenis Pembayaran</label>
                <select name="jbayar" class="form-control" required>
                  <option selected value="0">-- Pilih Jenis Pembayaran --</option>
                    <option value="1">Tunai</option>
                    <option value="2">Transfer</option>
                </select>                    
                        </div>
                        <div class="form-group mt-2">
                          <label>Keterangan</label>
                          <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="pmasakan" class="btn btn-primary">Proses</button>
                  </div>
          </form>
      </div>
    </div>
  </div>
  <?php endforeach;?><!-- end modal -->

    <!-- ======= Events Section ======= -->
    <section id="events" class="events">
      <div class="container-fluid" data-aos="fade-up">

        <div class="section-header">
          <h2>Events</h2>
          <p>Bagikan <span>Momen Anda</span> Di Restoran Kami</p>
        </div>

        <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(../assets/img/events-1.jpg)">
              <h3>Paket Pesta Pernikahan</h3>
              <div class="price align-self-start">Rp 15.000.000</div>
              <W class="description">
                Wujudkan penikahan romantis dan berkesan dengan paket pernikahan Savory Rice.
                Nikmati hidangan lezat, dekorasi cantik dan pelayanan terbaik untuk momen spesial Anda!.
              </p>
            </div><!-- End Event item -->

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(../assets/img/events-2.jpg)">
              <h3>Paket Pesta Keluarga</h3>
              <div class="price align-self-start">Rp 30.000.000</div>
              <Bu class="description">
                Buat momen kebersamaan keluarga lebih seru dengan paket pesta keluarga Savory Rice.
                Nikmati hidangan lezat, suasana nyaman, dan harga yang terjangkau. Dapatkan kemudahan dalam 
                merayakan momen spesial bersama keluarga!.
              </p>
            </div><!-- End Event item -->

            <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(../assets/img/events-3.jpg)">
              <h3>Paket Pesta Ulang Tahun</h3>
              <div class="price align-self-start">Rp 88.000.000</div>
              <d class="description">
                Rayakan ulang tahun dengan penuh keceriaan bersama paket pesta ulang tahun Savory Rice.
                Nikmati hidangan lezat, dekorasi menarik, dan permainan seru untuk momen spesial Anda.
                Dapatkan paket ulang tahun yang tak terlupakan!.
              </d>
            </div><!-- End Event item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Events Section -->

    <!-- ======= Chefs Section ======= -->
    <section id="chefs" class="chefs section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Chef</h2>
          <p>Koki <span>Proffesional</span> Kami</p>
        </div>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="chef-member">
              <div class="member-img">
                <img src="../assets/img/chefs/chefs-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Reza Ahmad Fauzi</h4>
                <span>Master Chef</span>
                <ya>
                  Dengan Pengalaman bertahun-tahun di dunia kuliner, Master Chef Reza Ahmad Fauzi siap menghadirkan
                  hidangan lezat dan istimewa untuk Anda. Keahlian dalam mengelola berbagai bahan makanan dan teknik memasak
                  yang inovatif akan membuat Anda terkesan.
                </ya>
              </div>
            </div>
          </div><!-- End Chefs Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="chef-member">
              <div class="member-img">
                <img src="../assets/img/testimonials/testimonials-4.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Ridho Manurung</h4>
                <span>Patissier</span>
                <me>
                  Patissier Ridho Manurung ahli kue manis yang berpengalaman dan memiliki passion besar
                  dalam menciptakan kreasi yang lezat dan indah. Keahlian dalam membuat berbagai jenis kue, pastry, dan dessert akan
                  memanjakan lidah dan mata Anda.
                </p>
              </div>
            </div>
          </div><!-- End Chefs Member -->

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="chef-member">
              <div class="member-img">
                <img src="../assets/img/chefs/chefs-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href="#"><i class="bi bi-twitter"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Rahmad Rifany Siregar</h4>
                <span>Cook</span>
                <M>
                  Chef Rahmad Rifany Siregar memiliki keahlian memasak tradisional yang dipadukan dengan sentuhan modern.
                  Mampu menghasilkan hidangan lezat yang autentik dan sesuai dengan selera zaman.
                </M>
              </div>
            </div>
          </div><!-- End Chefs Member -->

        </div>

      </div>
    </section><!-- End Chefs Section -->

    <!-- ======= Book A Table Section ======= -->
    <section id="book-a-table" class="book-a-table">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Pesan Paket Pesta Anda</h2>
          <p>Rayakan <span>Momen Spesial</span> Anda</p>
        </div>

        <div class="row g-0">

          <div class="col-lg-4 reservation-img" style="background-image: url(../assets/img/reservation.jpg);" data-aos="zoom-out" data-aos-delay="200"></div>

          <div class="col-lg-8 d-flex align-items-center reservation-form-bg">

            <form action="" method="post" role="form" data-aos="fade-up" class="p-4" >
              <div class="row gy-4">
                <input hidden type="text" name="akun" id="akun" value="<?= $_SESSION["user"] ?>" >
                <div class="col-lg-4 col-md-6">
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" data-rule="email" data-msg="Please enter a valid email">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="text" class="form-control" name="nohp" id="nohp" placeholder="No Hp Anda" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tangal" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="time" class="form-control" name="jam" id="jam" placeholder="Waktu" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
                </div>
                <div class="col-lg-4 col-md-6">
                  <input type="number"  class="form-control" name="orang" id="orang" placeholder="Jumlah Orang" data-rule="minlen:1" data-msg="Please enter at least 1 chars">
                </div>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="keterangan" id="keterangan" rows="5" placeholder="Pesan Anda"></textarea>
              </div>
              
              <div class="text-center"><button class="btn btn-primary mt-3 col-6 mx-auto" type="submit" name="paketan" >Pesan Paket Pesta </button></div>
            </form>
          </div><!-- End Reservation Form -->

        </div>

      </div>
    </section><!-- End Book A Table Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>gallery</h2>
          <p>Lihat <span>Galeri Kami</span></p>
        </div>

        <div class="gallery-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-1.jpg"><img src="../assets/img/gallery/gallery-1.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-2.jpg"><img src="../assets/img/gallery/gallery-2.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-3.jpg"><img src="../assets/img/gallery/gallery-3.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-4.jpg"><img src="../assets/img/gallery/gallery-4.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-5.jpg"><img src="../assets/img/gallery/gallery-5.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-6.jpg"><img src="../assets/img/gallery/gallery-6.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-7.jpg"><img src="../assets/img/gallery/gallery-7.jpg" class="img-fluid" alt=""></a></div>
            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery" href="../assets/img/gallery/gallery-8.jpg"><img src="../assets/img/gallery/gallery-8.jpg" class="img-fluid" alt=""></a></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Butuh Bantuan? <span>Hubungi Kami!</span></p>
        </div>

        <div class="mb-3">
          <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-map flex-shrink-0"></i>
              <div>
                <h3>Alamat kami</h3>
                <p>Jl. Destination No. 12 North Moment</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email kami</h3>
                <p>contact@example.com</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>No Telepon </h3>
                <p>+1 5589 55488 55</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-share flex-shrink-0"></i>
              <div>
                <h3>Buka Pukul</h3>
                <div><strong>Senin-Sabtu:</strong> 11:00 - 00:00 WIB;
                  <strong>Minggu:</strong> Tutup
                </div>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

        <form action="" method="POST" enctype="multipart/form-data" role="form" class="d-flex flex-column bd-highlight p-3 p-md-4 mt-3 border border-3 rounded-2 shadow-sm">
          <div class="row">
            <div class="col-xl-6 form-group">
              <input type="hidden" name="id" id="id" >
              <input type="hidden" name="id" id="id" value="<?= $_SESSION["user"] ?>">
              <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Anda" required  >
            </div>
            <div class="col-xl-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email Anda" required  >
            </div>
          </div>
          <div class="d-flex gap-2 ">
          <div class="form-group col-xl-6 mt-3 pe-3 ">
                            <select name="subjek" class="form-control" required>
                            <option selected value="0">Pilih Subjek Anda</option>
                                <option value="1">Rasa Makanan</option>
                                <option value="2">Pelayanan</option>
                                <option value="3">Kebersihan</option>
                                <option value="4">Suasana</option>
                                <option value="5">Lainnya</option>
                            </select> 
          </div>
          <div class="form-group col-xl-6 mt-3 ">
                            <select name="rating" class="form-control" required>
                            <option selected value="0">Pilih Rating Anda</option>
                                <option value="⭐⭐⭐⭐⭐">⭐⭐⭐⭐⭐</option>
                                <option value="⭐⭐⭐⭐">⭐⭐⭐⭐</option>
                                <option value="⭐⭐⭐">⭐⭐⭐</option>
                                <option value="⭐⭐">⭐⭐</option>
                                <option value="⭐">⭐</option>
                            </select> 
          </div>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="pesan" rows="5" placeholder="pesan" required autocomplete="off" ></textarea>
          </div>
          <div>
            <!-- <input type="file" class="form-control mt-3" name="file" id="file" placeholder="" > -->
        </div>
          <div class="text-center" ><button type="submit" name="tambah_box" class="btn btn-primary mt-3 col-6 mx-auto" >Kirim Pesan</button></div>
        </form><!--End Contact Form -->

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Alamat</h4>
            <p>
            Jl. Destination <br>
            No. 12 North Moment <br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Reservasi</h4>
            <p>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Buka Pukul</h4>
            <p>
              <strong>Senin-Sabtu: 11:00</strong> - 00:00 WIB<br>
              Minggu: Tutup
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Follow Kami</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Yummy</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <?php require '../head-footer/footer.php'; ?>