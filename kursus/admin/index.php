<?php 
	session_start();
	include '../dbconnect.php';
		
    // menghitung jumlah pesanan yang masih menunggu verifikasi
	$verifcount = mysqli_query($conn,"select count(id) as jumlahmenunggu from pendaftaran where status='waiting'");
	$verifcount2 = mysqli_fetch_assoc($verifcount);
	$verifcount3 = $verifcount2['jumlahmenunggu'];
	
    // menghitung jumlah kursus yang ada
	$coursecount = mysqli_query($conn,"select count(id) as jumlahkursus from kursus");
	$coursecount2 = mysqli_fetch_assoc($coursecount);
	$coursecount3 = $coursecount2['jumlahkursus'];
	
	?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="icon" 
      type="image/png" 
      href="../favicon.png">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
	
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- page container area start -->
    <div class="page-container">
        
        <!-- main content area start -->
        <div class="main-content">
                    
            <!-- page title area end -->
            <div class="main-content-inner">
			<?php include 'sidebar.php'; ?>
                
                <div class="sales-report-area mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="single-report mb-xs-30">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-hourglass-start"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Menunggu Verifikasi</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $verifcount3 ?></h1>
                                    </div>
									</div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="single-report">
                                <div class="s-report-inner pr--20 pt--30 mb-3">
                                    <div class="icon"><i class="fa fa-folder"></i></div>
                                    <div class="s-report-title d-flex justify-content-between">
                                        <h4 class="header-title mb-0">Jumlah Kursus</h4>
                                    </div>
                                    <div class="d-flex justify-content-between pb-2">
                                        <h1><?php echo $coursecount3 ?></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- overview area end -->
                <!-- market value area start -->
                
              
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
		
		
		

    </div>
    <!-- page container area end -->

</body>

</html>
