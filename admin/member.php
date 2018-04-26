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
                    <a href="index.php" class="list-group-item ">Home</a>
                    <a href="produk.php" class="list-group-item ">Produk</a>
                    <a href="kategori.php" class="list-group-item">Kategori</a>
                    <a href="member.php" class="list-group-item active">Data Member</a>
                    <a href="konfirmasi.php" class="list-group-item">Konfirmasi</a>
                    <a href="contact.html" class="list-group-item">Contact</a>   
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
<?php 
 
    if(isset($_GET['aksi']) and isset($_GET['id'])){
        if($_GET['aksi']=="delete"){
            $queryHapus = $koneksi->query("DELETE from member where id_member = '$_GET[id]'");
            if($queryHapus){
                echo "<script>window.alert('Data berhasil di hapus!');
                      document.location = 'member.php';</script>";
            }
        }
    }else{
?>
<div>
    <h2>Data Pelanggan</h2>
</div>
<div>
<table class="table table-hover">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Id Member</th>
        <th>Telp</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>   
    <?php 
        $query =$koneksi->query("SELECT * from member");
        $no = 0;
        while($data = $query->fetch_assoc()){
            $no++;
     ?>
    <tr>
        <td><?php echo $no;?></td>
        <td><?php echo $data['nama_member'];?></td>
        <td><?php echo $data['id_member'];?></td>
        
        <td><?php echo $data['nohp_member'];?></td>
        <td><?php echo $data['email_member'];?></td>
        <td class="text-center">
            <div class="btn-group">
            <a href="editmember.php?id_member=<?php echo $data['id_member']; ?>" title="Edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>
            <a href='kategori.php?aksi=hapus&id_kategori=<?php echo $data['id_member']; ?>' title="Delete" class="btn btn-xs btn-danger" onCLick="return confirm('Anda yakin mau hapus data ini ?')">
            <i class="fa fa-times"></i></a>
            </div>
        </td>
    </tr>   
<?php } ?>  
</table>
</div>
<div align="left" style="padding:20px 0 0 100px;">
<a href="?page=input_pelanggan" id="lik">Input Pelanggan</a>
</div>

<?php } ?>
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
