<?php 
// connect ke db dengan username, password dan nama database
$conn = mysqli_connect("localhost","root","","kursus");

if(!$conn){
	echo "gagal connect ke database";
}

?>