<?php
include 'dbconnect.php';

if($_GET['act']=='deletekategoriserv'){
    $idkategoriserv = $_GET['id'];
    $querydelete = "delete from kategori_service where idkategoriserv = '$idkategoriserv'";
    $sql = mysqli_query($connect, $querydelete);
            
    if($sql){
      echo "<div class='alert alert-success'>
        Berhasil hapus kategori
        </div>
        <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
    }else{
      echo "<div class='alert alert-warning'>
        Gagal hapus kategori
        </div>
        <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
    }
  } else if ($_GET['act']=='updatekategoriserv'){
    $idkategoriserv = $_POST['idkategoriserv'];
    $namakategoriserv=$_POST['namakategoriserv'];

    $nama_file = $_FILES['uploadgambar']['name'];

    if($nama_file != ""){
      //jika gambar ingin diganti
      $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
      $ukuran_file = $_FILES['uploadgambar']['size'];
      $tipe_file = $_FILES['uploadgambar']['type'];
      $tmp_file = $_FILES['uploadgambar']['tmp_name'];
      $path = "Kategoriserv/".date('d-m-Y')."-".$nama_file;

      if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $tipe_file == "image/gif"){
        if($ukuran_file <= 5000000){ 
          if(move_uploaded_file($tmp_file, $path)){ 
            $sql = mysqli_query($connect, "update kategori_service set namakategoriserv='$namakategoriserv', icon='$path'
                where idkategoriserv='$idkategoriserv' ");
          
            if($sql){
              echo "<div class='alert alert-success'>
                Berhasil update kategori
                </div>
                <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
            }else{
              echo "<div class='alert alert-warning'>
                Gagal update kategori, silakan coba lagi.
                </div>
                <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
            }
          }else{
            echo "<div class='alert alert-warning'>
                Gagal melakukan upload file, silakan coba lagi.
                </div>
                <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
          }
        }else{
          echo "<div class='alert alert-warning'>
            Gagal melakukan upload file, ukuran file melebihi batas yang ditentukan (1MB).
            </div>
            <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
        }
      }else{
        echo "<div class='alert alert-warning'>
          Gagal melakukan upload file, tipe file yang diterima adalah JPG/PNG.
          </div>
          <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
      }

    } else {
      $sql = mysqli_query($connect, "update kategori_service set namakategoriserv='$namakategoriserv'
                where idkategoriserv='$idkategoriserv' ");
          
          if($sql){
            echo "<div class='alert alert-success'>
              Berhasil update kategori
              </div>
              <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
          }else{
            echo "<div class='alert alert-warning'>
              Gagal update kategori, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudkategoriserv.php'>";
          }
    }
  };
?>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">