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
<div class="row">
<h2>Data Transaksi Anda</h2>
<br> 
<div class="table-responsive">
  
  <table class="table table-bordered">
    <tr class="success"> 
      <th> No</th>
      <th > Nama anda</th>
      <th > Alamat kirim</th>
      <th > Total Bayar</th>
      <th> Tanggal</th>
      <th> Status</th>
      <th> Aksi</th>
    </tr>
    
      <?php 
      $id_member=$_SESSION['member']['id_member'];

      $data=$koneksi->query("SELECT * from transaksi join member on member.id_member = transaksi.id_member
							where transaksi.id_member = '$id_member'");
      $no = 0;
      while ($produk=$data->fetch_assoc()) 
      {
        $no++;
       ?>
      <tr>
        <td class="warning"><?php echo $no; ?> </td>
        <td class="warning"><?php echo $produk['nama_member']; ?> </td>
        <td class="warning"><?php echo $produk['alamat_kirim']; ?> </td>
        <td class="warning"><?php echo number_format($produk['total_bayar']); ?> </td>
        <td class="warning"><?php echo $produk['tanggal']; ?> </td>
        <td class="warning"><?php echo $produk['status']; ?> </td>
        <td align="center" class="warning">
        <?php
		$link = "<a href='detail_transaksi.php?id_transaksi=$produk[id_transaksi]'>Detail</a>"; 
		
		if($produk['status'] == "pesan") echo "<A href='konfirmasi.php?id_transaksi=$produk[id_transaksi]' id='lik'>Konfirmasi</a>"; 

		elseif($produk['status'] == "sudah konfirmasi") echo $link;
		
		elseif($produk['status'] == "lunas") echo $link;
		
		else echo "&nbsp;";
		
		?>
			
		</td>
      </tr>
      <?php 
      }
       ?>
        
  </table>
      </div>
        <!-- /.row -->
            
    </div>
  </div>
</div>
        <!-- /.row -->
<?php include "inc/footer.php"; ?>    
</div>

<?php include "inc/js.php"; ?>
</body>
</html>