<?php 
    include 'sidebarnav.php';
    include_once 'config.php';
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
                                    <th>id pengumpulan susu</th>
                                    <th>id peternak</th>
                                    <th>id petugas pencatatan</th>
                                    <th>kandungan lemak</th>
                                    <th>jumlah</th>
                                    <th>harga susu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $result = mysqli_query($conn, "SELECT * FROM pengumpulan_susu");
                                    
                                    while($data = mysqli_fetch_array($result)) {         
                                        echo "<tr>";
                                        echo "<td>".$data['id_pengumpulan_susu']."</td>";
                                        echo "<td>".$data['id_peternak']."</td>";
                                        echo "<td>".$data['id_petugas_pencatatan']."</td>";    
                                        echo "<td>".$data['kandungan_lemak']."</td>";    
                                        echo "<td>".$data['jumlah']."</td>";    
                                        echo "<td>".$data['harga_susu']."</td>";    
                                        // echo "<td><a href='edit.php?id=$data[id]'>Edit</a> | <a href='delete.php?id=$data[id]'>Delete</a></td></tr>";        
                                    }
                                ?>
                                
                                <tr>
                                    <td>Diki</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011-04-25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    </div>
                </div>        
            </div>

        
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © <?= date('Y') ?> by Workshop
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
    <!-- ============================================================== -->
<!-- End Wrapper -->

<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>