<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";
require "../head-footer/head.php";


$id = $_GET["id"];
$pesanan_pesta = query("SELECT paketan.id,paketan.akun,paketan.nama,paketan.email,paketan.id_srp,
    paketan.nohp,paketan.tanggal,paketan.jam,paketan.orang,paketan.create_at,
    paketan.keterangan,paketan.status,status_paket.status_paket,paketan.bayar,
    pembayaran.tipe_pembayaran,paketan.jpaketan,model_paket.jpaket, model_paket.harga,paketan.file
    FROM paketan INNER JOIN status_paket ON paketan.status = status_paket.id
    INNER JOIN pembayaran ON paketan.bayar = pembayaran.id
    INNER JOIN model_paket ON paketan.jpaketan = model_paket.id WHERE paketan.id = $id");

?>

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 mx-auto" style="border: 1px solid #000;">
          <h4 class="text-center mt-2"><span class="mt-3">Savory Rice</span></h4>
          <hr>
          <?php foreach ($pesanan_pesta as $row) :?>
          <div class="row mt-3">
            <div class="col-md-6">
              TANGGAL : <?= $row['create_at'] ?><br>
              NO ORDER : <?= $row['id_srp'] ?><br>
            </div>
            <div class="col-md-6">
              Member : <?= $row['nama'] ?>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-4">
                Jenis Paket  : 
            </div>
            <div class="col-md-8">
             <?= $row['jpaket'] ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
                Metode Pembayaran  : 
            </div>
            <div class="col-md-8">
             <?= $row['tipe_pembayaran'] ?>
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
            <div class="col-md-4 text-left">Subtotal</div>
            <div class="col-md-8 text-left">Rp. 1</div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Diskon</div>
            <div class="col-md-8 text-left">0%</div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Total</div>
            <div class="col-md-8 text-left">Rp. <?= $row['harga'] ?></div>
          </div>
          <div class="row">
            <div class="col-md-4 text-left">Tunai</div>
            <div class="col-md-8 text-left">Rp. <?= $row['harga'] ?></div>
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