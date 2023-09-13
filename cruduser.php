<?php 
	session_start();
	include 'dbconnect.php';

  if(isset($_POST["adduser"])) {
        $email=$_POST['email'];
        $password= md5($_POST['password']);
        $namalengkap=$_POST['namalengkap'];
        $notlp=$_POST['notlp'];
        $alamat=$_POST['alamat'];
        $level=$_POST['level'];

        $tambahuser = mysqli_query($connect,"insert into datauser (namalengkap, email, password, notlp, alamat, level) 
		values('$namalengkap','$email','$password','$notlp','$alamat','$level')");

		if ($tambahuser){
		echo " <div class='alert alert-success'>
			Berhasil tambah user
		  </div>
		<meta http-equiv='refresh' content='1; url= cruduser.php'/>  ";
		} else { echo "<div class='alert alert-warning'>
			Gagal tambah user
		  </div>
		 <meta http-equiv='refresh' content='1; url= cruduser.php'/> ";
		}
	};
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pet Kingdom - Manage Users</title>
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
                <h3>Daftar User</h3>
                <button data-toggle="modal" data-target="#tambah" class="btn btn-info col-md-2 float-right">Tambah User</button>
            </div>
            <table id="dtBasicExample" class="table table-bordered display">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Password</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">No Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col"width="10%">Tgl Join</th>
                    <th scope="col">Status</th>
                    <th scope="col" width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
              $user=mysqli_query($connect,"SELECT * from datauser order by userid ASC");
              $no=1;
              while($p=mysqli_fetch_array($user)){
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $p['email'] ?></td>
                    <td><?php echo $p['password'] ?></td>
                    <td><?php echo $p['namalengkap'] ?></td>
                    <td><?php echo $p['notlp'] ?></td>
                    <td><?php echo $p['alamat'] ?></td>
                    <td><?php echo $p['created'] ?></td>
                    <td><?php echo $p['level'] ?></td>
                    <td>
                      <button class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#update<?php echo $p['userid'] ?>">Update</button>
                      <button class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#delete<?php echo $p['userid'] ?>">Delete</button>
                    </td>
                </tr>

                <!--Modal Update-->
              <div class="modal fade" id="update<?php echo $p['userid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                            <form action="cruduser_function.php?act=updateuser" method="post" enctype="multipart/form-data" >
                              <?php
                              $userid = $p['userid'];
                              $query = "select * from datauser where userid = '$userid'";
                              $sql = mysqli_query($connect, $query);
                              while($us = mysqli_fetch_assoc($sql)){
                              ?>
                                <div class="form-group">
                                    <label>ID User</label>
                                    <input name="userid" type="text" class="form-control" value="<?php echo $us['userid']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input name="namalengkap" type="text" class="form-control" value="<?php echo $us['namalengkap']; ?>" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" type="text" class="form-control" value="<?php echo $us['email']; ?>" required="@" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="text" value="<?php echo md5($us['password']); ?>" class="form-control" autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input name="notlp" type="number" class="form-control" value="<?php echo $us['notlp']; ?>" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" type="" class="form-control" required><?php echo $us['alamat']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="level" class="form-control">
                                        <option <?php if ($p['level'] == 'Customer') { echo 'selected'; }?> value="Customer">Customer</option>
                                        <option <?php if ($p['level'] == 'Admin') { echo 'selected'; }?> value="Admin">Admin</option>
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
              <div class="modal fade" id="delete<?php echo $p['userid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      User <?php echo $p['namalengkap'] ?> akan dihapus. Apakah kamu yakin?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button> 
                      <a href="cruduser_function.php?act=deleteuser&id=<?php echo $p['userid']; ?>" class="btn btn-danger">Hapus</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
              <form method="post" enctype="multipart/form-data" >
					<div class="form-group">
						<label>Nama Lengkap</label>
						<input name="namalengkap" type="text" class="form-control" required autofocus>
					</div>
                    <div class="form-group">
						<label>Email</label>
						<input name="email" type="text" class="form-control" required="@" autofocus>
					</div>
                    <div class="form-group">
						<label>Password</label>
						<input name="password" type="text" class="form-control" autofocus>
					</div>
                    <div class="form-group">
						<label>Nomor Telepon</label>
						<input name="notlp" type="number" class="form-control" required autofocus>
					</div>
                    <div class="form-group">
						<label>Alamat</label>
						<textarea name="alamat" type="" class="form-control" required></textarea>
					</div>
                    <div class="form-group">
						<label>Status</label>
						<select name="level" class="form-control">
                            <option value="Customer">Customer</option>
                            <option value="Admin">Admin</option>
						</select>	
					</div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <input name="adduser" type="submit" class="btn btn-primary" value="Tambah">
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