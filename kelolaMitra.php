<?php 
    $title = 'Mitra';
    include 'sidebarnav.php';
    include_once 'config.php';
    ob_start();

    
    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] .':'.$_SERVER['SERVER_PORT'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        $nama = $conn->real_escape_string($_POST['nama']);
        $alamat = $conn->real_escape_string($_POST['alamat']);

        $sql = "INSERT INTO mitra (nama_mitra , alamat) VALUES ('$nama', '$alamat')";
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
    
    if (isset($_POST['update'])) {
        $id_mitra = $conn->real_escape_string($_POST['update']);
        $nama = $conn->real_escape_string($_POST['nama']);
        $alamat = $conn->real_escape_string($_POST['alamat']);

        $sql = "UPDATE mitra SET nama_mitra = '$nama', alamat = '$alamat' WHERE id_mitra = '$id_mitra'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            Swal.fire({
            title: 'Success!',
            text: 'Edit Data Berhasil',
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
        $id_mitra = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM mitra WHERE id_mitra = '$id_mitra'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            Swal.fire({
            title: 'Success!',
            text: 'Hapus Data Berhasil',
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
                        <div class="align-self-center d-flex gap-3">
                            <h3 class="page-title mb-0 p-0">Data Mitra</h3>
                        </div>
                    </div>
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <?php if(!isset($_GET['add'])&& !isset($_GET['edit'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Mitra <i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>
                    <!-- table  -->
                    <?php if(isset($_GET['add'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-block btn-success" name="create">Tambah</button>
                        </form>
                    <?php endif?>

                    <?php if(isset($_GET['edit'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" value="<?= $_GET['nama_mitra']?>" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control" value="<?= $_GET['alamat']?>" required>
                            </div>
                            <button type="submit" class="btn btn-block btn-success" name="update" value="<?= $_GET['edit']?>">Ubah</button>
                        </form>
                    <?php endif?>

                    <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                        <div class="my-4">
                        <table id="example" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Mitra</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, "SELECT * FROM mitra"); ?>
                                <?php while ($data = mysqli_fetch_array($result)): ?>
                                    <tr>
                                        <td><?= $data['id_mitra'] ?></td>
                                        <td><?= $data['nama_mitra'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td class="d-flex gap-3">
                                            <a class="btn bg-warning text-white" href="?edit=<?= $data['id_mitra'] ?>&nama_mitra=<?= $data['nama_mitra']?>&alamat=<?= $data['alamat']?>">Ubah</a>

                                            <form action="" method="post">
                                                <button type="submit" class="swa-confirm btn bg-danger text-white" name="delete" value="<?= $data['id_mitra'] ?>">Hapus</button>
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