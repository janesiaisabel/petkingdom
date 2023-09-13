<?php
session_start();
include 'dbconnect.php';

$idkat = $_GET['idkategoriserv'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Service</title>
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
    <div class="container bg-white text-dark" style="width: 28%; padding: 20px; border-radius: 10px; margin-bottom:40px">
        <h3 style="display: inline; padding-left: 10%; padding-right: 10%;">
        <?php 
            $kateserv=mysqli_query($connect,"SELECT * from kategori_service where idkategoriserv='$idkat'");
            $kategoriserv=mysqli_fetch_array($kateserv);
            echo $kategoriserv['namakategoriserv']?>
        </h3>
        <img src="<?php echo $kategoriserv['icon']?>" style="width:60px; display: inline;">
    </div>

    <!--Cards-->
    <div class="card-deck">
        <?php 
			$service=mysqli_query($connect,"SELECT * from services where idkategoriserv='$idkat' order by idservice ASC");
			$row = mysqli_num_rows($service);
					
			if($row>0){
			    while($p=mysqli_fetch_array($service)){
		?>
        <div class="col-md-6" style="margin-bottom:30px;">
            <div class="card" style="height:100%">
            <img class="card-img-top" src="<?php echo $p['gambar']?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $p['namaservice'] ?></h5>
                <p>Rp<?php echo number_format($p['harga']) ?>/sesi</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detail<?php echo $p['idservice'] ?>">See Details</button>
            </div>
            </div>
        </div>

        <!--Modal-->
        <div class="modal fade bd-example-modal-lg" id="detail<?php echo $p['idservice'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                  <h2 style="margin:10px 0px"><?php echo $p['namaservice'] ?></h2>
                  <h4 style="margin:20px 0px">Rp<?php echo number_format($p['harga']) ?>/sesi</h4>
                  <p style="margin:10px 0px"><?php echo $p['deskripsi'] ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
        	    }
            } else {
                echo "Tidak ada service";
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