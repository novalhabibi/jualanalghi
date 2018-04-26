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
                    <li class="active">Konfirmasi
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
                    <a href="kategori.php" class="list-group-item">Kategori</a>
                    <a href="member.php" class="list-group-item">Data Member</a>
                    <a href="konfirmasi.php" class="list-group-item active">Konfirmasi</a>
                    <a href="contact.html" class="list-group-item">Contact</a>   
                </div>
            </div>
            <!-- Content Column -->
            <div class="col-md-9">
                
                <div>
    <h2>Data Pelanggan</h2>
</div>
<div>
<table class="table-hover table-bordered">
<tr>
    <th class="active">No</th>
    <th>Id Member</th>
    <th>Id_transaksi</th>
    <th colspan="2">Bukti</th>
</tr>   
<?php 
    
    $query =$koneksi->query("SELECT * from konfirmasi inner join transaksi on transaksi.id_transaksi = konfirmasi.id_transaksi");
    $no = 0;
    while($data =$query->fetch_assoc()){
        $no++;
 ?>
<tr align="center">
    <td><?php echo $no;?></td>
    <td><a href="detail_transaksi.php?id=<?php echo $data['id_transaksi'];?>" id="lik"><?php echo $data['id_member'];?></td>
    <td><?php echo $data['id_transaksi'];?></a></td>
    <td><?php echo $data['bukti'];?></td>
    <td><a href="../gambar/konfirmasi/<?php echo $data['bukti'];?>">
    <img src="../gambar/konfirmasi/<?php echo $data['bukti'];?>" height="100px"></a></td>
</tr>   
<?php } ?>  
</table>
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
