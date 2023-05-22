<?php 
    $title = 'Pencatatan Susu';
    include 'sidebarnav.php';
    include_once 'config.php';
 
    if (!isset($_SESSION['id_peternak'])) {
    header("Location: ../Auth/LoginPage.php");
    }
?>

<!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="align-self-center">
                            <h3 class="page-title mb-0 p-0">Pencatatan Susu</h3>
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
                                    <!-- <th>Protein</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = mysqli_query($conn, "SELECT * FROM pengumpulan_susu JOIN peternak ON pengumpulan_susu.id_peternak = peternak.id_peternak JOIN petugas ON pengumpulan_susu.id_petugas_pencatatan = petugas.id_petugas WHERE pengumpulan_susu.id_peternak='$_SESSION[id_peternak]'");
                                    
                                    $nomor = 1;

                                    while($data = mysqli_fetch_array($result)) {         
                                        echo "<tr>";
                                        echo "<td>".$nomor++."</td>";
                                        echo "<td>".$data['nama_pemilik']."</td>";
                                        echo "<td>".$data['nama']."</td>";
                                        echo "<td>".$data['tanggal_pengumpulan']."</td>";    
                                        echo "<td>".$data['kandungan_lemak']."</td>";    
                                        echo "<td>".$data['kandungan_protein']."</td>";    
                                        echo "<td>".$data['jumlah_liter']."</td>";    
                                        echo "<td>".$data['harga_susu']."</td>";    
                                        // echo "<td><a href='edit.php?id=$data[id]'>Edit</a> | <a href='delete.php?id=$data[id]'>Delete</a></td></tr>";        
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>        
            </div>
            <?php require_once('footer.php  ') ?>
        </div>
    <!-- ============================================================== -->
<!-- End Wrapper -->

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>