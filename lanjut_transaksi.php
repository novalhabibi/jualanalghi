<?php
session_start();
include "inc/koneksi.php";
$id_member=$_SESSION['member']['id_member'];

if(isset($id_member)){
    if(isset($_POST['simpan'])){
      $alamat_kirim = $_POST['alamat_kirim'];
      $id_ongkir = $_POST['id_ongkir'];
      $data=$koneksi->query("SELECT *FROM ongkir WHERE id_ongkir='$id_ongkir'");
      $tarifongkir=$data->fetch_assoc();
     // $harga_produk=$_POST['harga_produk'];
      $total_bayar = $_POST['total_bayar']+$tarifongkir['tarif'];
      
      $tanggal = date("Y-m-d");
      if($alamat_kirim == "")echo "<script>alert ('Alamat harus di isi !');document.location='lanjut_transaksi.php';</script>";
      else{
        $simpan =$koneksi->query("INSERT INTO transaksi() VALUES(null, '$id_member', '$alamat_kirim', '$total_bayar', '$tanggal', '$id_ongkir' , 'pesan')") or die("gagal !!".mysqli_error($koneksi));
        if($simpan){
          $queryTransaksi = mysqli_fetch_array(mysqli_query($koneksi,"SELECT id_transaksi from transaksi where id_member = '$id_member' order by id_transaksi desc limit 1")) or die("gagal trans!!".mysqli_error($koneksi));
          $queryKeranjang = $koneksi->query("SELECT * from keranjang where id_member = '$id_member'") or die("gagal keranjang!!".mysqli_error($koneksi));

          while($dataKeranjang = mysqli_fetch_array($queryKeranjang))

          {
            //cek harga per peroduk untuk dimasukan
          $dataproduk=$koneksi->query("SELECT *FROM produk WHERE id_produk='$dataKeranjang[id_produk]'");
          $produk=$dataproduk->fetch_assoc();
            $koneksi->query("INSERT into detail_transaksi() 
              values('$queryTransaksi[id_transaksi]', '$dataKeranjang[id_produk]','$produk[harga_produk]' ,'$dataKeranjang[jumlah]')") or die("gagal detail disini !!".mysqli_error($koneksi));
            
          }
          $hapusKeranjang = $koneksi->query("DELETE from keranjang where id_member = '$id_member'") or die("gagal hapusKeranjang!!".mysqli_error($koneksi));
          if($hapusKeranjang)echo "<script>
            window.alert('Pesanan anda berhasil di simpan, segera lakukan konfirmasi');
            document.location='transaksi.php';</script>";
        }
      }
    }
  }else{
    echo "<script>
    window.alert ('Login dulu !');
    document.location='index.php';
    </script>";
}
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


<h2>Keranjang anda</h2>
<br>

<div class="table-responsive">
  
  <table class="table table-bordered">
    <tr class="success"> 
      <th> No</th>
      <th colspan="2"> Produk</th>
      <th> Harga</th>
      <th> Jumlah</th>
      <th> Subtotoal</th>
    </tr>
    
      <?php 
      $data=$koneksi->query("SELECT * from keranjang inner join produk
      on produk.id_produk = keranjang.id_produk
      where id_member = '$id_member'");
      $no = 0;
      $total = 0;
      while ($produk=$data->fetch_assoc()) 
      {
        $no++;
          $subtotal = $produk['jumlah']*$produk['harga_produk'];
          $total += $subtotal;
       ?>
      <tr>
        <td class="warning"><?php echo $no; ?> </td>
        <td class="warning"><?php echo $produk['nama_produk']; ?> </td>
        <td class="warning"><img src="./gambar/foto produk/<?php echo $produk['foto_produk']; ?>" width='50px'> </td>
        <td class="warning">IDR - <?php echo number_format($produk['harga_produk']); ?> </td>
        <td class="warning"><?php echo $produk['jumlah']; ?> 
         </td>
        <td class="warning">IDR - <?php echo number_format($subtotal); ?> </td>
      </tr>
      <?php 
      }
       ?>
        <tr class="success">
          <th colspan="5">Grand Total</th>
          <th colspan="2">IDR - <?php echo number_format($total);?></th>
        </tr>
  </table>
<form action="" method="POST">
  <div class="form-group">
    <label >Kurir</label>
    <div class="input-group">
    <select name="id_ongkir" class="form-control">
      <option>Pilih Ongkir</option>
      <?php 
      $data=$koneksi->query("SELECT * FROM ongkir ");
      while ($ongkir=$data->fetch_assoc()) 
      {

       ?>
      <option value="<?php echo $ongkir['id_ongkir'];?>"><?php echo $ongkir['nama_kota']; echo " - "; echo $ongkir['tarif'] ;  ?> </option>
      <?php 
    }
       ?>
    </select>

    </div>
  </div>
  <div class="form-group">
    <label >Alamat Lengkap</label>
    <div class="input-group">
    <textarea class="form-control" rows="3" cols="80" name="alamat_kirim" placeholder="Silahkan tulis alamat anda lengkap selengkap-lengkapnya"></textarea>
    </div>
  </div>  

<?php 
$total_bayar= $total + $ongkir['tarif'] ;
 ?>
  <input type="hidden" name="total_bayar" value="<?php echo $total_bayar;?>">
 <button type="submit" class="btn btn-success" name="simpan">Simpan</button>
</form>
<?php echo $total_bayar; ?>  
</div>

<?php include "inc/footer.php"; ?>    
</div>




<?php include "inc/js.php"; ?>
</body>
</html>
