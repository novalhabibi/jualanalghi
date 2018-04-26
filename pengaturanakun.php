<!DOCTYPE html>
<html lang="en">
<head>
<?php 
session_start();
include "inc/head.php";
include "inc/koneksi.php";
 ?>
</head>
<body>
<?php include "inc/menuatas.php"; ?>
<!-- Page Content -->
<div class="container">
  <!-- Content Row -->
	<div class="row" style="padding-top:20px; ">
            <!-- Sidebar Column untuk login -->
            
<!-- ini untuk login -->
<?php include "inc/left_sidebar.php"; ?>
<!-- End login -->

<div class="col-md-9">
            <!-- Content Column -->
<div class="row">
	<div class="well">
		<?php 
		$_SESSION['member'];
		print_r($_SESSION['member']);
		echo "<br><br>";
		$nama_member=$_SESSION['member']['nama_member'];
		 ?>
		Nama : <?php echo $nama_member;  ?>



	</div>        
</div>
<!-- /.row -->
            
		</div>
	</div>
        <!-- /.row -->



<?php include "inc/footer.php"; ?>    
</div>




<?php include "inc/js.php"; ?>
</body>
</html>
