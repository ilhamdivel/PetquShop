<?php 
	session_start();
	include '../dbconnect.php';
			
	if(isset($_POST["addsched"])) {
		$scheddate=$_POST['tgl'];
		$courseid=$_POST['idkursus'];

		$add=mysqli_query($conn, "INSERT into jadwal (kursus_id, tanggal) VALUES ('$courseid', '$scheddate')");
		if(!$add){ 
			// Jika Gagal, Lakukan :
			echo "Sorry, there's a problem while submitting.";
			echo "<br><meta http-equiv='refresh' content='5; URL=jadwal.php'> You will be redirected to the form in 3 seconds";
		}
	}
	
	if(isset($_POST['updatesched'])){
        $id=$_POST['id'];
		$scheddate=$_POST['tgl'];
		$courseid=$_POST['idkursus'];

		$edit=mysqli_query($conn, "UPDATE jadwal SET kursus_id='$courseid', tanggal='$scheddate' WHERE id=$id");
		if(!$edit){ 
			// Jika Gagal, Lakukan :
			echo "Sorry, there's a problem while submitting.";
			echo "<br><meta http-equiv='refresh' content='5; URL=jadwal.php'> You will be redirected to the form in 5 seconds";
		}	
	}
	?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
	
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
	<!-- Start datatable css -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
	
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body>
    <!-- page container area start -->
    <div class="page-container">
        <?php include 'sidebar.php' ?>
        <!-- main content area start -->
        <div class="main-content">
            
            <!-- page title area end -->
            <div class="main-content-inner">
               
                <!-- market value area start -->
                <div class="row mt-5 mb-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-center">
									<h2>Jadwal Kursus</h2>
									<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2">Tambah Jadwal Baru</button>
                                </div>
                                    <div class="data-tables datatable-dark">
										 <table id="dataTable3" class="display" style="width:100%"><thead class="thead-dark">
											<tr>
												<th>ID Jadwal</th>	
												<th>Nama Kursus</th>
												<th>Tanggal</th>
												<th>Edit</th>
											</tr></thead><tbody>
											<?php 
											$jadwal=mysqli_query($conn,"SELECT * from jadwal j");
											while($j=mysqli_fetch_array($jadwal)){
                                                $idkursus=$j['kursus_id'];
                                                $course=mysqli_query($conn,"SELECT * from kursus k where id=$idkursus");
                                                $k=mysqli_fetch_array($course);

												?>
												
												<tr>
													<td><?php echo $j['id'] ?></td>
													<td><?php echo $k['nama'] ?></td>
													<td><?php echo $j['tanggal'] ?></td>
													<td>
													<button data-toggle="modal" data-target="#editModal<?php echo $j['id'] ?>" class="align-middle btn btn-success">Edit</button>
														
													<div id="editModal<?php echo $j['id'] ?>" class="modal fade" style="text-align: left;">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<h4 class="modal-title">Edit Jadwal</h4>
																</div>
																<div class="modal-body">
																<form action="jadwal.php" method="post" enctype="multipart/form-data" >
																	<input type="hidden", name="id", type=text, value="<?= $j['id'] ?>" >
																	<div class="form-group">
																		<label>Tanggal</label>
																		<input name="tgl" type="date" class="form-control", value="<?= $j['tanggal'] ?>">
																	</div>
																	<div class="form-group">
                                                                        <label>Nama Kursus</label>
                                                                        <select name="idkursus" class="form-control">

                                                                        <?php
                                                                        $det=mysqli_query($conn,"select * from kursus")or die(mysqli_error());
                                                                        while($d=mysqli_fetch_array($det)){
                                                                        ?>
                                                                            <option value="<?php echo $d['id'] ?>"><?php echo $d['nama'] ?></option>
                                                                            <?php
                                                                    }
                                                                    ?>
                                                                        </select>
                                                                    </div>

																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																	<input name="updatesched" type="submit" class="btn btn-primary" value="Update">
																</div>
																</form>
															</div>
														</div>
													</div>
													</td>
												</tr>		
												
												<?php 
											}
											?>
										</tbody>
										</table>
                                    </div>
								 </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                
                <!-- row area start-->
            </div>
        </div>
        <!-- main content area end -->
    </div>
    <!-- page container area end -->
	
	<!-- modal input -->
	<div id="myModal" class="modal fade">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title">Tambah Jadwal</h4>
						</div>
						
						<div class="modal-body">
						<form action="jadwal.php" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input name="tgl" type="date" class="form-control", value="<?= $j['tanggal'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Nama Kursus</label>
                            <select name="idkursus" class="form-control">

                            <?php
                            $det=mysqli_query($conn,"select * from kursus")or die(mysqli_error());
                            while($d=mysqli_fetch_array($det)){
                            ?>
                                <option value="<?php echo $d['id'] ?>"><?php echo $d['nama'] ?></option>
                                <?php
                        }
                        ?>
                            </select>
                        </div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
							<input name="addsched" type="submit" class="btn btn-success" value="Submit">
						</div>
						</form>
					</div>
				</div>
			</div>
	
	
	<!-- jquery latest version -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>
		<!-- Start datatable js -->
	 <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
	
</body>
</html>
