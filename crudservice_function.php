<?php
include 'dbconnect.php';

if($_GET['act']=='deleteservice'){
    $idservice = $_GET['id'];
    $querydelete = "delete from services where idservice = '$idservice'";
    $sql = mysqli_query($connect, $querydelete);
            
    if($sql){
      echo "<div class='alert alert-success'>
        Berhasil hapus service
        </div>
        <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
    }else{
      echo "<div class='alert alert-warning'>
        Gagal hapus service
        </div>
        <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
    }
  } else if ($_GET['act']=='updateservice'){
    $idservice = $_POST['idservice'];
    $namaservice=$_POST['namaservice'];
	$idkategoriserv=$_POST['idkategoriserv'];
	$deskripsi=$_POST['deskripsi'];
	$harga=$_POST['harga'];

    $nama_file = $_FILES['uploadgambar']['name'];

    if($nama_file != ""){
      //jika gambar ingin diganti
      $ext = pathinfo($nama_file, PATHINFO_EXTENSION);
      $ukuran_file = $_FILES['uploadgambar']['size'];
      $tipe_file = $_FILES['uploadgambar']['type'];
      $tmp_file = $_FILES['uploadgambar']['tmp_name'];
      $path = "Service/".date('d-m-Y')."-".$nama_file;

      if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){
        if($ukuran_file <= 5000000){ 
          if(move_uploaded_file($tmp_file, $path)){ 
            $sql = mysqli_query($connect, "update services set namaservice='$namaservice', idkategoriserv='$idkategoriserv', deskripsi='$deskripsi', gambar='$path', harga='$harga'
                where idservice='$idservice' ");
          
            if($sql){
              echo "<div class='alert alert-success'>
                Berhasil update service
                </div>
                <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
            }else{
              echo "<div class='alert alert-warning'>
                Gagal update service, silakan coba lagi.
                </div>
                <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
            }
          }else{
            echo "<div class='alert alert-warning'>
                Gagal melakukan upload file, silakan coba lagi.
                </div>
                <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
          }
        }else{
          echo "<div class='alert alert-warning'>
            Gagal melakukan upload file, ukuran file melebihi batas yang ditentukan (1MB).
            </div>
            <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
        }
      }else{
        echo "<div class='alert alert-warning'>
          Gagal melakukan upload file, tipe file yang diterima adalah JPG/PNG.
          </div>
          <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
      }

    } else {
      $sql = mysqli_query($connect, "update services set namaservice='$namaservice', idkategoriserv='$idkategoriserv', deskripsi='$deskripsi', harga='$harga' 
                where idservice='$idservice' ");
          
          if($sql){
            echo "<div class='alert alert-success'>
              Berhasil update service
              </div>
              <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
          }else{
            echo "<div class='alert alert-warning'>
              Gagal update service, silakan coba lagi.
              </div>
              <meta http-equiv='refresh' content='1; URL=crudservice.php'>";
          }
    }
  };

?>

<link rel="stylesheet" href="dist/css/bootstrap.min.css">