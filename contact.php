<?php
session_start();
include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Contact Us</title>
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
    <div class="container" style="background-color:rgb(255, 255, 255); padding: 40px; border-radius: 10px;">
      <h2>Contact Us</h2>
      <form><br/>
        <div class="form-group row">
          <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" >
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="email">
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Telephone</label>
          <div class="col-sm-10">
            <input type="number" class="form-control" id="telepone" >
          </div>
        </div>
        <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">Message</label>
          <div class="col-sm-10">
            <textarea type="" class="form-control" id="message"></textarea>
          </div>
        </div><br>
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-2 col-form-label"></label>
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary" onclick="alert('Berhasil Mengirimkan Pesan')">Kirim</button>
          <button type="reset" id="r" class="btn btn-primary">Reset </button>
        </div>
      </form>
      </div>
    </div>

    <div class="container" style="background-color:rgb(255, 255, 255); padding: 40px; border-radius: 10px; margin-top: 30px;">
      <h3 style="margin-bottom: 20px;">You can find us at:</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3068593496364!2d106.65926104872449!3d-6.2232088954729665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fbc9c9182f69%3A0x700636532de51e7a!2sPet%20Kingdom%20Alam%20Sutera!5e0!3m2!1sen!2sid!4v1648973158255!5m2!1sen!2sid" width="400" height="400" style="border: 10px solid rgb(254, 254, 254)" rgb(220, 130, 21)" allowfullscreen></iframe>
      <p style="font-size:20px;margin-top: 20px;">📍 Alam Sutera, Jl. Jalur Sutera No.Kav.11A, RT.001/RW.015, Pakulonan, Kec. Serpong Utara, Kota Tangerang Selatan, Banten 15143<br>(021) 29774563</p>
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
