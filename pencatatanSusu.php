<?php 
    $title = "pencatatan susu";
    include_once 'config.php';
    require 'sidebarnav.php';

    $tz = 'Asia/Jakarta';
    $dt = new DateTime("now", new DateTimeZone($tz));
    $timestamp = $dt->format('Y-m-d');
    
    //insert session
    $id = $_SESSION['id_petugas'];
    ob_start();

    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] .':'.$_SERVER['SERVER_PORT'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        $id_peternak = $conn->real_escape_string($_POST['id_peternak']);
        $id_petugas = $id;
        $tanggal = $timestamp;
        $lemak = $conn->real_escape_string($_POST['lemak']);
        $protein = $conn->real_escape_string($_POST['protein']);
        $tLiter = $conn->real_escape_string($_POST['total_liter']);
        $hLiter = $conn->real_escape_string($_POST['harga_liter']);
        $hTotal = ((int)$tLiter * (int)$hLiter);
        // $datetime = $conn->real_escape_string($_POST['datetime']);

        $sql = "INSERT INTO pengumpulan_susu (id_pengumpulan_susu, id_peternak, id_petugas_pencatatan, tanggal_pengumpulan, kandungan_lemak, kandungan_protein, jumlah_liter, harga_susu, harga_total) VALUES (NULL, '$id_peternak', '$id_petugas','$tanggal', '$lemak', '$protein', '$tLiter', '$hLiter', '$hTotal')";
        die($sql);
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            Swal.fire({
            title: 'Success!',
            text: 'Tambah Data Berhasil',
            icon: 'success',
            heightAuto: false
            })

            setTimeout(() => {
                window.location.assign("<?= $redirect_path?>")
            }, 2000);
        </script>
        <?php
    }  


    if (isset($_POST['delete'])) {
        $id_kumpul = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM pengumpulan_susu WHERE id_pengumpulan_susu = '$id_kumpul'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            Swal.fire({
            title: 'Success!',
            text: 'Delete Data Berhasil',
            icon: 'success',
            heightAuto: false
            })

            setTimeout(() => {
                window.location.assign("<?= $redirect_path?>")
            }, 2000);
        </script>
        <?php
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
                    </div>
                    <!-- table  -->
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Baru <i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>

                    <!-- table  -->
                    <?php if(isset($_GET['add'])): 
                    
                        //fetch data session login
                        
                        $dataPetugas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Petugas WHERE id_petugas =" .$id));
                    ?>
                        <form action="" method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="name">Tanggal & Waktu</label>
                            <input type="text" class="form-control" id="datetime" name="datetime" placeholder=" <?= $timestamp?>"disabled>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="name">Nama Petugas</label>
                            <input type="text" class="form-control" id="id_petugas" placeholder=" <?= $dataPetugas['nama']?>" disabled>
                            </div>
                        </div> 
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="name">nama peternak</label>
                            <select id="id_peternak" name="id_peternak" class="form-control">
                                <?php 
                                    $data=mysqli_query($conn, "SELECT * FROM Peternak");
                                    while($dataPeternak = mysqli_fetch_array($data)) { 
                                    ?>
                                        <option value="<?= $dataPeternak['id_peternak']?>"> <?= $dataPeternak['nama_pemilik'] ?></option>

                                    <?php 
                                    };
                                ?>
                            </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Kandungan Lemak</label>
                                <input type="text" class="form-control" id="lemak" name="lemak" placeholder="Lemak" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputCity">Kandungan Protein</label>
                                <input type="text" class="form-control" id="protein" name="protein" placeholder="Protein" required>
                            </div>
                        </div>  
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label for="inputCity">Total Liter</label>
                                <input type="number" class="form-control" id="total_liter" name="total_liter" placeholder="Total Liter" required>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputCity">Harga per-Liter</label>
                                <input type="text" class="form-control" id="harga_liter" name="harga_liter" placeholder="Masukkan Harga">
                            </div>
                        </div>          
                                    
                        <div class="form-group"> 
                            <button type="submit" class="btn btn-success fa-plus" name="create"> Tambah Data</button>
                        </div>
                    </form>
                    <?php endif?>


                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>                      
                        <div class="my-4">
                            <table id="example" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Petugas</th>
                                        <th>Tanggal</th>
                                        <th>Nama Peternak</th>
                                        <th>Lemak</th>
                                        <th>Jumlah</th>
                                        <th>Harga Susu</th>
                                        <th>Harga Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $result = mysqli_query($conn, "SELECT * FROM pengumpulan_susu ps JOIN peternak pe ON pe.id_peternak = ps.id_peternak JOIN petugas pet ON pet.id_petugas = ps.id_petugas_pencatatan; ");
                                        $number = 1;
                                        while($data = mysqli_fetch_array($result)):  ?>     
                                            <tr>
                                                <td><?=  $number++ ?></td>
                                                <td><?= $data['nama'] ?></td>
                                                <td><?= $data['tanggal_pengumpulan'] ?></td>
                                                <td><?= $data['nama_pemilik']?></td>  
                                                <td><?= $data['kandungan_lemak']?></td>    
                                                <td><?= $data['jumlah_liter']?></td>    
                                                <td><?= $data['harga_susu']?></td>    
                                                <td><?= $data['harga_total']?></td>    
                                                <td>
                                                    <form action="" method="post">
                                                        <button type="submit" class="swa-confirm btn bg-danger text-white" name="delete" value="<?= $data['id_pengumpulan_susu'] ?>">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endwhile ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif ?>                
                    </div>
                </div>        
            </div>

            <?php require_once('footer.php'); ?>

<script>
        $(document).ready(function () {
        $('#example').DataTable();
        });

        $(".swa-confirm").click(function(e) {
                if (!e.originalEvent.isTrusted)
                return;

            
            e.preventDefault(); 

            Swal.fire({
                title: "Hapus Data?",
                text:"Apakah anda ingin mengahapus data ini?",
                type: "warning",
                icon : 'warning',
                showCancelButton: true,
                confirmButtonColor: "#cc3f44",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal",
                closeOnConfirm: true,
                html: false
            }).then(function(result) {
                if (result.value) {
                    e.target.click();
                } else {
                    return false;
                }
            })
        });
</script>
            

