<?php 
    // penting buat templating sidebar sama nav nya
    $title = 'Dashboard';
    include 'sidebarnav.php'
?>     
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="page-title mb-0 p-0">Dashboard</h3>
                    </div>
                    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->

            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <div class="row">
                    <!-- Column -->
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Peternak</h4>
                                <div class="text-end">
                                    <?php 
                                        include 'config.php';
                                        $sql = "SELECT * FROM Peternak";

                                        if ($result = mysqli_query($conn, $sql)) {
                                        
                                            // Return the number of rows in result set
                                            $rowcount = mysqli_num_rows( $result );;
                                         }
                                    ?>
                                    <h2 class="font-light mb-0"><?= $rowcount ?> Peternak</h2>
                                </div>
                                <span class="text-success">80%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: 80%; height: 7px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Petugas</h4>
                                <div class="text-end">
                                    <?php 
                                        include 'config.php';
                                        $sql = "SELECT * FROM Petugas";

                                        if ($result = mysqli_query($conn, $sql)) {
                                        
                                            // Return the number of rows in result set
                                            $rowcount = mysqli_num_rows( $result );;
                                         }
                                    ?>
                                    <h2 class="font-light mb-0"><?= $rowcount ?> Petugas</h2>
                                    <!-- <span class="text-muted">Todays Income</span> -->
                                </div>
                                <span class="text-info">30%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Jumlah Mitra</h4>
                                <div class="text-end">
                                    <?php 
                                        include 'config.php';
                                        $sql = "SELECT * FROM Mitra";

                                        if ($result = mysqli_query($conn, $sql)) {
                                        
                                            // Return the number of rows in result set
                                            $rowcount = mysqli_num_rows( $result );
                                         }
                                    ?>
                                    <h2 class="font-light mb-0"><?= $rowcount ?> Mitra</h2>
                                    <!-- <span class="text-muted">Todays Income</span> -->
                                </div>
                                <span class="text-success">80%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- column -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Revenue Statistics</h4>
                                <div class="flot-chart">
                                    <div class="flot-chart-content " id="flot-line-chart"
                                        style="padding: 0px; position: relative;">
                                        <canvas class="flot-base w-100" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- column -->
                </div>
                <div class="row justify-content-center">
                    <!-- <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <img class="card-img-top img-responsive" src="../assets/img/big/img4.jpg" alt="Card">
                            <div class="card-body">
                                <ul class="list-inline d-flex align-items-center">
                                    <li class="ps-0">20 May 2021</li>
                                    <li class="ms-auto"><a href="javascript:void(0)" class="link">3 Comment</a></li>
                                </ul>
                                <h3 class="font-normal">Featured Hydroflora Pots Garden &amp; Outdoors</h3>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
           <?php require_once('footer.php') ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->