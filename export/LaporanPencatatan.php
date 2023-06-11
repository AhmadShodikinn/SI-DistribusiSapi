<?php
ob_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/SI-DISTRIBUSISAPI/config.php';
session_start();


if (isset($_POST['print']) && isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['id_peternak']) ) {
    $date_start = $_POST['date_start'];
    $date_end = $_POST['date_end'];
    $id_peternak = $_POST['id_peternak'];
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
                <th>Nama Peternak</th>
                <th>Nama Petugas</th>
                <th>Tanggal Pengumpulan</th>
                <th>Lemak</th>
                <th>Protein</th>
                <th>Harga Susu</th>
                <th>Harga Total</th>
            </tr>
            <?php
            if (isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['id_peternak']) ) {
                $date_start = $_POST['date_start'];
                $date_end = $_POST['date_end'];
                $id_peternak = $_POST['id_peternak'];
                if($id_peternak != "default"){
                    $sql = "SELECT * FROM pengumpulan_susu ps JOIN peternak pe ON pe.id_peternak = ps.id_peternak JOIN petugas pet ON pet.id_petugas = ps.id_petugas_pencatatan WHERE ps.id_peternak='$id_peternak' AND ps.tanggal_pengumpulan BETWEEN '$date_start' AND '$date_end'";
                    $data = mysqli_query($conn, $sql);
                } else {
                    $sql = "SELECT * FROM pengumpulan_susu ps JOIN peternak pe ON pe.id_peternak = ps.id_peternak JOIN petugas pet ON pet.id_petugas = ps.id_petugas_pencatatan WHERE ps.tanggal_pengumpulan BETWEEN '$date_start' AND '$date_end'";
                    $data = mysqli_query($conn, $sql);
                }
            } else if (isset($_POST['date_start']) && isset($_POST['date_end'])) {
                $date_start = $_POST['date_start'];
                $date_end = $_POST['date_end'];
                $sql = "SELECT * FROM pengumpulan_susu ps JOIN peternak pe ON pe.id_peternak = ps.id_peternak JOIN petugas pet ON pet.id_petugas = ps.id_petugas_pencatatan WHERE ps.tanggal_pengumpulan BETWEEN '$date_start' AND '$date_end'";
                $data = mysqli_query($conn, $sql);
            } else {
                //default tanpa filter
                $sql = "SELECT * FROM pengumpulan_susu ps JOIN peternak pe ON pe.id_peternak = ps.id_peternak JOIN petugas pet ON pet.id_petugas = ps.id_petugas_pencatatan;";
                $data = mysqli_query($conn, $sql);
            }

            $nomor = 1;
            
            ?>
            <?php while ($dataPencatatan = mysqli_fetch_array($data)) : ?>
                <tr>
                <td><?= $nomor++ ?></td>
                <td><?= $dataPencatatan['nama_pemilik'] ?></td>
                <td><?= $dataPencatatan['nama'] ?></td>
                <td><?= $dataPencatatan['tanggal_pengumpulan'] ?></td>
                <td><?= $dataPencatatan['kandungan_lemak'] ?></td>
                <td><?= $dataPencatatan['kandungan_protein'] ?></td>
                <td><?= $dataPencatatan['jumlah_liter'] ?></td>
                <td>Rp. <?= $dataPencatatan['harga_susu'] ?></td>
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
                <p>Petugas</p>
            </div>
            <p><?= $_SESSION['nama'] ?></p>
        </div>
    </div>
</body>

</html>
<script>print()</script>