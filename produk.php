<?php
session_start();
include 'dbconnect.php';

$idk = $_GET['idkategori'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/style.css">
</head>
<body>
    <!--Navigation-->
  <nav class="navbar navbar-expand-sm bg-light sticky-top" >
    <!--Brands-->
    <a class="navbar-brand" href="home.php" style="padding-left:3%;"><img src="img/logo.png" height="40px"></a>

    <!-- Links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Products
        </a>
        <div class="dropdown-menu">
          <?php 
            $kat=mysqli_query($connect,"SELECT * from kategori order by idkategori ASC");
            while($p=mysqli_fetch_array($kat)){
              ?>
            <a class="dropdown-item" href="produk.php?idkategori=<?php echo $p['idkategori'] ?>"><?php echo $p['namakategori'] ?></a>
            <?php  
            }
            ?>
        </div>
      </li>

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          Services
        </a>
        <div class="dropdown-menu">
        <?php 
            $kat=mysqli_query($connect,"SELECT * from kategori_service order by idkategoriserv ASC");
            while($p=mysqli_fetch_array($kat)){
              ?>
            <a class="dropdown-item" href="service.php?idkategoriserv=<?php echo $p['idkategoriserv'] ?>"><?php echo $p['namakategoriserv'] ?></a>
            <?php  
            }
            ?>
        </div>
      </li>
      
      <!--Logout-->
      <?php
				if(!isset($_SESSION['log'])){
					echo '
					<li class="nav-item"><a class="nav-link" href="daftar.php">Register</a></li>
					<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
					';
				} else {
					if($_SESSION['level']=='Customer'){
					echo '
					<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
					';
					} else {
					echo '
					<li class="nav-item"><a class="nav-link" href="homeadmin.php">Admin Panel</a></li>
					<li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
					';
					};
				}
				?>
        </ul>
    </nav>
    
    <div style="background-image: url(img/bgtiles.jpg);padding:50px; background-attachment: fixed; min-height:600px">
    <!--Banner-->
    <div class="container bg-white text-dark" style="width: 33%; padding: 20px; border-radius: 10px; margin-bottom:40px">
        <h3 style="display: inline; padding-left: 10%; padding-right: 10%;">Produk 
        <?php 
            $kate=mysqli_query($connect,"SELECT * from kategori where idkategori='$idk'");
            $kategori=mysqli_fetch_array($kate);
            echo $kategori['namakategori']?>
        </h3>
        <img src="<?php echo $kategori['icon']?>" style="width:60px; display: inline;">
    </div>

    <!--Cards-->
    <div class="row row-cols-1 row-cols-md-4">
    <?php 
			$produk=mysqli_query($connect,"SELECT * from produk where idkategori='$idk' order by idproduk ASC");
			$row = mysqli_num_rows($produk);
					
			if($row>0){
			    while($p=mysqli_fetch_array($produk)){
		  ?>
        <div class="col mb-4">
            <div class="card" style="height:100%">
            <img class="card-img-top" src="<?php echo $p['gambar']?>" alt="Card image cap" style="max-height:260px; object-fit:contain">
            <div class="card-body">
                <h5 class="card-title"><?php echo $p['namaproduk'] ?></h5>
                <p>Rp<?php echo number_format($p['harga']) ?></p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail<?php echo $p['idproduk'] ?>">See Details</button>
            </div>
            </div>
        </div>
        <?php
        	    }
            } else {
                echo "Tidak ada produk";
            }
		    ?>
      </div>
        
        <?php 
			$produk=mysqli_query($connect,"SELECT * from produk where idkategori='$idk' order by idproduk ASC");
			while($p=mysqli_fetch_array($produk)){
		  ?>
        <!--Modal-->
        <div class="modal fade bd-example-modal-lg" id="detail<?php echo $p['idproduk'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
          <div class="modal-content">
          <div class="modal-header border-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
              <div class="container d-flex" style="padding:50px">
                <img src="<?php echo $p['gambar']?>" alt="Img" width="400px">
                <div class="container d-block" style="margin-left:30px">
                  <h2 style="margin:10px 0px"><?php echo $p['namaproduk'] ?></h2>
                  <h5 style="margin:10px 0px" <?php if ($p['availability'] == 'In Stock') 
                    {echo 'class="text-success"';}
                    else {echo 'class="text-danger"';}?> ><?php echo $p['availability'] ?></h5>
                  <h4 style="margin:20px 0px">Rp<?php echo number_format($p['harga']) ?></h4>
                  <p style="margin:10px 0px"><?php echo $p['deskripsi'] ?></p>
                  <?php if ($p['availability'] == 'In Stock') {
                    echo '<p class="text-success" style="margin:40px 0px">Produk ini sedang in stock! Dapatkan segera di Pet Kingdom</p>';
                  } else {
                    echo '<p class="text-danger" style="margin:40px 0px">Maaf, produk ini sedang sold out. Cek website secara berkala untuk update ketersediaan produk</p>';
                  }?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        	    }
		    ?>
      </div>
    </div>

<!--footer-->
<footer class="bg-primary text-center text-lg-start" style="bottom=0;">
    <div class="text-center p-3">
      <p class="text-white">© 2022 Copyright: Kelompok 1</p>
    </div>
</footer>

  <script src="dist/js/jquery-3.6.0.min.js"></script>
  <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


