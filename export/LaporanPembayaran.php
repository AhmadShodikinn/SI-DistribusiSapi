<?php

ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/SI-DISTRIBUSISAPI/config.php';
session_start();
if (isset($_POST['print']) && isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['periode'])) {
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $periode = $_POST['periode'];
};

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan</title>
</head>
<style media="print">
 @page {
  size: auto;
  margin: 0;
       }
</style>
<style>
        #signature {
            width: 100%;
            display: flex;
            justify-content: end;
            margin-left: auto;
            margin-right: 20px;
            /* text-align: right;
            position: absolute;
            bottom: 50px;
            right: 0; */
        }

        #signature .details {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 40px;
        }

        #signature .details .identity {
            display: flex;
            flex-direction: column;
            align-items: start;
            justify-content: space-between;
        }

        #signature .details .identity p {
            display: inline-block;
            margin: 0;
            height: 20px;
        }

        .tanggal {
            width: 100%;
            text-align: end;
        }
    </style>
<body>
    <h2 style="text-align:center; margin: 0">Laporan Pembayaran Peternak</h2>
    <h3 style="text-align:center; margin: 0">PT. Mitra Bhakti Makmur</h3>
    <hr>
    <h4 class="tanggal">Tanggal : <?= date('d-m-Y') ?></h4>

    <section>
        <table style="width:100%" border="1" cellspacing="0">
            <tr>
                <th>No</th>
                <th>Nama petugas</th>
                <th>Nama peternak</th>
                <th>tanggal pembayaran</th>
                <th>Periode</th>
                <th>Total yang dibayarkan</th>
            </tr>
            <?php
            if (isset($_POST['date_start']) && isset($_POST['date_end'])) {
                $checkPeriode = isset($_POST['periode']) && $_POST['periode'] !== '' ? " AND periode = $periode" : '';
                $sql = "SELECT * FROM pembayaran JOIN petugas ON pembayaran.id_petugas_transaksi = petugas.id_petugas JOIN peternak ON pembayaran.id_peternak = peternak.id_peternak WHERE tanggal_pembayaran BETWEEN '$date_start' and '$date_end' $checkPeriode";
                $data = mysqli_query($conn, $sql);
            } else {
                //default tanpa filter
                $sql = "SELECT * FROM pembayaran JOIN petugas ON pembayaran.id_petugas_transaksi = petugas.id_petugas JOIN peternak ON pembayaran.id_peternak = peternak.id_peternak WHERE tanggal_pembayaran";
                $data = mysqli_query($conn, $sql);
            }

            $nomor = 1;
            
            ?>
            <?php while ($dataPembayaran = mysqli_fetch_array($data)) : ?>
                <tr>
                    <td><?= $nomor++ ?></td>
                    <td><?= $dataPembayaran['nama'] ?></td>
                    <td><?= $dataPembayaran['nama_pemilik'] ?></td>
                    <td style="text-align:center"><?= $dataPembayaran['tanggal_pembayaran'] ?></td>
                    <td style="text-align:center"><?= $dataPembayaran['periode'] ?></td>
                    <td>Rp. <?= $dataPembayaran['harga_total'] ?></td>
                </tr>
            <?php endwhile ?>
        </table>
    </section>
    <br>
    <br>
    <div id="signature">
        <div class="details">
            <div class="identity">
                <p>Malang, <?= date('d-m-Y') ?></p>
                <p>Admin</p>
            </div>
            <p><?= $_SESSION['nama'] ?></p>
        </div>
    </div>
</body>

</html>
<script>print()</script>