<?php
$title = "Laporan Pembayaran";
include 'sidebarnav.php';
include_once 'config.php';
$id = $_SESSION['id_peternak'];
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-breadcrumb">
            <div class="row align-align-items-center">
                <div class="align-self-center">
                    <h3 class="page-title mb-0 p-0">Laporan Pencatatan</h3>
                </div>
                <div class="container mt-4 d-flex  gap-2">
                    <div class="d-flex gap-3 w-100">
                        <form action="cetakPencatatanPeternak.php" method="post" class="d-flex gap-2 w-100">
                            <div class="form-group">
                                <label class="col-form-label">Periode Pencatatan</label>
                            </div>
                            <div class="form-group">
                                <input id="date_start" name="date_start" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="date_end" name="date_end" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <button name="cari" class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                        <form action="./export/LaporanPencatatanPeternak.php" method="post" class="d-flex align-items-start w-80 ">
                            <?php if (isset($_POST['date_start']) && isset($_POST['date_end'])) : ?>
                                
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <input type="hidden" name="date_start" value="<?= $_POST['date_start'] ?>">
                                        <input type="hidden" name="date_end" value="<?= $_POST['date_end'] ?>">
                                        <!-- <a href="./export/LaporanPembayaran.php">Print</a> -->
                                    </div>
                                </div>
                                <?php endif ?>
                            <button name="print" class="btn btn-primary" type="submit">Print</button>
                        </form>
                    </div>
                </div>


                <!-- table  -->
                <div class="my-4">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peternak</th>
                                <th>Nama Pencatatan</th>
                                <th>Tanggal Pengumpulan</th>
                                <th>Lemak</th>
                                <th>Protein</th>
                                <th>Harga Susu</th>
                                <th>Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['date_start']) && isset($_POST['date_end']) ) {
                                $date_start = $_POST['date_start'];
                                $date_end = $_POST['date_end'];
                                $sql = "SELECT * FROM pengumpulan_susu JOIN peternak ON pengumpulan_susu.id_peternak = peternak.id_peternak JOIN petugas ON pengumpulan_susu.id_petugas_pencatatan = petugas.id_petugas WHERE pengumpulan_susu.id_peternak='$_SESSION[id_peternak]' AND pengumpulan_susu.tanggal_pengumpulan BETWEEN '$date_start' AND '$date_end'";
                                $data = mysqli_query($conn, $sql);
                            } else {
                                //default tanpa filter
                                $sql = "SELECT * FROM pengumpulan_susu JOIN peternak ON pengumpulan_susu.id_peternak = peternak.id_peternak JOIN petugas ON pengumpulan_susu.id_petugas_pencatatan = petugas.id_petugas WHERE pengumpulan_susu.id_peternak='$_SESSION[id_peternak]' ";
                                $data = mysqli_query($conn, $sql);
                            }
                            $_SESSION['dataPembayaran'] = $data;
                            $nomor = 1;
                            while ($dataPencatatan = mysqli_fetch_array($data)) { ?>
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

                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <?php require_once('footer.php') ?>

    <script>
        $(document).ready(() => {
            $('#example').DataTable();

            //logic set disable before insert first date
            document.getElementById('date_end').disabled = true;
            var dis = document.getElementById('date_start');
            dis.onchange = () => {
                if (dis.value == " ") {
                    document.getElementById('date_end').disabled = true;
                } else
                    document.getElementById('date_end').disabled = false;
            }


            //logic date
            const month = new Date().getMonth();
            const year = new Date().getFullYear();

            const dateTrailing = (str) => str.toString().padStart(2, '0')

            const init = () => {
                $('#date_start').on('change', function() {
                    const val = $(this).val()
                    $('#date_end').attr({
                        min: val
                    })
                })

                const min = val => {
                    const date = new Date(val)
                    const month = date.getMonth()
                    const year = date.getFullYear()
                    return `${year}-${dateTrailing(month + 1)}-10`
                }

                // $('#date_start').attr({max})
                $('#date_end').attr({
                    min
                })
            }

            init()


        })
    </script>