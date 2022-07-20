<?php
session_start();
include 'dbconnect.php';
include 'header.php';
if(!isset($_SESSION['log'])){
	header('location:login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Daftar Kursus</title>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>

</head>
	
<body>

<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Daftar Kursus</li>
			</ol>

		</div>
	</div>
<!-- //breadcrumbs -->
<!-- kursus -->
	<div class="checkout">
		<div class="container">
			<div class="checkout-right">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>ID Kursus</th>	
							<th>Nama Kursus</th>
							<th>Keterangan</th>
							<th>Lama Kursus</th>
							<th>Daftar</th>
						</tr>
					</thead>
					
					<?php 
					
						$item=mysqli_query($conn,"SELECT * from kursus order by id ASC");
						while($k=mysqli_fetch_array($item)){

					?>
					<tr class="rem1"><form method="post">
						<td class="invert"><?php echo $k['id']?></td>
						<td class="invert"><?php echo $k['nama']?></td>
						<td class="invert"><?php echo $k['keterangan']?></td>
						<td class="invert"><?php echo $k['durasi'] . " jam"?></td>
						<td >
							<a href="konfirmasi.php?id=<?php echo $k['id']?>">Daftar</a>
						</td>						

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