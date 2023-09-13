<?php
include 'dbconnect.php';

if($_GET['act']=='deleteproduk'){
    $idproduk = $_GET['id'];
    $querydelete = "delete from produk where idproduk = '$idproduk'";
    $sql = mysqli_query($connect, $querydelete);
            
    if($sql){
      echo "<div class='alert alert-success'>
        Berhasil hapus produk
        </div>
        <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
    }else{
      echo "<div class='alert alert-warning'>
        Gagal hapus produk
        </div>
        <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
    }
  } else if ($_GET['act']=='updateproduk'){
    $idproduk = $_POST['idproduk'];
    $namaproduk=$_POST['namaproduk'];
		$idkategori=$_POST['idkategori'];
		$deskripsi=$_POST['deskripsi'];
		$harga=$_POST['harga'];
    $availability=$_POST['availability'];

    $nama_file = $_FILES['uploadgambar']['name'];

    if($nama_file != ""){
      //jika gambar ingin diganti
      $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
      $random = crypt($nama_file, time());
      $ukuran_file = $_FILES['uploadgambar']['size'];
      $tipe_file = $_FILES['uploadgambar']['type'];
      $tmp_file = $_FILES['uploadgambar']['tmp_name'];
      $path = "Product/".$random.'.'.$ext;
      $pathdb = "Product/".$random.'.'.$ext;

      if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
        if($ukuran_file <= 5000000){ 
          if(move_uploaded_file($tmp_file, $path)){ 
            $sql = mysqli_query($connect, "update produk set namaproduk='$namaproduk', idkategori='$idkategori', deskripsi='$deskripsi', gambar='$pathdb', harga='$harga',availability='$availability' 
                where idproduk='$idproduk' ");
          
            if($sql){
              echo "<div class='alert alert-success'>
                Berhasil update produk
                </div>
                <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
            }else{
              echo "<div class='alert alert-warning'>
                Gagal update produk, silakan coba lagi.
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

    } else {
      $sql = mysqli_query($connect, "update produk set namaproduk='$namaproduk', idkategori='$idkategori', deskripsi='$deskripsi', harga='$harga',availability='$availability' 
                where idproduk='$idproduk' ");
          
          if($sql){
            echo "<div class='alert alert-success'>
              Berhasil update produk
              </div>
              <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
          }else{
            echo "<div class='alert alert-warning'>
              Gagal update produk, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudproduk.php'>";
          }
    }
  };

?>

<link rel="stylesheet" href="dist/css/bootstrap.min.css">