<?php
session_start();
include 'header.php';

if(!isset($_SESSION['log'])){
	header('location:login.php');
}

$idkursus = $_GET['id'];

include 'dbconnect.php';

if(isset($_POST['confirm']))
	{
		$userid = $_SESSION['id'];
		$verif = mysqli_query($conn,"select * from kursus where id='$idkursus'");
		$fetch = mysqli_fetch_array($verif);
		$liat = mysqli_num_rows($verif);
		
		$nama_file = $_FILES["uploadgambar"]['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$random = crypt($nama_file, time());
		$ukuran_file = $_FILES["uploadgambar"]['size'];
		$tipe_file = $_FILES["uploadgambar"]['type'];
		$tmp_file = $_FILES["uploadgambar"]['tmp_name'];
		$path = "krs/".$random.'.'.$ext;

		if($fetch>0){
		$jadwal = $_POST['tanggal'];
		$userid = $_SESSION['id'];

		if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
			if($ukuran_file <= 1048576){ 
			  if(move_uploaded_file($tmp_file, $path)){ 
			  
				$daftar = mysqli_query($conn,"insert into pendaftaran (mahasiswa_id, jadwal_id, status, krs) values('$userid','$jadwal','waiting', '$path')");
				
				if($daftar){ 
				  // Sukses
				  echo "<br><meta http-equiv='refresh' content='5; URL=kursus.php'> You will be redirected to the form in 5 seconds";
					  
				}else{
				  // Gagal, Lakukan :
				  echo "Sorry, there's a problem while submitting.";
				  echo "<br><meta http-equiv='refresh' content='5; URL=konfirmasi.php?id=$idkursus'> You will be redirected to the form in 5 seconds";
				}
			  }else{
				// Jika gambar gagal diupload, Lakukan :
				echo "Sorry, there's a problem while uploading the file.";
				echo "<br><meta http-equiv='refresh' content='5; URL=konfirmasi.php?id=$idkursus'> You will be redirected to the form in 5 seconds";
			  }
			}else{
			  // Jika ukuran file lebih dari 1MB, lakukan :
			  echo "Sorry, the file size is not allowed to more than 1mb";
			  echo "<br><meta http-equiv='refresh' content='5; URL=konfirmasi.php?id=$idkursus'> You will be redirected to the form in 5 seconds";
			}
		  }else{
			// Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
			echo "Sorry, the image format should be JPG/PNG.";
			echo "<br><meta http-equiv='refresh' content='5; URL=konfirmasi.php?id=$idkursus'> You will be redirected to the form in 5 seconds";
		  }

		} else {
			echo "<div class='alert alert-danger'>
			Kode Order tidak ditemukan, harap masukkan kembali dengan benar
		  </div>
		 <meta http-equiv='refresh' content='4; url= konfirmasi.php'/> ";
		}
		
		
	};

?>

<!DOCTYPE html>
<html>
<head>
<title>Konfirmasi Kursus</title>

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
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
		<div class="container">
			<h2>Daftar Kursus</h2>
			<div class="login-form-grids">
				<label>ID Kursus</label>
				<form method="post" enctype="multipart/form-data">
					<strong>
						<input type="text" name="kursusid" value="<?php echo $idkursus ?>" disabled>
					</strong>
					<br>
					<label>Jadwal Kursus</label>
					<select name="tanggal" class="form-control">
						
						<?php
						$tanggal = mysqli_query($conn,"select * from jadwal j where j.kursus_id=$idkursus");
						
						while($a=mysqli_fetch_array($tanggal)){
						?>
							<option value="<?php echo $a['id'] ?>"><?php echo $a['tanggal'] ?> </option>
							<?php
						};
						?>
						
					</select>
					<br>
					<div class="form-group">
						<label>Bukti KRS Aktif</label>
						<input name="uploadgambar" type="file" class="form-control">
					</div>
					<br>
					<input type="submit" name="confirm" value="Kirim">
				</form>
			</div>
			<div class="register-home">
				<a href="kursus.php">Batal</a>
			</div>
		</div>
	</div>
<!-- //register -->

</body>
</html>