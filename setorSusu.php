<?php 
    $title = "Setor Susu";
    include 'sidebarnav.php';
    include_once 'config.php';
    ob_start();
    $id = $_SESSION['id_petugas'];

    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] .':'.$_SERVER['SERVER_PORT'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        // $id_setor = $conn->real_escape_string($_POST['id_setor']);
        $id_petugas_setor = $id;
        $id_mitra = $conn->real_escape_string($_POST['id_mitra']);
        $jumlah = $conn->real_escape_string($_POST['jumlah']);
        $date = $conn->real_escape_string($_POST['date']);

        $sql = "INSERT INTO setor_susu (id_setor, id_petugas_setor , id_mitra , jumlah , date) VALUES (null, '$id_petugas_setor', '$id_mitra', '$jumlah', '$date')";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['update'])) {
        $id_setor = $conn->real_escape_string($_POST['update']);
        $id_petugas_setor = $conn->real_escape_string($_POST['id_petugas_setor']);
        $id_mitra = $conn->real_escape_string($_POST['id_mitra']);
        $jumlah = $conn->real_escape_string($_POST['jumlah']);
        $date = $conn->real_escape_string($_POST['date']);

        $sql = "UPDATE setor_susu SET id_petugas_setor = '$id_petugas_setor', id_mitra = '$id_mitra', jumlah = '$jumlah', date = '$date' WHERE id_setor = '$id_setor'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['delete'])) {
        $id_setor = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM setor_susu WHERE id_setor = '$id_setor'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
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
                        <div class="align-self-center d-flex gap-3">
                            <h3 class="page-title mb-0 p-0">Data Setor Susu</h3>
                        </div>
                    </div>
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <?php if(!isset($_GET['add'])&& !isset($_GET['edit'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Setor Susu<i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>
                    <!-- table  -->
                    <?php if(isset($_GET['add'])): 
                        $dataPetugas = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM Petugas WHERE id_petugas =" .$id));
                    ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="id_petugas_setor">Nama Petugas</label>
                                    <input type="text" class="form-control" id="id_petugas_setor" placeholder=" <?= $dataPetugas['nama']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_mitra">Mitra</label>
                                    <select id="id_mitra" name="id_mitra" class="form-control">
                                        <?php 
                                            $data=mysqli_query($conn, "SELECT * FROM mitra");
                                            while($dataMitra = mysqli_fetch_array($data)) { 
                                            ?>
                                                <option value="<?= $dataMitra['id_mitra']?>"> <?= $dataMitra['nama_mitra'] ?></option>

                                            <?php 
                                            };
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah Liter</label>
                                <input id="jumlah" name="jumlah" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input id="date" name="date" type="date" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-block btn-success" name="create">Tambah</button>
                        </form>
                    <?php endif?>

                    <?php if(isset($_GET['edit'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-group">
                                <label for="id_setor">ID Setor</label>
                                <input id="id_setor" name="id_setor" type="text" class="form-control" value="<?= $_GET['edit']?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="id_petugas_setor">ID_Petugas_Setor</label>
                                <input id="id_petugas_setor" name="id_petugas_setor" type="text" class="form-control" value="<?= $_GET['id_petugas_setor']?>">
                            </div>
                            <div class="form-group">
                                <label for="id_mitra">ID_Mitra</label>
                                <input id="id_mitra" name="id_mitra" type="text" class="form-control" value="<?= $_GET['id_mitra']?>">
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input id="jumlah" name="jumlah" type="text" class="form-control" value="<?= $_GET['jumlah']?>">
                            </div>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input id="date" name="date" type="text" class="form-control" value="<?= $_GET['date']?>">
                            </div>
                            <button type="submit" class="btn btn-block btn-success" name="update" value="<?= $_GET['edit']?>">Ubah</button>
                        </form>
                    <?php endif?>

                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                        <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Nama Mitra</th>
                                    <th>Alamat Mitra</th>
                                    <th>Jumlah Setor</th>
                                    <th>Tanggal Setor</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, "SELECT * FROM setor_susu 
                                                                    JOIN petugas ON setor_susu.id_petugas_setor = petugas.id_petugas
                                                                    JOIN mitra ON setor_susu.id_mitra = mitra.id_mitra"); 
                                $no = 1;?>
                                <?php while ($data = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['nama_mitra'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td><?= $data['jumlah'] ?></td>
                                        <td><?= $data['date'] ?></td>
                                        <td class="d-flex gap-3">
                                            <a class="btn btn-warning text-white" href="?edit=<?= $data['id_setor'] ?>&id_petugas_setor=<?= $data['id_petugas_setor']?>&id_mitra=<?= $data['id_mitra']?>&jumlah=<?= $data['jumlah']?>&date=<?= $data['date']?>">Ubah</a>

                                            <form action="" method="post">
                                                <button type="submit" class="swa-confirm btn btn-danger text-white" name="delete" value="<?= $data['id_setor'] ?>">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif?>

                    </div>
                </div>        
            </div>
            <?php require_once('footer.php') ?>
        </div>
    <!-- ============================================================== -->
<!-- End Wrapper -->

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