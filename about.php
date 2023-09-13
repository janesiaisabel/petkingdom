<?php
session_start();
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - About Us</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="dist/css/bootstrap.min.css">
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

  <!--Content-->
  <div style="background-image: url(img/bgtiles.jpg); padding: 50px; background-attachment: fixed;">
    <div class="container" style="background-color:rgb(255, 255, 255); border-radius: 10px;">
      <h3 class="text-center" style="font-size:30px;padding:50px"> We Are the Most Complete Pet Facilities for Your Beloved Pet</h3>
      <img src="img/logo.png" height="150px" class="mx-auto d-block">
      <div class="text-center" style="font-size:20px;padding:50px">Pet Kingdom adalah sebuah petshop yang berdiri pada tahun 2014 hingga sekarang. Misi utama Pet Kingdom adalah menyediakan perlengkapan dan layanan terbaik demi kesejahteraan dan kebahagiaan hewan.</div>
    </div>
    <br/><br/>
    <div class="container" style="background-color:rgb(196, 223, 255); border-radius: 10px;padding:50px">
      <h3 class="text-center" style="font-size:30px;padding-bottom:10px"> Our Facilities</h3>
      <div class="card-group">
        <div class="card">
          <img src="img/place.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Pet Care Center</h5>
            <p class="card-text">Menyediakan berbagai fasilitas untuk hewan peliharaan seperti Grooming, Pet Clinic, Pet Hotel & Pet Sitter</p>
          </div>
        </div>
        <div class="card">
          <img src="img/storr.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Pet Store</h5>
            <p class="card-text">Menjual berbagai kebutuhan hewan peliharaan seperti makanan, aksesoris, dll</p>
          </div>
        </div>
        <div class="card">
          <img src="img/yard.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Dog Park</h5>
            <p class="card-text">Lahan terbuka yang luas untuk tempat bermain hewan kesayangan</p>
          </div>
        </div>
        <div class="card">
          <img src="img/yardd.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Spot Outdoor</h5>
            <p class="card-text">Tempat outdoor yang nyaman bukan hanya untuk hewan peliharaan tetapi juga untuk pengunjung</p>
          </div>
        </div>
      </div>
    </div>
    <br/><br/>
    <div class="container" style="background-color:rgb(153, 199, 255); border-radius: 10px;">
      <h3 class="text-center" style="font-size:30px;padding:50px;padding-bottom:10px"> Find us at </h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3068593496364!2d106.65926104872449!3d-6.2232088954729665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fbc9c9182f69%3A0x700636532de51e7a!2sPet%20Kingdom%20Alam%20Sutera!5e0!3m2!1sen!2sid!4v1648973158255!5m2!1sen!2sid" width="300" height="300" style="border: 20px solid rgb(153, 199, 255); margin: auto; display: block;" allowfullscreen></iframe>
      <div class="text-center" style="font-size:20px;padding:50px;padding-top:5px">📍 Alam Sutera, Jl. Jalur Sutera No.Kav.11A, RT.001/RW.015, Pakulonan, Kec. Serpong Utara, Kota Tangerang Selatan, Banten 15143<br>(021) 29774563</div>
    </div>
    <br/><br/>
    <div class="container" style="background-color:rgb(255, 255, 255); border-radius: 10px;">
      <h3 class="text-center" style="font-size:30px;padding:50px;padding-bottom:50px">We are looking forward for your coming dear Pawfriends and Pawrents! </h3>
      <div class="text-center" style="font-size:20px;padding:50px;padding-top:5px"><img src="img/doggo.gif"></div>
    </div>
  </div>


  <!--footer-->
  <footer class="bg-primary text-center text-lg-start">
    <div class="text-center p-3">
      <p class="text-white">© 2022 Copyright: Pet Kingdom</p>
    </div>
  </footer>

  <script src="dist/js/jquery-3.6.0.slim.min.js"></script>
  <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
