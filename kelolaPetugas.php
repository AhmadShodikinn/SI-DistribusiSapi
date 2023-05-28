<?php 
    $title = 'Petugas';
    include 'sidebarnav.php';
    include_once 'config.php';
    ob_start();

    $redirect_path = 'http://' . $_SERVER['SERVER_NAME'] .':'.$_SERVER['SERVER_PORT'] . $_SERVER['PHP_SELF'] ;
    if(isset($_POST['create'])) {
        
        $nama = $conn->real_escape_string($_POST['nama']);
        $no_hp = $conn->real_escape_string($_POST['no_hp']);
        $alamat = $conn->real_escape_string($_POST['alamat']);
        $username = $conn->real_escape_string($_POST['username']);
        $id_role = $conn->real_escape_string($_POST['id_role']);

        $sql = "INSERT INTO petugas (id_petugas, nama , no_hp, alamat, username, id_role) VALUES ('$id_petugas', '$nama', '$no_hp', '$alamat', '$username', '$id_role')";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['update'])) {
        $id_petugas = $conn->real_escape_string($_POST['update']);
        $nama = $conn->real_escape_string($_POST['nama']);
        $no_hp = $conn->real_escape_string($_POST['no_hp']);
        $alamat = $conn->real_escape_string($_POST['alamat']);
        $username = $conn->real_escape_string($_POST['username']);
        $id_role = $conn->real_escape_string($_POST['id_role']);



        $sql = "UPDATE petugas SET nama = '$nama', no_hp = '$no_hp', alamat = '$alamat', username = '$username', id_role = '$id_role'  WHERE id_petugas = '$id_petugas'";
        $conn->query($sql) or die(mysqli_error($conn));
        ?>
        <script>
            window.location.assign("<?= $redirect_path?>")
        </script>
        <?php
    }  
    
    if (isset($_POST['delete'])) {
        $id_petugas = $conn->real_escape_string($_POST['delete']);
        $sql = "DELETE FROM petugas WHERE id_petugas = '$id_petugas'";
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
                            <h3 class="page-title mb-0 p-0">Data Petugas</h3>
                        </div>
                    </div>
                    <div class="mt-4 align-items-right">
                        <div class="text-end upgrade-btn">
                            <?php if(!isset($_GET['add']) && !isset($_GET['edit'])): ?>
                                <a href="?add=true"
                                class="btn btn-success d-none d-md-inline-block text-white">Add Data Petugas <i class="fa-solid fa-plus"></i></a>
                            <?php endif?>
                        </div>
                    </div>
                    <!-- table  -->
                    <?php if(isset($_GET['add'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Hp</label>
                                <input id="no_hp" name="no_hp" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" name="username" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="id_role">Nama Role</label>
                                <input id="id_role" name="id_role" type="text" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-block btn-success" name="create">Tambah</button>
                        </form>
                    <?php endif?>

                    <?php if(isset($_GET['edit'])): ?>
                        <form class="mt-2" action="" method="post">
                            <div class="form-group">
                                <label for="id_petugas">Id Petugas</label>
                                <input id="id_petugas" name="id_petugas" type="text" class="form-control" value="<?= $_GET['edit']?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" value="<?= $_GET['nama']?>">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Hp</label>
                                <input id="no_hp" name="no_hp" type="text" class="form-control" value="<?= $_GET['no_hp']?>">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input id="alamat" name="alamat" type="text" class="form-control" value="<?= $_GET['alamat']?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" name="no_hp" type="text" class="form-control" value="<?= $_GET['username']?>">
                            </div>
                            <div class="form-group">
                                <label for="id_role">Nama Role</label>
                                <input id="id_role" name="id_role" type="text" class="form-control" value="<?= $_GET['id_role']?>">
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
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Alamat</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, "SELECT * FROM petugas JOIN roles ON petugas.id_role = roles.id_role"); 
                                    $number = 1;
                                ?>
                                <?php while ($data = mysqli_fetch_array($result)): 
                                    ?>
                                    <tr>
                                        <td><?= $number++ ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td><?= $data['no_hp'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td><?= $data['username'] ?></td>
                                        <td><?= $data['nama_roles'] ?></td>
                                        <td class="d-flex gap-3">
                                            <a class="btn bg-warning text-white" href="?edit=<?= $data['id_petugas'] ?>&nama=<?= $data['nama']?>&no_hp=<?= $data['no_hp']?>&alamat=<?= $data['alamat']?>&username=<?= $data['username']?>&id_role=<?= $data['id_role']?>">Ubah</a>

                                            <form action="" method="post">
                                                <button type="submit" class="swa-confirm btn bg-danger text-white" name="delete" value="<?= $data['id_petugas'] ?>">Hapus</button>
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