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
<?php include "inc/slider.php" ?>

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
            if(isset($_GET['kategori'])) $kat = "WHERE id_kategori = '$_GET[kategori]'"; else $kat = "";
            $data=$koneksi->query("SELECT *FROM produk $kat order by id_produk");
            $flag = 1;
            while($produk=$data->fetch_assoc())
            {
             ?>
            
            <div class="col-md-4 text-center">
                <div class="thumbnail">
                   <a href="detail.php?id_produk=<?php echo $produk['id_produk']; ?>">
                    <img class="img-responsive" src="./gambar/foto produk/<?php echo $produk['foto_produk'] ?>	" alt=""></a> 
                    <div class="caption">
                       <h3><?php echo $produk['nama_produk']; ?><br>
                            <small>IDR <?php echo number_format($produk['harga_produk']); ?></small>
                        </h3>
                        <p><?php echo $produk['ringkasan_produk']; ?></p>
                        
                        <a class="btn btn-primary" href="keranjang.php?aksi=tambah&id_produk=<?php echo $produk['id_produk']; ?> ">Beli</a>
                        
                        <a href="detail.php?id_produk=<?php echo $produk['id_produk']; ?>" class="btn btn-success">Detail</a>
                    </div>
                </div>
            </div>
			<?php 
            if($flag < 3)
            {
                    $flag ++;
                    }else{
                    echo "</tr><tr>";
                    $flag = 1;          
                    }
            } 
			 ?>


            <?php 
            //print_r($_SESSION['member']);
            //echo $_SESSION["member"];
             ?>

            
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
