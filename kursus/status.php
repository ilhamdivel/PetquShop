<?php
session_start();
include 'header.php';

if(!isset($_SESSION['log'])){
	header('location:login.php');
}

include 'dbconnect.php';

$uid = $_SESSION['id'];
$mhsname = $_SESSION['name'];
$history = mysqli_query($conn,"select * from pendaftaran where mahasiswa_id='$uid'");
$fetch = mysqli_fetch_array($history);

?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat Pendaftaran Kursus</title>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

</head>
	
<body>

<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Konfirmasi</li>
			</ol>
		</div>
	</div>

<!-- kursus -->
	<div class="checkout">
		<div class="container">
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>ID Pendaftaran</th>	
							<th>Nama Kursus</th>
							<th>Nama Mahasiswa</th>
							<th>Status</th>
							<th>Tanggal</th>
							<th>Durasi</th>
						</tr>
					</thead>
					
					<?php 
    
						$item=mysqli_query($conn,"SELECT * from pendaftaran where mahasiswa_id='$uid' order by id ASC");
						while($p=mysqli_fetch_array($item)){
                            $idjadwal=$p['jadwal_id'];
                            $jadwal=mysqli_query($conn,"SELECT * from jadwal j where id=$idjadwal");
                            $j=mysqli_fetch_array($jadwal);
                            $idkursus=$j['kursus_id'];
                            $kursus=mysqli_query($conn,"SELECT * from kursus k where id=$idkursus");
                            $k=mysqli_fetch_array($kursus);
                            $idmhs=$p['mahasiswa_id'];
                            $mhs=mysqli_query($conn, "SELECT * from user where id=$idmhs");
                            $m=mysqli_fetch_array($mhs);

					?>
					<tr class="rem1"><form method="post">
						<td class="invert"><?php echo $p['id']?></td>
						<td class="invert"><?php echo $k['nama']?></td>
						<td class="invert"><?php echo $m['nama_mhs']?></td>
						<td class="invert"><?php echo $p['status']?></td>
						<td class="invert"><?php echo $j['tanggal']?></td>
						<td class="invert"><?php echo $k['durasi'] . " jam"?></td>					

					</tr>
					<?php
						}
					?>
				</table>
			</div>
		</div>
	</div>
</body>
</html>