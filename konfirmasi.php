<?php 
session_start();
include "inc/koneksi.php";
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include "inc/head.php"; ?>
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
	<div>
	<h2>KONFIRMASI</h2>
</div>
<div>
<?php 
	if(isset($_GET['id_transaksi'])){
		$id_transaksi = $_GET['id_transaksi'];
		if(isset($_POST['upload'])){
			if ($_FILES["bukti"]["name"] != "") {	
		        $bukti = $_FILES["bukti"]["name"];
		        $bukti = stripslashes($bukti);
		        $bukti = str_replace("'","",$bukti);
		        $bukti = str_replace(" ","-",$bukti);
		        $simpan = $koneksi->query("INSERT INTO konfirmasi() VALUES('$id_transaksi', '$bukti')")or die("gagal konfirmasi !".mysqli_error($koneksi));
		        $update = $koneksi->query("UPDATE transaksi SET status = 'sudah konfirmasi' WHERE id_transaksi = '$id_transaksi'")or die("gagal ubah status !".mysqli_error($koneksi));

		        move_uploaded_file($_FILES["bukti"]["tmp_name"], "gambar/konfirmasi/$bukti");
				echo "<script>alert('Anda sudah melakukan konfirmasi, pesanan anda akan segera di proses!');
						document.location = 'transaksi.php';
						</script>";
				
				$data=$koneksi->query("SELECT *from detail_transaksi WHERE id_transaksi='$id_transaksi' ");
				$produk=$data->fetch_assoc();

				$koneksi->query("UPDATE produk SET stok_produk = stok_produk - '$produk[jumlah]' WHERE id_produk = '$produk[id_produk]'")or die("gagal ubah status !".mysqli_error($koneksi));

				}else {
					echo "<script>alert('pilih file bukti');
						document.location = 'konfirmasi&id_transaksi=$id_transaksi';
						</script>";
				}
		}
 ?>
<form action="" method="POST" enctype="multipart/form-data">
  
  <div class="form-group">
    <label>Silahkan upload bukti transfer</label>
    <div class="input-group">
    	<input name="bukti" type="file" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    </div>
  </div>
 <button type="submit" class="btn btn-default" name="upload">Upload</button>
</form>
<?php } ?>
</div>


<?php include "inc/footer.php"; ?>    
</div>




<?php include "inc/js.php"; ?>
</body>
</html>