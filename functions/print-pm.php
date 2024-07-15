<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";
require "../head-footer/head.php";


$id = $_GET["id"];
$pesanan_pesta = query("SELECT * FROM pesan_menu WHERE id = $id");

?>

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 mx-auto" style="border: 1px solid #000;">
          <h4 class="text-center mt-2"><span class="mt-3">Savory Rice</span></h4>
          <hr>
          <?php foreach ($pesanan_pesta as $row) :?>
            <?php 
            if ($row["jenis_menu"]  == 1) {
              $isi_jm = "Appetizers";
            } elseif ($row["jenis_menu"]  == 2) {
              $isi_jm = "Breakfast";
            }elseif ($row["jenis_menu"] == 3) {
              $isi_jm = "Lunch";
            }else {
              $isi_jm = "Dinner";
            }
            
            if ($row["m_pesanan" ] == 1) {
              $isim = "Makan Di Tempat";
            }else {
              $isim = "Bawa Pulang";
            }
            
            if ($row["status_pesanan"]  == 1) {
              $isis = "Di kirim";
            }elseif ($row["status_pesanan"] == 2) {
              $isis = "Di Proses";
            }elseif ($row["status_pesanan"] == 3) {
              $isis = "Di Terima";
            }else {
              $isis = "Belum Di Kirim";
            }
        
            if ($row["m_pembayaran"] == 1) {
              $isip = "Tunai";
            }else {
              $isip = "Transfer";
            }

            $hg = $row["harga"];
            $jb = $row["jumlah"];
            $tb = $jb * $hg;
            ?>
            
          <div class="row mt-3">
            <div class="col-md-6">
              TANGGAL : <?= $row['create_at'] ?><br>
              NO ORDER : <?= $row['id_pm'] ?><br>
            </div>
            <div class="col-md-6">
              Member : <?= $row['nama'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4">
                Jenis Pesanan  : 
            </div>
            <div class="col-md-8">
             <?= $isim; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
                Metode Pembayaran  : 
            </div>
            <div class="col-md-8">
             <?= $isip; ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
                Keterangan  : 
            </div>
            <div class="col-md-8">
             <?= $row['keterangan'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4 text-left">Harga</div>
            <div class="col-md-8 text-left">Rp. <?= $row['harga'] ?></div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Subtotal</div>
            <div class="col-md-8 text-left">Rp. <?= $row['jumlah'] ?></div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Diskon</div>
            <div class="col-md-8 text-left">0%</div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Total</div>
            <div class="col-md-8 text-left">Rp. <?= $tb; ?></div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Tunai</div>
            <div class="col-md-8 text-left">Rp. <?= $tb; ?></div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Kembalian</div>
            <div class="col-md-8 text-left">Rp. 0,00</div>
          </div>
          <hr>
          <div class="row">
            <div class="col text-center">
              <p>
                Terima Kasih <br> Atas Kunjungan Anda
              </p>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <script>
      window.print();
    </script>
<?php require "../head-footer/footer.php"; ?>