<?php
session_start();
include "inc/koneksi.php";
$id_member=$_SESSION['member']['id_member'];
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

  <h2>Detail Transaksi</h2>

<div>
  <table class="table table-bordered">
  <?php 
    
    $id_transaksi = $_GET['id_transaksi'];
    $query = $koneksi->query("SELECT * from transaksi
                left join member on member.id_member = transaksi.id_member
                where transaksi.id_transaksi = '$id_transaksi'
                and transaksi.id_member = '$id_member'")or die("gagal trans !".mysqli_error($koneksi));
    while($data =$query->fetch_assoc()){
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
      <tr>
        <td>Tarif Ongkir</td><td>:</td>
        <!-- cek tarif ongkir -->
        <?php 
        $query=$koneksi->query("SELECT *FROM ongkir WHERE id_ongkir='$data[id_ongkir]' ");
        $ongkir=$query->fetch_assoc();
        ?>
        <td>IDR - <?php echo number_format($ongkir['tarif']);?></td></tr>
      <tr>
        <td>Telp</td><td>:</td>
        <td><?php echo $data['nohp_member'];?></td></tr>
      <tr>
        <td>Total Bayar</td><td>:</td>
        <td>IDR - <?php echo number_format($data['total_bayar']);?></td></tr>
      <tr>
        <td>Tanggal</td><td>:</td>
        <td><?php echo $data['tanggal'];?></td></tr>
      <tr>
        <td>Status</td><td>:</td>
        <td><div style="color:#255;font-weight:bolder;font-size:2em;"><?php echo $data['status'];?></div></td>
      </tr> 
    <?php } ?>  
  </table>
<table class="table table-bordered">
    <tr>
      <th>No</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
    </tr>
    <?php 
      $query = $koneksi->query("SELECT * FROM detail_transaksi join produk
        on produk.id_produk = detail_transaksi.id_produk
        where detail_transaksi.id_transaksi = '$id_transaksi'")or die("gagal detail!".mysqli_error($koneksi));
        $no = 0;
        $total = 0;
        while($data = $query->fetch_assoc()){
          $no++;
          $subtotal = $data['jumlah'] * $data['harga_produk'];
          $total += $subtotal;
        ?>
          
        <tr>
                <td width='10%'><?php echo $no; ?></td>
                <td width='40%'><?php echo $data['nama_produk']; ?></td>
                <td width='10%' align='center'><?php echo $data['jumlah']; ?></td>
                <td width='25%' align='right'>IDR -  <?php echo number_format($subtotal); ?></td>
        </tr>
    <?php
        }
     ?>
    <tr>
      <td colspan="3">Grand Total</td>
      <td align="right">Rp. <?php echo $total;?></td>
    </tr>
  </table>
<br>
<div align="center">
<a href="nota.php?id_transaksi=<?php echo $id_transaksi;?>" target="_blank" id="lik" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> CETAK</a>
</div>
</div>
   </div>
        <!-- /.row -->
            
    </div>
  
<?php include "inc/footer.php"; ?>    
</div>




<?php include "inc/js.php"; ?>
</body>
</html>