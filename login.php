<?php
session_start();

include 'dbconnect.php';


if(isset($_POST['submit']))
	{
	$email = $_POST['email'];
	$pass = md5($_POST['pass']);
	$sql = "SELECT * FROM datauser WHERE email='$email' AND password='$pass'";
    $result = mysqli_query($connect, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['userid'];
		$_SESSION['level'] = $row['level'];
		$_SESSION['notelp'] = $row['notlp'];
		$_SESSION['name'] = $row['namalengkap'];
		$_SESSION['log'] = "Logged";
        header("Location: home.php");
    } else {
        echo "<div class='alert alert-warning'>
			Gagal login, Username atau password salah.
		  </div>
          <meta http-equiv='refresh' content='1; url= login.php'/> ";
    }
	}

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

    <div style="background-image: url(img/bgtiles.jpg); background-attachment: fixed;">
    <!--Form-->
    <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <div class="text-center">
                    <div class="card-body">
                        <img src="img/logo.png" alt="logo" width="40%" style="margin:auto">
                    </div>
                    <h3 style="margin-bottom:30px">Login</h3>
                </div>
                    <form method="post" style="margin:10px 20px">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" aria-describedby="emailHelp" required="@">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" required>
                        </div>
                        <div class="text-center" style="padding-top:30px">
                            <button type="submit" name="submit" class="btn btn-info" style="width:40%">Login</button>
                    </form>
			        <p style="margin-top:50px">Belum terdaftar? <a href="daftar.php">Daftar Sekarang</a></p>
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