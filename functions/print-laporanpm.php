<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../login system/login.php");
  exit;
}

require "../login system/functions.php";
require "../head-footer/head.php";

$pesanan = query("SELECT  * FROM pesan_menu WHERE	status_pesanan = 3  ");

?>


<div class="container">
      <div class="row">
        <div class="col-md-10 mx-auto mt-5">
          <div class="text-center">
            <h3>Print Laporan Penjualan Pesanan Menu</h3>
            <h5>Savory Rice</h5>
            <p>WA : 088751241234 | Alamat : Jl. Destination No. 12 North Moment</p>
          </div>
          <div >
            <div >
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
            <th scope="col">Total Harga</th>
            <th scope="col">Diskon</th>
            <th scope="col">Total Bayar</th>
            <th scope="col">Status</th>
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
            $hg = $data["harga"];
            $jb = $data["jumlah"];
            $tb = $jb * $hg;
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
                <td><?= $tb;?></td>
                <td>Diskon 0%</td>
                <td><?= $tb;?></td>
                <td><?= $isis;?></td>
            </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
</table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      window.print();
    </script>

    <?php require "../head-footer/footer.php"; ?>