<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "inc/head.php"; 
    include "inc/koneksi.php";
    $id_produk=$_GET['id_produk'];
    $data=$koneksi->query("SELECT *FROM produk WHERE id_produk='$id_produk'");
    $produk=$data->fetch_assoc();
    ?>
  <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="css/plugins.css">
        <!-- <link rel="stylesheet" href="css/main.css"> -->
                <link rel="stylesheet" href="css/themes.css">
                 <script src="js/modernizr.min.js"></script>
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
                    </li>
                    <li><a href="produk.php">Produk</a></li>
                    <li class="active">Edit Produk</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Sidebar Column -->
           <div class="col-md-3">
                <div class="list-group">
                    <a href="index.php" class="list-group-item ">Home</a>
                    <a href="produk.php" class="list-group-item ">Produk</a>
                    <a href="kategori.php" class="list-group-item">Kategori</a>
                    <a href="member.php" class="list-group-item">Data Member</a>
                    <a href="konfirmasi.php" class="list-group-item">Konfirmasi</a>
                    <a href="contact.html" class="list-group-item">Contact</a>   
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
               
                <h2>Edit Produk</h2>
                
                 
<!-- untuk Edit Produk -->
<div class="panel panel-default col-md-9">
<div class="panel-body">
        <form method="POST" enctype="multipart/form-data">
         <div class="form-group">
            <label for="exampleInputEmail1">Nama Produk</label>
            <div class="input-group">
              <input name="nama_produk" type="text" class="form-control" value="<?php echo $produk['nama_produk']; ?>">
            </div>
          </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Kategori Produk</label>
            <div class="input-group">
            <select name="id_kategori" class="form-control">
                <?php 
                
                $data=$koneksi->query("SELECT *from kategori");
                while($kat=$data->fetch_assoc()){
                if ($kat['id_kategori']==$produk['id_kategori']) 
                {
                    echo "<option value='$kat[id_kategori]' selected='selected'>$kat[nama_kategori]</option>";
                }
                else
                {
                  echo "<option value='$kat[id_kategori]'>$kat[nama_kategori]</option>";
                }
                }
            
                 ?>
            </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Produk</label>
            <div class="input-group">
              <input name="harga_produk" type="text" class="form-control" value="<?php echo $produk['harga_produk']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ringkasan Produk</label>
            <div class="input-group">
              <textarea name="ringkasan_produk" class="form-control"><?php echo $produk['ringkasan_produk']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Deskripsi Produk</label>
            <div class="input-group">
              <textarea name="deskripsi_produk" class="form-control" style="width: 321px; height: 105px;"><?php echo $produk['deskripsi_produk']; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Foto Produk</label>
            <div class="input-group">
              <img src="../gambar/foto produk/<?php echo $produk['foto_produk'] ?>" width="100">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ganti Foto Produk</label>
            <div class="input-group">
              <input type="file" name="foto_produk" class="form-group">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ukuran Produk</label>
            <div class="input-group col-md-2">
              <input type="number" name="size_produk" class="form-control" value="<?php echo $produk['size_produk']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Stok Produk</label>
            <div class="input-group col-md-2">
              <input type="number" name="stok_produk" class="form-control" value="<?php echo $produk['stok_produk']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Merk Produk</label>
            <div class="input-group">
              <input type="text" name="merk" class="form-control" value="<?php echo $produk['merk']; ?>">
            </div>
        </div>
        
        <input type="submit" class="btn btn-primary" name="ubah" value="Ubah">

        </form>
</div>
</div>
<?php 
//untuk mensimoan
if (isset($_POST['ubah'])) 
{
    $nama_produk=$_POST['nama_produk'];
    $id_kategori=$_POST['id_kategori'];
    $ringkasan_produk=$_POST['ringkasan_produk'];
    $deskripsi_produk=$_POST['deskripsi_produk'];
    $harga_produk=$_POST['harga_produk'];
    $foto=$_FILES['foto_produk']['name'];
    $lokasi=$_FILES['foto_produk']['tmp_name'];
    $size_produk=$_POST['size_produk'];
    $merk=$_POST['merk'];
    $stok_produk=$_POST['stok_produk'];
    $tgl_input=date("Y-m-d");

    if (!empty($lokasi)) 
    {
        move_uploaded_file($lokasi, "../gambar/foto produk/".$foto);
        $update=$koneksi->query("UPDATE  produk set nama_produk='$nama_produk',id_kategori='$id_kategori',ringkasan_produk='$ringkasan_produk',deskripsi_produk='$deskripsi_produk',harga_produk='$harga_produk',foto_produk='$foto',size_produk='$size_produk',merk='$merk', stok_produk='$stok_produk' WHERE id_produk='$_GET[id_produk]'") or die(mysqli_error($koneksi));

        
        if ($update) 
        {
            echo "<script>alert('Data sukses terupdate');</script>";
            echo "<meta http-equiv='refresh' content='1;url=produk.php'>";    
        }
        else
        {
            echo "<script>alert('Data gagal di update');</script>";
            echo "<meta http-equiv='refresh' content='1;url=editproduk.php'>";  
        }
    }
    else
    {
        $update=$koneksi->query("UPDATE  produk set nama_produk='$nama_produk',id_kategori='$id_kategori',ringkasan_produk='$ringkasan_produk',deskripsi_produk='$deskripsi_produk',harga_produk='$harga_produk',size_produk='$size_produk',merk='$merk',stok_produk='$stok_produk' WHERE id_produk='$_GET[id_produk]'") or die(mysqli_error($koneksi));

        
        if ($update) 
        {
            echo "<script>alert('Data sukses terupdate');</script>";
            echo "<meta http-equiv='refresh' content='1;url=produk.php'>";    
        }
        else
        {
            echo "<script>alert('Data gagal di update');</script>";
            echo "<meta http-equiv='refresh' content='1;url=editproduk.php'>";  
        }
    }

}

 ?>
<!-- end Edit produk -->
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
    <script src="/js/jquery.js"></script>


        <script src="js/jquery.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/app.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
     <!-- Load and execute javascript code used only in this page -->
        <script src="js/tablesDatatables.js"></script>
        <script>$(function(){ TablesDatatables.init(); });</script>
</body>

</html>
