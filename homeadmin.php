<?php 
	session_start();
	include 'dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Admin Panel</title>
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
	
   <div class="container" style="padding:50px 0px;">
      <?php 
      echo "<h2>Hello, ".$_SESSION["name"]."</h2>";
      ?>
      <p>You've logged in as an Admin</p>
      <div class="card-deck">
      <div class="col-md-4" style="margin-bottom:30px; padding:0px">
        <div class="card text-white bg-warning">
          <img class="card-img-top" src="img/product.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Manage Products</h5>
              <p class="card-text">Add new products, Update or Delete existing products</p>
              <a href="crudproduk.php" class="btn btn-light">Manage</a>
            </div>
          </div>
      </div>
      <div class="col-md-4" style="margin-bottom:30px; padding:0px">
          <div class="card text-white bg-success">
          <img class="card-img-top" src="img/service.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Manage Services</h5>
              <p class="card-text">Add new Services, Update or Delete existing services</p>
              <a href="crudservice.php" class="btn btn-light">Manage</a>
            </div>
          </div>
      </div>
      <div class="col-md-4" style="margin-bottom:30px; padding:0px">
          <div class="card text-white bg-info">
          <img class="card-img-top" src="img/users.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Manage Users</h5>
              <p class="card-text">Add new users, Update or Delete existing users</p>
              <a href="cruduser.php" class="btn btn-light">Manage</a>
            </div>
          </div>
      </div>
      <div class="col-md-4" style="margin-bottom:30px; padding:0px">
          <div class="card text-white bg-secondary">
          <img class="card-img-top" src="img/categ.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Manage Product Categories</h5>
              <p class="card-text">Add new product categories, Update or Delete existing categories</p>
              <a href="crudkategori.php" class="btn btn-light">Manage</a>
            </div>
          </div>
      </div>
      <div class="col-md-4" style="margin-bottom:30px; padding:0px">
          <div class="card text-white bg-primary">
          <img class="card-img-top" src="img/categser.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Manage Service Categories</h5>
              <p class="card-text">Add new service categories, Update or Delete existing categories</p>
              <a href="crudkategoriserv.php" class="btn btn-light">Manage</a>
            </div>
          </div>
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

    