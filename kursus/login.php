<?php
session_start();

if(isset($_SESSION['log'])){
	// tampilkan halaman index jika user sudah login
	if($_SESSION['role'] == 'admin'){
		header('location:admin/index.php');
	}else{
		header('location:index.php');
	}
};

include 'dbconnect.php';
date_default_timezone_set("Asia/Bangkok");
$timenow = date("j-F-Y-h:i:s A");

	if(isset($_POST['login']))
	{
	$npm = mysqli_real_escape_string($conn,$_POST['npm']);
	$pass = mysqli_real_escape_string($conn,$_POST['pass']);
	$queryuser = mysqli_query($conn,"SELECT * FROM user WHERE npm='$npm'");
	$cariuser = mysqli_fetch_assoc($queryuser);
		if( $pass == $cariuser['password'] ) {
			// 
			$_SESSION['id'] = $cariuser['id'];
			$_SESSION['role'] = $cariuser['role'];
			$_SESSION['name'] = $cariuser['nama_mhs'];
			$_SESSION['log'] = "Logged";
			// login berhasil, menuju halaman home
			if($cariuser['role'] == 'admin') {
				header('location:admin/index.php');
			} else {
				header('location:index.php');
			}
		} else {
			echo 'NPM atau password salah';
			// salah password, kembali ke halaman login
			header("location:login.php");
		}		
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Lembaga Kursus Jewepe</title>

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
				<li class="active">Halaman Login</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- login -->
	<div class="login">
		<div class="container">
			<h2>Masuk</h2>
		
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
				<form method="post">
					<input type="text" name="npm" placeholder="NPM" required>
					<input type="password" name="pass" placeholder="Password" required>
					<input type="submit" name="login" value="Masuk">
				</form>
			</div>
		</div>
	</div>
<!-- //login -->

</body>
</html>