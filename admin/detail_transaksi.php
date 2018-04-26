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

        <!-- Page Heading/Breadcrumbs -->
        <div class="row" style="padding-top:20px; ">
            <div class="col-lg-12">
               <ol class="breadcrumb">
                    <li><a href="index.php">Home</a>
                    <li><a href="konfirmasi.php">Konfrimasi</a>
                    <li class="active">Detail Transaksi
                    </li>
                    
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="template.php" class="list-group-item ">Home</a>
                    <a href="produk.php" class="list-group-item ">Produk</a>
                    <a href="member.php" class="list-group-item">Data Member</a>
                    <a href="kategori.php" class="list-group-item">Kategori</a>
                    <a href="konfirmasi.php" class="list-group-item active">Konfirmasi</a>
                    <a href="contact.html" class="list-group-item">Contact</a>   
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
                
                <div>
    <h2>Detail Transaksi</h2>
</div>
<div>
<table class="table table-bordered">
<?php 
    
  $id = $_GET['id'];
    if(isset($_POST['ubah'])){
    $status = $_POST['status'];
    $koneksi->query("UPDATE transaksi set status = '$status' where id_transaksi = '$id'")or die("gagal ubah!".mysqli_error($koneksi));
  }
    $query = $koneksi->query("SELECT * from transaksi
    left join member on member.id_member = transaksi.id_member
                        where transaksi.id_transaksi = '$id'")or die("gagal trans !".mysqli_error($koneksi));
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
  <td>Telp</td><td>:</td>
  <td><?php echo $data['nohp_member'];?></td></tr>
<tr>
    <td>Total Bayar</td><td>:</td>
    <td>Rp. <?php echo $data['total_bayar'];?></td></tr>
<tr>
    <td>Tanggal</td><td>:</td>
    <td><?php echo $data['tanggal'];?></td></tr>
<tr>
  <td>Status</td><td>:</td>
  <td><div style="color:#255;font-weight:bolder;font-size:2em;"><?php echo $data['status'];?></div></td>
</tr> 
<tr>
  <td>Ubah Status</td><td>:</td>
  <td><form action="" method="post">
    <select name="status">
      <option value="pesan">pesan</option>
      <option value="sudah konfirmasi">sudah konfirmasi</option>
      <option value="lunas">lunas</option>
    </select>
  <input type="submit" name="ubah" value="Ubah">
  </form></td>
</tr> 
<?php
  $queryBukti =$koneksi->query("SELECT * from konfirmasi where id_transaksi = '$id'")or die("gagal bukti!".mysqli_error($koneksi));

  if($queryBukti->num_rows > 0){
    $hasil = $queryBukti->fetch_assoc();
    echo "<tr>
          <td colspan='3' align='center'><a href='../gambar/konfirmasi/$hasil[bukti]' id='lik'>Lihat Konfirmasi</a></td>
          </tr>";
  }

 } ?>   
</table>
<table border="1" width="90%" cellspacing="0" cellpadding="20px">
    <tr>
      <th>No</th>
      <th>Produk</th>
      <th>Jumlah</th>
      <th>Subtotal</th>
    </tr>
    <?php 
      $query =$koneksi->query("SELECT * from detail_transaksi inner join produk
        on produk.id_produk = detail_transaksi.id_produk
        where detail_transaksi.id_transaksi = '$id'")or die("gagal detail!".mysqli_error($koneksi));
        $no = 0;
        $total = 0;
        while($data = $query->fetch_assoc()){
          $no++;
          $subtotal = $data['jumlah'] * $data['harga'];
          $total += $subtotal;
          echo "<tr>
                <td width='10%'>$no</td>
                <td width='40%'>$data[nama_produk]</td>
                <td width='10%' align='center'>$data[jumlah]</td>
                <td width='25%' align='right'>Rp. $subtotal</td>
                </tr>";
        }
     ?>
    <tr>
    <?php 
    //hitung ongkir
    $ongkir= $data['total_bayar'];
     ?>
      <td colspan="3">Ongkos Kirim</td>
      <td align="right">Rp. <?php echo $ongkir;?></td>
    </tr>
    <tr>
      <td colspan="3">Grand Total</td>
      <td align="right">Rp. <?php echo $total;?></td>
    </tr>
  </table>
</div>

            </div>
        </div>
        <!-- /.row -->


        <!-- Footer -->
       <?php 
       include "inc/footer.php";
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
