<?php
include 'dbconnect.php';

if($_GET['act']=='deletekategori'){
    $idkategori = $_GET['id'];
    $querydelete = "delete from kategori where idkategori = '$idkategori'";
    $sql = mysqli_query($connect, $querydelete);
            
    if($sql){
      echo "<div class='alert alert-success'>
        Berhasil hapus kategori
        </div>
        <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
    }else{
      echo "<div class='alert alert-warning'>
        Gagal hapus kategori
        </div>
        <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
    }
  } else if ($_GET['act']=='updatekategori'){
    $idkategori = $_POST['idkategori'];
    $namakategori=$_POST['namakategori'];

    $nama_file = $_FILES['uploadgambar']['name'];

    if($nama_file != ""){
      //jika gambar ingin diganti
      $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
      $ukuran_file = $_FILES['uploadgambar']['size'];
      $tipe_file = $_FILES['uploadgambar']['type'];
      $tmp_file = $_FILES['uploadgambar']['tmp_name'];
      $path = "Kategori/".date('d-m-Y')."-".$nama_file;

      if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/gif"){
        if($ukuran_file <= 5000000){ 
          if(move_uploaded_file($tmp_file, $path)){ 
            $sql = mysqli_query($connect, "update kategori set namakategori='$namakategori', icon='$path'
                where idkategori='$idkategori' ");
          
            if($sql){
              echo "<div class='alert alert-success'>
                Berhasil update kategori
                </div>
                <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
            }else{
              echo "<div class='alert alert-warning'>
                Gagal update kategori, silakan coba lagi.
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

    } else {
      $sql = mysqli_query($connect, "update kategori set namakategori='$namakategori'
                where idkategori='$idkategori' ");
          
          if($sql){
            echo "<div class='alert alert-success'>
              Berhasil update kategori
              </div>
              <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
          }else{
            echo "<div class='alert alert-warning'>
              Gagal update kategori, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudkategori.php'>";
          }
    }
  };
?>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">