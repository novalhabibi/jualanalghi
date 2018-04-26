<?php 
include 'koneksi.php';
$nama_member=$_POST['nama_member'];
$email_member=$_POST['email_member'];
$password_member=md5($_POST['password_member']);
$nohp_member=$_POST['nohp_member'];
$tgl_daftar=date("Y-m-d");

//echo $tgl_input;
$simpan=$koneksi->query("INSERT INTO member() VALUES(null,'$nama_member','$password_member','$email_member','$nohp_member','$tgl_daftar')");

if ($simpan) 
{
	 echo "<script>alert('Anda berhasils daftar, silahkan login dengan akun anda');</script>";
    echo "<script>location='../index.php';</script>";
}
else
{
	 echo "<script>alert('Anda gagal daftar');</script>";
    echo "<script>location='../index.php';</script>";
}
 ?>




