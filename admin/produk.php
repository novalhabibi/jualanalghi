<!DOCTYPE html>
<html lang="en">

<head>

    <?php include "inc/head.php"; 
    include "inc/koneksi.php";
//untuk menghapus data
if (isset($_GET['aksi']) and isset($_GET['id_produk']) ) 
{
    $data=$koneksi->query("SELECT *FROM produk WHERE id_produk='$_GET[id_produk]' ");
    $produk=$data->fetch_assoc();
    $foto_produk=$produk['foto_produk'];
    if (file_exists("../gambar/foto produk/$foto_produk")) 
    {
        unlink("../gambar/foto produk/$foto_produk");
    }
    $hapus=$koneksi->query("DELETE FROM produk WHERE id_produk='$_GET[id_produk]' ");
    if ($hapus) 
    {
        echo "<script>alert('Data sukses dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=produk.php'>";  
    }
    else
    {
        echo "gagal";
        echo "<script>alert('Data gagal dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=produk.php'>";  
     }
}
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
                    <li class="active">Produk</li>
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
                    <a href="produk.php" class="list-group-item active ">Produk</a>
                    <a href="kategori.php" class="list-group-item">Kategori</a>
                    <a href="member.php" class="list-group-item">Data Member</a>
                    <a href="konfirmasi.php" class="list-group-item">Konfirmasi</a>
                    <a href="contact.html" class="list-group-item">Contact</a>   
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
               
                <h2>Produk</h2>
                
                 <!-- Datatables Content -->
                        <div class="block full">
                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Produk</th>
                                            <th>Kategori</th>
                                            <th>Harga</th>
                                            <th>Foto</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no=1;
                                        $data=$koneksi->query("SELECT * FROM produk  JOIN kategori ON produk.id_kategori=kategori.id_kategori");
                                        while ($produk=$data->fetch_assoc()) 
                                        {
                                         ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no; ?></td>
                                            <td class="text-center"><?php echo $produk['nama_produk']; ?></td>
                                            <td><?php echo $produk['nama_kategori']; ?></td>
                                            <td>IDR <?php echo number_format($produk['harga_produk']); ?></td>
                                            <td class="text-center">
                                                <img src="../gambar/foto produk/<?php echo $produk['foto_produk'] ?>" width="50">
                                            </td>
                                            <td><div class="btn-group">
                                                    
                                                    <a href="editproduk.php?id_produk=<?php echo $produk['id_produk']; ?>" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href='produk.php?aksi=hapus&id_produk=<?php echo $produk['id_produk']; ?>' title="Delete" class="btn btn-xs btn-danger" onCLick="return confirm('Anda yakin mau hapus data ini ?')">
                                                        <i class="fa fa-times"></i></a>
                                                    
                                                </div></td>
                                        <?php 
                                        $no++;
                                        } ?>
                                    </tbody>
                                </table>
                                <!-- tambah data produk -->
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Tambah data</button>
<!-- untuk Menambah Produk -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Kategori</h4>
      </div>
      <div class="modal-body">
       
        <form method="POST" enctype="multipart/form-data">
         <div class="form-group">
            <label for="exampleInputEmail1">Nama Produk</label>
            <div class="input-group">
              <input name="nama_produk" type="text" class="form-control" placeholder="Masukan nama produk">
            </div>
          </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Kategori Produk</label>
            <div class="input-group">
            <select name="id_kategori" class="form-control">
                <?php 
                $data=$koneksi->query("SELECT *from kategori");
                while ($kat=$data->fetch_assoc()) 
                {
                 ?>
                <option value="<?php echo $kat['id_kategori'] ?>"><?php echo $kat['nama_kategori'] ?></option>
                <?php 
                }
                 ?>
            </select>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Harga Produk</label>
            <div class="input-group">
              <input name="harga_produk" type="text" class="form-control" placeholder="Masukan harga produk">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ringkasan Produk</label>
            <div class="input-group">
              <textarea name="ringkasan_produk" class="form-control"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Deskripsi Produk</label>
            <div class="input-group">
              <textarea name="deskripsi_produk" class="form-control" style="width: 321px; height: 105px;"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Foto Produk</label>
            <div class="input-group">
              <input type="file" name="foto_produk" class="form-group">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Ukuran Produk</label>
            <div class="input-group">
              <input type="number" name="size_produk" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Merk Produk</label>
            <div class="input-group">
              <input type="text" name="merk" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <!-- <button type="submit" class="btn btn-primary">Daftar</button> -->
        <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
      
        </div>
        </form>
<?php 
//untuk mensimoan
if (isset($_POST['simpan'])) 
{
    $nama_produk=$_POST['nama_produk'];
    $id_kategori=$_POST['id_kategori'];
    $ringkasan_produk=$_POST['ringkasan_produk'];
    $deskripsi_produk=$_POST['deskripsi_produk'];
    $harga_produk=$_POST['harga_produk'];
    $foto_produk=$_FILES['foto_produk']['name'];
    $lokasi=$_FILES['foto_produk']['tmp_name'];
    move_uploaded_file($lokasi, "../gambar/foto produk/".$foto_produk);
    $size_produk=$_POST['size_produk'];
    $merk=$_POST['merk'];
    $tgl_input=date("Y-m-d");

    $simpan=$koneksi->query("INSERT INTO produk() VALUES(null,'$nama_produk','$id_kategori','$ringkasan_produk','$deskripsi_produk','$harga_produk','$foto_produk','$size_produk','$merk','$tgl_input')");
    if ($simpan) 
    {
        echo "<script>alert('Data berhasil disimpan');</script>";
        echo "<script>location='produk.php';</script>";
    }
    else
    {
        echo "<script>alert('Data gagal disimpan');</script>";
        echo "<script>location='produk.php';</script>";
    }

}

 ?>
 </div> 
    </div>
  </div>
</div>
<!-- end tambah produk -->
                            </div>
                        </div>
                        <!-- END Datatables Content -->
               
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
