<?php 
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include "inc/head.php";
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
        <!-- Team Members -->
        <div class="row">
        <!--     <div class="col-lg-12">
                <h2 class="page-header">Our Team</h2>
            </div> -->
            <?php 
            $id_produk=$_GET['id_produk'];

             $data=$koneksi->query("SELECT *FROM produk WHERE id_produk='$id_produk]'");
         	 $detail=$data->fetch_assoc()
         	
             ?>
            
            <!-- Intro Content -->
        <div class="row">
            <div class="col-md-6">
                <img class="img-responsive" src="./gambar/foto produk/<?php echo $detail['foto_produk'] ?>	" alt="">
            </div>
            <div class="col-md-6">
                <h1><?php echo $detail['nama_produk'] ?></h1>
                <h3>IDR - <?php echo number_format($detail['harga_produk']) ?></h3>
                <p><?php echo $detail['deskripsi_produk']; ?></p>
                <a class="btn btn-success" href="index.php">Kembali</a>
                 <a class="btn btn-primary" href="keranjang.php?aksi=tambah&id_produk=<?php echo $id_produk; ?> ">Beli</a>
            </div>
        </div>
        <!-- /.row -->
			
            
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