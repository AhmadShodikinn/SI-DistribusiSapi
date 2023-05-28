<?php 
 
include '../config.php';
 
error_reporting(0);
 
session_start();
 
    if (isset($_SESSION['username'])) {
        header("Location: ../dashboardPeternak.php");
        echo "<script>alert('LOGIN BERHASIL')</script>";
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet"> 

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

    <title>SI-SAPI | LOGIN</title>
</head>
<style>
    html{
        height: 100%;
        
    }
    body{
        height: 100%;
        display: flex;
        align-items : center;
    }
</style>
<body>
    <!-- <div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
    </div> -->
    <div class="container">
        <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="../assets/img/Sisapi.svg" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
            <div class="row justify-content-center">
                <div class="col-md-9">
                <div class="mb-4">
                <h3>Selamat Datang! </h3>
                <p class="mb-4">Silakan masukkan Username dan Password Anda untuk mengakses dashboard halaman.</p>
                </div>
                <form action="#" method="post">
                <div class="form-group first">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $username; ?>" required>

                </div>
                <div class="form-group last mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                    
                </div>
                
                <div class="d-flex mb-5 align-items-center">
                    <span class="ml-auto"><a href="./LoginAdmin.php" class="forgot-pass">Anda Admin?</a></span> 
                </div>

                <button name="submit" class="btn btn-block btn-primary">MASUK</button>
                </form>
                <?php 
                    if (isset($_POST['submit'])) {
                        $username = $_POST['username'];
                        $password = ($_POST['password']);
                        
                        $sql = "SELECT * FROM peternak JOIN roles ON peternak.id_roles = roles.id_role WHERE peternak.username = '$username' AND peternak.password = '$password'";
                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            $row = mysqli_fetch_assoc($result);
                            $_SESSION['id_peternak'] = $row['id_peternak'];
                            $_SESSION['nama_pemilik'] = $row['nama_pemilik'];
                            $_SESSION['nama_roles'] = $row['nama_roles'];
                            
                            echo "<script> 
                            Swal.fire({
                                title: 'Success!',
                                text: 'Login Berhasil',
                                icon: 'success',
                                heightAuto: false
                                })
                
                            setTimeout(function(){
                                window.location.href = '../dashboard.php';
                            }, 2000);
                            </script>";
                
                        } else {
                            echo "<script> 
                            Swal.fire({
                                title: 'Error!',
                                text: 'Username atau Password Salah',
                                icon: 'error',
                                confirmButtonText: 'kembali',
                                heightAuto: false
                                })
                            </script>";
                        }
                    }
                ?>
                </div>
            </div>
            </div>
      </div>
    </div>
</div>


    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>
</html>