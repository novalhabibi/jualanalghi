<?php 
session_start();
$koneksi=new mysqli("localhost","root","","jualan");
//$id_kategori=$_GET['id_kategori'];
//untuk menghapus data
if (isset($_GET['aksi']) and isset($_GET['id_kategori']) ) 
{
    $data=$koneksi->query("SELECT *FROM kategori WHERE id_kategori='$_GET[id_kategori]' ");
    $kat=$data->fetch_assoc();
    $hapus=$koneksi->query("DELETE FROM kategori WHERE id_kategori='$_GET[id_kategori]' ");
     if ($hapus) 
    {
        echo "<script>alert('Data sukses dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=kategori.php'>";  
    }
    else
    {
        echo "gagal";
        echo "<script>alert('Data gagal dihapus');</script>";
        echo "<meta http-equiv='refresh' content='1;url=kategori.php'>";  
     }
}
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
            <li class="active">Kategori</li>
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
                    <a href="kategori.php" class="list-group-item active">Kategori</a>
                    <a href="member.php" class="list-group-item">Data Member</a>
                    <a href="konfirmasi.php" class="list-group-item">Konfirmasi</a>
                    <a href="contact.html" class="list-group-item">Contact</a>       
        </div>
    </div>
<!-- Content Column -->
<div class="col-md-9">
  
        <h2>Kategori</h2>
                 <!-- Datatables Content -->
            <div class="block full">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Kategori</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                        <?php 
                                        $no=1;
                                        $data=$koneksi->query("SELECT *FROM kategori");
                                        while ($kat=$data->fetch_assoc()) 
                                        {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no; ?></td>
                                            <td class="text-center"><?php echo $kat['nama_kategori']; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    
                                                    <a href="editkategori.php?id_kategori=<?php echo $kat['id_kategori']; ?>" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
                                                    <a href='kategori.php?aksi=hapus&id_kategori=<?php echo $kat['id_kategori']; ?>' title="Delete" class="btn btn-xs btn-danger" onCLick="return confirm('Anda yakin mau hapus data ini ?')">
                                                        <i class="fa fa-times"></i></a>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                        <?php 
                                        $no++;
                                             # code...
                                         } 
                                         ?>
                        </tbody>
                        </table>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Tambah data</button>

<!-- untuk Menambah kategori -->
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
            <label for="exampleInputEmail1">Nama Kategori</label>
            <div class="input-group">
              <input name="nama_kategori" type="text" class="form-control" placeholder="Masukan nama anda">
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
    $nama_kategori=$_POST['nama_kategori'];
    $simpan=$koneksi->query("INSERT INTO kategori() VALUES(null,'$nama_kategori')");
    if ($simpan) 
    {
        echo "<script>alert('Data berhasil disimpan');</script>";
        echo "<script>location='kategori.php';</script>";
    }
    else
    {
        echo "<script>alert('Data berhasil disimpan');</script>";
        echo "<script>location='kategori.php';</script>";
    }

}

 ?>
 </div> 
    </div>
  </div>
</div>
<!-- end daftar -->

<!-- untuk Edit kategori -->
<!-- Modal -->

<div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Detail Barang</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">
   <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal2').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id_kategori');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'editkategori.php',
                data :  'rowid='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
<!-- end daftar -->

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
