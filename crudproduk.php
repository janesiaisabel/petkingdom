<?php 
	session_start();
	include 'dbconnect.php';

  if(isset($_POST["addproduct"])) {
		$namaproduk=$_POST['namaproduk'];
		$idkategori=$_POST['idkategori'];
		$deskripsi=$_POST['deskripsi'];
		$harga=$_POST['harga'];
    $availability=$_POST['availability'];

    $nama_file = $_FILES['uploadgambar']['name'];
		$ext = pathinfo($nama_file, PATHINFO_EXTENSION);
		$ukuran_file = $_FILES['uploadgambar']['size'];
		$tipe_file = $_FILES['uploadgambar']['type'];
		$tmp_file = $_FILES['uploadgambar']['tmp_name'];
		$path = "Product/".date('d-m-Y')."-".$nama_file;

    if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
		  if($ukuran_file <= 5000000){ 
        if(move_uploaded_file($tmp_file, $path)){ 
        
          $query = "insert into produk (idkategori, namaproduk, gambar, deskripsi, harga, availability)
          values('$idkategori','$namaproduk','$path','$deskripsi','$harga','$availability')";
          $sql = mysqli_query($connect, $query);
          
          if($sql){
            echo "<div class='alert alert-success'>
              Berhasil tambah produk
              </div>
              <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
          }else{
            echo "<div class='alert alert-warning'>
              Gagal tambah produk, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
          }
        }else{
          echo "<div class='alert alert-warning'>
              Gagal melakukan upload file, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
        }
		  }else{
        echo "<div class='alert alert-warning'>
          Gagal melakukan upload file, ukuran file melebihi batas yang ditentukan (1MB).
          </div>
          <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
		  }
		}else{
		  echo "<div class='alert alert-warning'>
        Gagal melakukan upload file, tipe file yang diterima adalah JPG/PNG.
        </div>
        <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
    }
	};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Manage Products</title>
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
                <h3>Daftar Produk</h3>
                <button data-toggle="modal" data-target="#tambah" class="btn btn-info col-md-2 float-right">Tambah Produk</button>
            </div>
            <table id="example" class="table table-bordered display">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Harga</th>
                    <th scope="col" width="25%">Deskripsi</th>
                    <th scope="col">Ketersediaan</th>
                    <th scope="col" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $produk=mysqli_query($connect,"SELECT * from kategori k, produk p where k.idkategori=p.idkategori order by idproduk ASC");
              $no=1;
              while($p=mysqli_fetch_array($produk)){
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><img src="<?php echo $p['gambar'] ?>" width="100px"></td>
                    <td><?php echo $p['namaproduk'] ?></td>
                    <td><?php echo $p['namakategori'] ?></td>
                    <td><?php echo $p['harga'] ?></td>
                    <td><?php echo $p['deskripsi'] ?></td>
                    <td><?php echo $p['availability'] ?></td>
                    <td>
                      <button class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#update<?php echo $p['idproduk'] ?>">Update</button>
                      <button class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#delete<?php echo $p['idproduk'] ?>">Delete</button>
                    </td>
                </tr>

                <!--Modal Update-->
              <div class="modal fade" id="update<?php echo $p['idproduk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update Produk</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <form action="crudproduk_function.php?act=updateproduk" method="post" enctype="multipart/form-data" >
                              <?php
                              $idproduk = $p['idproduk'];
                              $query = "select * from produk where idproduk = '$idproduk'";
                              $sql = mysqli_query($connect, $query);
                              while($pr = mysqli_fetch_assoc($sql)){
                              ?>
                              <div class="form-group">
                                <label>ID Produk</label>
                                <input name="idproduk" type="text" class="form-control" value="<?php echo $pr['idproduk']; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label>Nama Produk</label>
                                <input name="namaproduk" type="text" class="form-control" value="<?php echo $pr['namaproduk']; ?>" required autofocus>
                              </div>
                              <div class="form-group">
                                <label>Nama Kategori</label>
                                <select name="idkategori" class="form-control">
                                <?php
                                  $kat=mysqli_query($connect,"select * from kategori order by namakategori ASC")or die(mysqli_error());
                                  while($d=mysqli_fetch_array($kat)){
                                ?>
                                  <option <?php if ($d['idkategori'] == $p['idkategori']) { echo 'selected'; }?> value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
                                <?php
                                  }
                                ?>		
                                </select>	
                              </div>
                              <div class="form-group">
                                <label>Harga</label>
                                <input name="harga" type="number" class="form-control" value="<?php echo $pr['harga']; ?>" required>
                              </div>
                              <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" type="" class="form-control" required><?php echo $pr['deskripsi']; ?></textarea>
                              </div>
                              <div class="form-group">
                                <label>Gambar</label>
                                <input name="uploadgambar" type="file" class="form-control">
                                <img src="<?php echo $pr['gambar']; ?>" style="height:100px;">
                              </div>
                              <div class="form-group">
                                <label>Ketersediaan</label>
                                <select name="availability" class="form-control">
                                  <option <?php if ($p['availability'] == 'In Stock') { echo 'selected'; }?> value="In Stock">In Stock</option>
                                  <option <?php if ($p['availability'] == 'Sold Out') { echo 'selected'; }?> value="Sold Out">Sold Out</option>
                                </select>	
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
              <div class="modal fade" id="delete<?php echo $p['idproduk'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Produk <?php echo $p['namaproduk'] ?> akan dihapus. Apakah kamu yakin?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> 
                      <a href="crudproduk_function.php?act=deleteproduk&id=<?php echo $p['idproduk']; ?>" class="btn btn-danger">Hapus</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<label>Nama Produk</label>
									<input name="namaproduk" type="text" class="form-control" required autofocus>
								</div>
								<div class="form-group">
									<label>Nama Kategori</label>
									<select name="idkategori" class="form-control">
									<?php
                    $kat=mysqli_query($connect,"select * from kategori order by namakategori ASC")or die(mysqli_error());
                    while($d=mysqli_fetch_array($kat)){
									?>
										<option value="<?php echo $d['idkategori'] ?>"><?php echo $d['namakategori'] ?></option>
									<?php
                    }
							  	?>		
									</select>	
								</div>
                <div class="form-group">
									<label>Harga</label>
									<input name="harga" type="number" class="form-control" required>
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea name="deskripsi" type="" class="form-control" required></textarea>
								</div>
                <div class="form-group">
									<label>Gambar</label>
									<input name="uploadgambar" type="file" class="form-control" required>
								</div>
                <div class="form-group">
									<label>Ketersediaan</label>
									<select name="availability" class="form-control">
                    <option value="In Stock">In Stock</option>
                    <option value="Sold Out">Sold Out</option>
									</select>	
								</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input name="addproduct" type="submit" class="btn btn-primary" value="Tambah">
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
  <script>
    $(document).ready(function () {
      $('#example').DataTable({
          pagingType: 'full_numbers',
      });   
    });
  </script>
  <script src="dist/js/jquery-3.6.0.min.js"></script>
  <script src="dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>