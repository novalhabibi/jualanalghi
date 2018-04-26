<?php 
include "inc/koneksi.php";
 ?>   
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <a class="navbar-brand" href="index.php">   Alg<strong>Hi</strong> Store</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="index.php">Produk</a>
                    </li>
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kategori <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php 
                            $data=$koneksi->query("SELECT *FROM kategori");
                            while ($kat=$data->fetch_assoc()) {
                             ?>
                            <li>
                                <a href="index.php?kategori=<?php echo $kat['id_kategori']; ?> "><?php echo $kat['nama_kategori']; ?></a>
                            </li>
                            <?php 
                            }
                             ?>
                        </ul>
                    </li>
                    <li>
                        <a href="kontak.php">Kontak</a>
                    </li>

                    <?php if (isset($_SESSION["member"])): ?>
                    <li>
                        <a href="inc/logout.php">Logout</a>
                    </li>
                    <?php endif ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>