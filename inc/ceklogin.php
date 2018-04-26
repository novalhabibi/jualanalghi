<?php 
session_start();
include "koneksi.php";
$email_member=$_POST['email_member'];
$password_member=md5($_POST['password_member']);

$data=$koneksi->query("SELECT *FROM member WHERE email_member='$email_member' AND password_member='$password_member' ");
$cek=$data->num_rows;
//print_r($cek);


  if ($cek==1) 
  {
    //berhasil login
     $akun=$data->fetch_assoc();
     $_SESSION["member"]=$akun;

     print_r($_SESSION['member']);
    echo "<script>alert('Anda berhasils login');</script>";
    echo "<script>location='../index.php';</script>";
  }
  else
  {
    //gagal login
    echo "<script>alert('Anda gagal login, periksa akun anda');</script>";
    echo "<script>location='../index.php';</script>";
  }
 ?>
 
 