<?php 
session_start();
//session_destroy();
unset($_SESSION['member']);
echo "<script>alert('Anda telah logout');</script>";
echo "<script>location='../index.php';</script>";



 ?>