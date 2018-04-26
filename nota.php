<?php
session_start();
include "inc/koneksi.php";
$id_member=$_SESSION['member']['id_member'];
 ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jualan Bootstrap</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<div class="col-md-12" align="center">
	<div align="center">
	<h1>Alghi Store</h1>
	<h2>Perum Bidara, Ds. Pasir Nangka, Kec. Tigaraksa</h2>
	<h3>Tangerang - Banten</h3>
<br>
<div class="col-md-4" align="center">
</div>
<div class="col-md-4" align="center">
<table class="table table-bordered">
<?php 
	
	$id_transaksi = $_GET['id_transaksi'];
	$query = $koneksi->query("SELECT * from transaksi
              left join member on member.id_member = transaksi.id_member
  			  where transaksi.id_transaksi = '$id_transaksi'
              and transaksi.id_member = '$id_member'")or die("gagal trans !".mysqli_error($koneksi));
	while($data = $query->fetch_assoc()){
					?>
					<tr>
						<td>ID Transaksi</td><td>:</td>
						<td><?php echo $data['id_transaksi'];?></td></tr>
					<tr>
						<td>Nama</td><td>:</td>
						<td><?php echo $data['nama_member'];?></td></tr>
					<tr>
					  <td>Alamat Kirim</td><td>:</td>
					  <td><?php echo $data['alamat_kirim'];?></td></tr>
					<tr>
					  <td>Telp</td><td>:</td>
					  <td><?php echo $data['nohp_member'];?></td></tr>
					<tr>
						<td>Total Bayar</td><td>:</td>
						<td>IDR -  <?php echo number_format($data['total_bayar']);?></td></tr>
					<tr>
						<td>Tanggal</td><td>:</td>
						<td><?php echo $data['tanggal'];?></td></tr>
					<tr>
					  <td>Status</td><td>:</td>
					  <td><div style="color:#255;font-weight:bolder;font-size:1em;"><?php echo $data['status'];?></div></td>
					</tr> 
					<?php } ?>	
</table>
<br>
<table border="1" width="90%" cellspacing="0" cellpadding="20px">
    <tr>
      <th>No</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
    </tr>
    <?php 
      $query = $koneksi->query("SELECT * from detail_transaksi inner join produk
        on produk.id_produk = detail_transaksi.id_produk
        where detail_transaksi.id_transaksi = '$id_transaksi'")or die("gagal detail!".mysqli_error($koneksi));
        $no = 0;
        $total = 0;
        while($data = $query->fetch_assoc()){
          $no++;
          $subtotal = $data['jumlah'] * $data['harga_produk'];
          $total += $subtotal;
          echo "<tr>
                <td width='10%'>$no</td>
                <td width='40%'>$data[nama_produk]</td>
                <td width='10%' align='center'>$data[jumlah]</td>
                <td width='25%' align='right'>IDR - $subtotal</td>
                </tr>";
        }
     ?>
    <tr>
      <td colspan="3">Grand Total</td>
      <td align="right">Rp. <?php echo $total;?></td>
    </tr>
  </table>
<br>
<a href="" onclick="window.print();" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK</a>
</div>

</div>


        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Noval Habibi Your Website 2018</p>
                </div>
            </div>
        </footer>
</div>




<?php include "inc/js.php"; ?>
