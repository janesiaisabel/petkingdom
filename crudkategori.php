<?php 
	session_start();
	include 'dbconnect.php';

  if(isset($_POST["addkategori"])) {
		$namakategori=$_POST['namakategori'];

    $nama_file = $_FILES['uploadgambar']['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$ukuran_file = $_FILES['uploadgambar']['size'];
		$tipe_file = $_FILES['uploadgambar']['type'];
		$tmp_file = $_FILES['uploadgambar']['tmp_name'];
		$path = "Kategori/".date('d-m-Y')."-".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/gif"){
		  if($ukuran_file <= 5000000){ 
        if(move_uploaded_file($tmp_file, $path)){ 
        
          $query = "insert into kategori (namakategori, icon)
          values('$namakategori','$path')";
          $sql = mysqli_query($connect, $query);
          
          if($sql){
            echo "<div class='alert alert-success'>
              Berhasil tambah kategori
              </div>
              <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
          }else{
            echo "<div class='alert alert-warning'>
              Gagal tambah kategori, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
          }
        }else{
          echo "<div class='alert alert-warning'>
              Gagal melakukan upload file, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
        }
		  }else{
        echo "<div class='alert alert-warning'>
          Gagal melakukan upload file, ukuran file melebihi batas yang ditentukan (1MB).
          </div>
          <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
		  }
		}else{
		  echo "<div class='alert alert-warning'>
        Gagal melakukan upload file, tipe file yang diterima adalah JPG/PNG.
        </div>
        <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
    }
	};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Manage Categories</title>
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
            while($k=mysqli_fetch_array($kat)){
              ?>
            <a class="dropdown-item" href="produk.php?idkategori=<?php echo $k['idkategori'] ?>"><?php echo $k['namakategori'] ?></a>
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
            while($k=mysqli_fetch_array($kat)){
              ?>
            <a class="dropdown-item" href="service.php?idkategoriserv=<?php echo $k['idkategoriserv'] ?>"><?php echo $k['namakategoriserv'] ?></a>
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
   <div style="background-image: url(img/bgtiles.jpg); background-attachment: fixed; min-height:600px">
    <div style="padding: 50px;">
        <div class="card">
            <div class="card-body d-sm-flex justify-content-between align-items-center">
                <h3>Daftar Kategori Produk</h3>
                <button data-toggle="modal" data-target="#tambah" class="btn btn-info col-md-2 float-right">Tambah Kategori</button>
            </div>
            <table id="dtBasicExample" class="table table-bordered display">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Kategori</th>
                    <th scope="col" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $kategori=mysqli_query($connect,"SELECT * from kategori order by idkategori ASC");
              $no=1;
              while($p=mysqli_fetch_array($kategori)){
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><img src="<?php echo $p['icon'] ?>" width="100px"></td>
                    <td><?php echo $p['namakategori'] ?></td>
                    <td>
                      <button class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#update<?php echo $p['idkategori'] ?>">Update</button>
                      <button class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#delete<?php echo $p['idkategori'] ?>">Delete</button>
                    </td>
                </tr>

                <!--Modal Update-->
              <div class="modal fade" id="update<?php echo $p['idkategori'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Kategori</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <form action="crudkategori_function.php?act=updatekategori" method="post" enctype="multipart/form-data" >
                              <?php
                              $idkategori = $p['idkategori'];
                              $query = "select * from kategori where idkategori = '$idkategori'";
                              $sql = mysqli_query($connect, $query);
                              while($pr = mysqli_fetch_assoc($sql)){
                              ?>
                              <div class="form-group">
                                <label>ID Kategori</label>
                                <input name="idkategori" type="text" class="form-control" value="<?php echo $pr['idkategori']; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label>Nama Kategori</label>
                                <input name="namakategori" type="text" class="form-control" value="<?php echo $pr['namakategori']; ?>" required autofocus>
                              </div>
                              <div class="form-group">
                                <label>Gambar</label>
                                <input name="uploadgambar" type="file" class="form-control">
                                <img src="<?php echo $pr['icon']; ?>" style="height:100px;">
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <input type="submit" name="submit" class="btn btn-primary" value="Update">
                              </div>
                              <?php
                                  };
                                ?>
                            </form>
                        </div>
                  </div>
                </div>
              </div>
                <!--Modal Delete-->
            <div class="modal fade" id="delete<?php echo $p['idkategori'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Kategori <?php echo $p['namakategori'] ?> akan dihapus. Apakah kamu yakin?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> 
                      <a href="crudkategori_function.php?act=deletekategori&id=<?php echo $p['idkategori']; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                };
              ?>
            </tbody>
            </table>
        </div>
    </div>

  <!-- Modal Tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label>Nama Kategori</label>
									<input name="namakategori" type="text" class="form-control" required autofocus>
								</div>
                                <div class="form-group">
									<label>Gambar</label>
									<input name="uploadgambar" type="file" class="form-control" required>
								</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input name="addkategori" type="submit" class="btn btn-primary" value="Tambah">
                </div>
              </form>
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
</div>

  <script src="dist/js/jquery-3.6.0.min.js"></script>
  <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>