<?php 
session_start();
if ( !isset($_SESSION["login"]) ) {
  header("Location: ../../login system/login.php");
  exit;
}

require "../../login system/functions.php";
require "../head-footer/head.php";

$pesanan_pesta = query("SELECT paketan.id,paketan.akun,paketan.nama,paketan.email,paketan.id_srp,
    paketan.nohp,paketan.tanggal,paketan.jam,paketan.orang,paketan.create_at,
    paketan.keterangan,paketan.status,status_paket.status_paket,paketan.bayar,
    pembayaran.tipe_pembayaran,paketan.jpaketan,model_paket.jpaket, model_paket.harga,paketan.file
    FROM paketan INNER JOIN status_paket ON paketan.status = status_paket.id
    INNER JOIN pembayaran ON paketan.bayar = pembayaran.id
    INNER JOIN model_paket ON paketan.jpaketan = model_paket.id WHERE paketan.status = 3 ");

?>


<div class="container">
      <div class="row">
        <div class="col-md-12 mx-auto mt-5">
          <div class="text-center">
            <h3>Print Laporan Penjualan Paket Pesta</h3>
            <h5>Savory Rice</h5>
            <p>WA : 088751241234 | Alamat : Jl. Destination No. 12 North Moment</p>
          </div>
          <div >
            <div >
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Id Order</th>
                    <th>Pelanggan</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jenis Paket</th>
                    <th>Jam</th>
                    <th>Orang</th>
                    <th>Metode Pembayaran</th>
                    <th>Total Pembayaran</th>
                    <th>Diskon</th>
                    <th>Total (Diskon)</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($pesanan_pesta as $row) :?>
                    <tr>
                      <td><?=  $row['id_srp'] ?></td>
                      <td><?=  $row['nama'] ?></td>
                      <td><?= $row['create_at'] ?></td>
                      <td><?= $row['jpaket'] ?></td>
                      <td><?= $row['jam'] ?></td>
                      <td><?= $row['orang'] ?></td>
                      <td><?= $row['tipe_pembayaran'] ?></td>
                      <td>Rp. <?= $row['harga'] ?></td>
                      <td>0%</td>
                      <td>Rp. <?= $row['harga'] ?></td>
                    </tr>
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