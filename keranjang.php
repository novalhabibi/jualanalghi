<?php
session_start() ;
include "inc/koneksi.php";

//echo $id_member;
//echo $id_produk;
if(isset($_SESSION['member']['id_member'])){
$id_member=$_SESSION['member']['id_member'];
$cek= $koneksi->query("SELECT * from keranjang where id_member = '$id_member'");
$hasil=$cek->num_rows;
$id_member=$_SESSION['member']['id_member'];
//$id_produk = $_GET['id_produk'];
  if(isset($_GET['aksi'])){
    $id_produk = $_GET['id_produk'];
    switch ($_GET['aksi']) {

      case 'tambah':
            $cek = $koneksi->query("SELECT * from keranjang where id_member = '$id_member' and id_produk = '$id_produk'");

            $hasil = $cek->num_rows;
            if($hasil == 0)
              $koneksi->query("INSERT into keranjang() values('$id_member', '$id_produk', 1)") or die("gagal mas bro!".mysqli_error($koneksi));
            else
              $koneksi->query("UPDATE keranjang set jumlah = jumlah + 1 where id_member = '$id_member' and id_produk = '$id_produk'") or die("gagal mas bro!".mysqli_error($koneksi));
              echo "<script>
              location='keranjang.php';
              </script>";

        break;
      case 'hapus':
              $koneksi->query("DELETE from keranjang  where id_member = '$id_member' and id_produk = '$id_produk'") or die("gagal mas bro!".mysqli_error($koneksi));
              echo "<script>
              alert('Produk telah dihapus');
              </script>";
              echo "<script>
              location='keranjang.php';
              </script>";
        break;
      case 'hapussatu':
              $koneksi->query("UPDATE keranjang set jumlah = jumlah - 1 where id_member = '$id_member' and id_produk = '$id_produk'") or die("gagal mas bro!".mysqli_error($koneksi));
            // echo "<script>
            //   alert('Jumlah produk di kurangi');
            //   </script>";
               echo "<script>
            document.location='keranjang.php';
            </script>";
        break;
      default:
        # code...
        break;
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
  <?php 
    if($hasil>0){
  ?>
  <table class="table table-bordered">
    <tr class="success"> 
      <th> No</th>
      <th colspan="2"> Produk</th>
      <th> Harga</th>
      <th> Jumlah</th>
      <th> Subtotoal</th>
      <th> Aksi</th>
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
        <td class="warning"><?php 
        echo  $produk['jumlah']; ?> 
          

          <!-- tambah produk -->
          <!-- <a href='keranjang.php?aksi=tambah&id_produk=<?php echo $produk['id_produk']; ?>'><i class="glyphicon glyphicon-plus"></i></a> -->
          <?php 
          //Cek ke Stok
             

               
              if ($produk['jumlah'] > $produk['stok_produk'] ) 
              {              
                     $koneksi->query("UPDATE keranjang set jumlah = jumlah - 1 where id_member = '$id_member' and id_produk = '$_GET[id_produk]'") or die("gagal mas bro!".mysqli_error($koneksi));
              }
              ?>

              <?php
              if (!($produk['jumlah'] == $produk['stok_produk'])) 
              { ?>
                <a href='keranjang.php?aksi=tambah&id_produk=<?php echo $produk['id_produk']; ?>'><i class="glyphicon glyphicon-plus"></i></a>

        <?php }
              else
              {
                echo "<div class='alert alert-danger'>Maaf, Stok produk hanya $produk[stok_produk] </div>";
              }

          ?>
          <!-- hapus produk -->
          
          <?php
          if ($produk['jumlah'] > 1) 
          {?>
          <a href='keranjang.php?aksi=hapussatu&id_produk=<?php echo $produk['id_produk']; ?>'><i class="glyphicon glyphicon-minus"></i></a>
          <?php 
           }
          else
          {

          }

           ?>
            <!-- End hapus produk -->
         </td>
        <td class="warning">IDR - <?php echo number_format($subtotal); ?> </td>
        <td>
          <a href='keranjang.php?aksi=hapus&id_produk=<?php echo $produk['id_produk']; ?>' class="btn btn-danger" > Hapus</a>
        </td>
      </tr>
      <?php 
      }
       ?>
        <tr class="success">
          <th colspan="5">Grand Total</th>
          <th colspan="2">IDR - <?php echo number_format($total);?></th>
        </tr>
  </table>
  <a href="index.php" class="btn btn-success"><i class="glyphicon glyphicon-menu-left">Kembali</i> </a>
  <?php 
      echo "<a href='lanjut_transaksi.php' class='btn btn-primary'>Transaksi<i class='glyphicon glyphicon-menu-right'></i> </a>";}
    else{
      echo "<br><br>Keranjang masih kosong,<br>silahkan pilih produk dulu !<br><br>
            <a href='index.php' class='btn btn-primary'><i class='glyphicon glyphicon-menu-left'></i>Kembali </a>";
    }
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

