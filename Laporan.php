<?php 
    $title = "Laporan Pembayaran";
    include 'sidebarnav.php';
    include_once 'config.php';
    $id = $_SESSION['id_petugas'];
?>

<div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="align-self-center">
                            <h3 class="page-title mb-0 p-0">Laporan Pembayaran Peternak</h3s>
                        </div>

                    <div class="container mt-4">
                        <form action="Laporan.php" method="GET">
                            <div class="form-row">
                                <div class="form-group col-auto">
                                    <label class="col-form-label">Periode Pembayaran</label>
                                </div>
                                <div class="form-group col-md-3">
                                    <input id="date_start" name="date_start" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <input id="date_end" name="date_end" type="date" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <button class="btn btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    


                    <!-- table  -->
                    <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama petugas</th>
                                    <th>Nama peternak</th>
                                    <th>tanggal pembayaran</th>
                                    <th>Periode pembayaran</th>
                                    <th>Total yang dibayarkan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                if(isset($_GET['date_start']) && isset($_GET['date_end'])){
                                    $data = mysqli_query($conn, "SELECT * FROM pembayaran JOIN petugas ON pembayaran.id_petugas_transaksi = petugas.id_petugas JOIN peternak ON pembayaran.id_peternak = peternak.id_peternak WHERE tanggal_pembayaran BETWEEN '".$_GET['date_start']."' and '".$_GET['date_end']."'");
                                }else{
                                //default tanpa filter
                                    $data = mysqli_query($conn, "SELECT * FROM pembayaran JOIN petugas ON pembayaran.id_petugas_transaksi = petugas.id_petugas JOIN peternak ON pembayaran.id_peternak = peternak.id_peternak WHERE tanggal_pembayaran");	
                                }

                                $nomor = 1;
                                while($dataPembayaran = mysqli_fetch_array($data)){ ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $dataPembayaran['nama'] ?></td>
                                    <td><?= $dataPembayaran['nama_pemilik'] ?></td>
                                    <td><?= $dataPembayaran['tanggal_pembayaran'] ?></td>
                                    <td><?= $dataPembayaran['periode'] ?></td>
                                    <td><?= $dataPembayaran['harga_total'] ?></td>
                                </tr>   
                                
                                <?php
                            }?>
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>        
        </div>

        <?php require_once('footer.php') ?>