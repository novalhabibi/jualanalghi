<?php 
include "inc/koneksi.php";
 ?>
            <!-- Sidebar Column untuk login -->

<div class="col-md-3">
 

 <!-- login --> 
 <?php if (isset($_SESSION['member'])): ?>
    <!-- setelah login -->
    <!-- Content Column KATEGORI -->
            <div class="panel panel-default">
              <div class="panel-heading"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['member']['nama_member'];?></div>
              <div class="list-group">
                <a href="transaksi.php" class="list-group-item">Transaksi</a>
                <a href="keranjang.php" class="list-group-item">Keranjang</a>
                <a href="pengaturanakun.php" class="list-group-item">Pe3ngaturan Akun</a>
                <a href="inc/logout.php" class="list-group-item">Logout</a>
              </div>
            </div>
            
  <?php else: ?>
<!-- ini untuk login -->
    		<div class="panel panel-default">
			  <div class="panel-heading">Login Sistem </div>
			  <div class="panel-body">

<form action="inc/ceklogin.php" method="POST">
  
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <div class="input-group">
    		<div class="input-group-addon">
    			<i class="fa fa-user"></i></div>
    	<input name="email_member" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    </div>
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <div class="input-group">
      <div class="input-group-addon">
          <i class="fa fa-key"></i></div>
    <input name="password_member" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
 </div>
 <button type="submit" class="btn btn-default">Login</button>
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Daftar</button>
</form>

			  </div>
<!-- untuk daftar -->



<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Daftar Member</h4>
      </div>
      <div class="modal-body">
       
        <form action="inc/daftarmember.php" method="POST">
         <div class="form-group">
            <label for="exampleInputEmail1">Nama Lengkap</label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-inverse">
                  <i class="fa fa-user"></i>
                </button>
              </span>
              <input name="nama_member" type="text" class="form-control" placeholder="Masukan nama anda">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-inverse">
                  <i class="fa fa-user"></i>
                </button>
              </span>
              <input name="email_member" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-inverse">
                  <i class="fa fa-user"></i>
                </button>
              </span>
              <input name="password_member" type="password" class="form-control" placeholder="Masukan password anda">
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">No Hp</label>
            <div class="input-group">
              <span class="input-group-btn">
                <button class="btn btn-inverse">
                  <i class="fa fa-user"></i>
                </button>
              </span>
              <input name="nohp_member" type="text" class="form-control" placeholder="Masukan no hp anda">
            </div>
          </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
        <!-- <button type="submit" class="btn btn-primary">Daftar</button> -->
        <input type="submit" class="btn btn-primary" name="daftar" value="Daftar">
      
        </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<!-- end daftar -->


</div>



<?php endif ?>
<!-- end login -->


            <!-- Content Column KATEGORI -->
            <div class="panel panel-default">
              <div class="panel-heading">Kategori</div>
              <div class="list-group">
                <?php 
                $data=$koneksi->query("SELECT *FROM kategori");
                while ($kat=$data->fetch_assoc()) {
                 ?>
                <a href="index.php?kategori=<?php echo $kat['id_kategori']; ?> " class="list-group-item"><?php echo $kat['nama_kategori']; ?></a>
                <?php 
                }
                 ?>
              </div>
            </div>

<!-- Content Column KURIR -->
            <div class="panel panel-default">
              <div class="panel-heading">Kurir</div>
              <div class="list-group">
                <img src="./gambar/JNE-Logo-big.png" class="img-responsive" alt="Responsive image">
              <hr>
              <img src="./gambar/Vector Logo Tiki Format CorelDraw.png" class="img-responsive" alt="Responsive image">
              </div>
            </div>

<!-- Content Column Pembayaran -->
            <div class="panel panel-default">
              <div class="panel-heading">Pembayaran</div>
              <div class="list-group">
              <img src="./gambar/BCA.png" class="img-responsive img-thumbnail" alt="Responsive image">
              <span>A.N <strong>Noval Habibi</strong> 132456788774</span>
              <hr>
              <img src="./gambar/mandiri.png" class="img-responsive img-thumbnail" alt="Responsive image">
              <span>A.N <strong>Noval Habibi</strong> 523623623</span>
              </div>
            </div>

</div>


            <!-- Sidebar Column untuk login -->
