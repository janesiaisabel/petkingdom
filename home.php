<?php
session_start();
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
</head>
<body>
  <!--Navigation-->
  <nav class="navbar navbar-expand-sm bg-light sticky-top">
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
 
  <!--Content-->
  <div class="bg-info">
    <?php
				if(isset($_SESSION['log'])){
					echo '<marquee class="text-white" style="font-size: 30px;">Hello '.$_SESSION["name"].'! Welcome to Pet Kingdom 🐾 </marquee>';
				}
				?>
  </div>
  <img src="img/brand.jpg" width="100%">
  <video autoplay muted loop id="myVideo" width="100%">
    <source src="video/Care For Paw Kaleidoskop _ Pet Kingdom.mp4" type="video/mp4">
  </video>
  <!--Carousel-->
  <div style="background-image: url(img/bgtiles.jpg);padding:50px; background-attachment: fixed;">
    <div style="background-color:rgb(255, 255, 255); border-radius: 10px;">
      <h3 class="text-center" style="padding:30px;">Let's take a look at our place!</h3>
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="width: 100%;">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/place.jpg" class="d-block w-100" alt="oops">
            <div class="carousel-caption d-none d-md-block">
              <h4 class="text-dark">Pintu Masuk Pet Kingdom</h4>
              <p class="text-dark">Ini adalah tempat masuk Pet Kingdom! Dengan interior dan eksterior binatang, kami siap menyambut Pawrents dan Pawfriends semua!</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/storr.jpg" class="d-block w-100" alt="oops">
            <div class="carousel-caption d-none d-md-block">
              <h4>Pet Store</h4>
              <p>Ini dia, Pet Store kita. Bisa dilihat kan seperti surga para Pawrents untuk menyiapkan perlengkapan anabul kesayangan???</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="img/yard.jpg" class="d-block w-100" alt="oops">
            <div class="carousel-caption d-none d-md-block">
              <h4>Dog Park</h4>
              <p>Wah, bisa dilihat, kan? Pet Kingdom adalah tempat yang nyaman bagi para anabul lucu ini. Tidak heran menjadi one-stop para pecinta binatang.</p>
            </div>
          </div><div class="carousel-item">
            <img src="img/yardd.jpg" class="d-block w-100" alt="oops">
            <div class="carousel-caption d-none d-md-block">
              <h4>Spot Outdoor</h4>
              <p>Selain menyediakan tempat yang nyaman bagi para anabul, ada banyak spot outdoor yang nyaman bagi Pawrents yang sedang menunggu.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleCaptions" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleCaptions" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </button>
      </div>  
    </div>
    
    <!--Products-->
    <div style="background-color:rgb(255, 255, 255); border-radius: 10px; margin-top: 40px; padding: 40px;">
      <h3 class="text-center" style="padding-bottom:30px;">Here's our new & hottest products 🔥</h3>
      <div class="row row-cols-1 row-cols-md-4">
        <?php 
			$produk=mysqli_query($connect,"SELECT * from produk order by idproduk ASC LIMIT 8");
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
			$produk=mysqli_query($connect,"SELECT * from produk order by idproduk ASC LIMIT 8");
					
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

    <!--Services-->
    <div style="background-color:rgb(255, 255, 255); border-radius: 10px; margin-top: 40px; padding: 40px;">
      <h3 class="text-center" style="padding-bottom:30px;">What service do we offer?</h3>
      <div class="card-group">
      <?php 
			$service=mysqli_query($connect,"SELECT * from kategori_service order by idkategoriserv ASC LIMIT 4");
			$row = mysqli_num_rows($service);
					
			if($row>0){
			    while($p=mysqli_fetch_array($service)){
		  ?>
        <div class="card">
        <img class="card-img-top" src="<?php echo $p['icon']?>" alt="Card image cap" style="max-height:260px; object-fit:contain">
          <div class="card-body">
          <h5 class="card-title"><?php echo $p['namakategoriserv'] ?></h5>
          <a class="btn btn-primary" href="service.php?idkategoriserv=<?php echo $p['idkategoriserv'] ?>">See Details</a>
          </div>
        </div>
        <?php
        	    }
            } else {
                echo "Tidak ada produk";
            }
		    ?>
      </div>
    </div>
  </div>

  <!--footer-->
  <footer class="bg-primary text-center text-lg-start">
    <div class="text-center p-3">
      <p class="text-white">© 2022 Copyright: Pet Kingdom</p>
    </div>
  </footer>

  <script src="dist/js/jquery-3.6.0.min.js"></script>
  <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
