<?php
$title = "Laporan Pembayaran";
include 'sidebarnav.php';
include_once 'config.php';
?>

<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-breadcrumb">
            <div class="row align-align-items-center">
                <div class="align-self-center">
                    <h3 class="page-title mb-0 p-0">Laporan Pembayaran</h3s>
                </div>
                <div class="container mt-4 d-flex  gap-2">
                    <div class="d-flex gap-3 w-100">
                        <form action="cetakPembayaranPeternak.php" method="post" class="d-flex gap-2 w-100">
                            <div class="form-group">
                                <label class="col-form-label">Periode Pembayaran</label>
                            </div>
                            <div class="form-group">
                                <input id="date_start" name="date_start" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <input id="date_end" name="date_end" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <select name="periode" class="form-control">
                                    <option value="">Periode</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button name="cari" class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                        <form action="./export/LaporanPembayaran.php" method="post" class="d-flex align-items-start w-80 ">
                            <?php if (isset($_POST['date_start']) && isset($_POST['date_end']) && isset($_POST['periode'])) : ?>
                                
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <input type="hidden" name="date_start" value="<?= $_POST['date_start'] ?>">
                                        <input type="hidden" name="date_end" value="<?= $_POST['date_end'] ?>">
                                        <input type="hidden" name="periode" value="<?= $_POST['periode'] ?>">
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
                                <th>Nama petugas</th>
                                <th>Nama peternak</th>
                                <th>tanggal pembayaran</th>
                                <th>Periode pembayaran</th>
                                <th>Total yang dibayarkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['date_start']) && isset($_POST['date_end']) ) {
                                $date_start = $_POST['date_start'];
                                $date_end = $_POST['date_end'];
                                $checkPeriode = isset($_POST['periode']) && $_POST['periode'] !== '' ? " AND periode = {$_POST['periode']}" : '';
                                $sql = "SELECT * FROM pembayaran JOIN petugas ON pembayaran.id_petugas_transaksi = petugas.id_petugas JOIN peternak ON pembayaran.id_peternak = peternak.id_peternak WHERE tanggal_pembayaran BETWEEN '$date_start' and '$date_end' $checkPeriode";
                                $data = mysqli_query($conn, $sql);
                            } else {
                                //default tanpa filter
                                $sql = "SELECT * FROM pembayaran JOIN petugas ON pembayaran.id_petugas_transaksi = petugas.id_petugas JOIN peternak ON pembayaran.id_peternak = peternak.id_peternak";
                                $data = mysqli_query($conn, $sql);
                            }
                            $_SESSION['dataPembayaran'] = $data;
                            $nomor = 1;
                            while ($dataPembayaran = mysqli_fetch_array($data)) { ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $dataPembayaran['nama'] ?></td>
                                    <td><?= $dataPembayaran['nama_pemilik'] ?></td>
                                    <td><?= $dataPembayaran['tanggal_pembayaran'] ?></td>
                                    <td><?= $dataPembayaran['periode'] ?></td>
                                    <td><?= $dataPembayaran['harga_total'] ?></td>
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