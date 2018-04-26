<?php 
session_start();
include "inc/koneksi.php";
$id_kategori=$_GET['id_kategori'];

$data=$koneksi->query("SELECT*FROM kategori WHERE id_kategori='$id_kategori' ");
$kat=$data->fetch_assoc();
//print_r($kat);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "inc/head.php"; ?>
  <!-- Related styles of various icon packs and plugins -->

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
                    <li><a href="kategori.php">Kategori</a>
                    </li>
                    <li class="active">Edit Kategori</li>
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
                    <a href="produk.php" class="list-group-item  ">Produk</a>
                    <a href="kategori.php" class="list-group-item">Kategori</a>
                    <a href="member.php" class="list-group-item">Data Member</a>
                    <a href="konfirmasi.php" class="list-group-item">Konfirmasi</a>
                    <a href="contact.html" class="list-group-item">Contact</a>
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
                <div class="row">
                <h2>Edit Kategori</h2>

<!-- ini untuk login -->
<div class="panel panel-default col-md-5">
<div class="panel-body">
<form action="" method="POST" enctype=""> 
  <div class="form-group">
    <label for="exampleInputEmail1">Nama Kategori</label>
    <div class="input-group">
        <input name="nama_kategori" type="text" class="form-control" value="<?php echo $kat['nama_kategori']; ?>">
    </div>
  </div>
 <button type="submit" class="btn btn-success" name="ubah">Ubah</button>
</form>
<?php 
if (isset($_POST['ubah'])) 
{
    $nama_kategori=$_POST['nama_kategori'];
    $ubah=$koneksi->query("UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori='$id_kategori' ");
    if ($ubah) 
    {
        echo "<script>alert('Data berhasil di ubah');</script>";
        echo "<script>location='kategori.php';</script>";
    }
    else
    {
        echo "<script>alert('Data gagal di ubah');</script>";
        echo "<script>location='editkategori.php';</script>";
    }
}

 ?>
              </div>
<!-- End Edit Kategori -->

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
