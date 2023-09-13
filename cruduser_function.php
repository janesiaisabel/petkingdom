<?php
include 'dbconnect.php';

if($_GET['act']=='deleteuser'){
    $userid = $_GET['id'];
    $querydelete = "delete from datauser where userid = '$userid'";
    $sql = mysqli_query($connect, $querydelete);
            
    if($sql){
      echo "<div class='alert alert-success'>
        Berhasil hapus user
        </div>
        <meta http-equiv='refresh' content='1; URL=cruduser.php'>";
    }else{
      echo "<div class='alert alert-warning'>
        Gagal hapus user
        </div>
        <meta http-equiv='refresh' content='1; URL=cruduser.php'>";
    }
  } else if ($_GET['act']=='updateuser'){
    $userid = $_POST['userid'];
    $email=$_POST['email'];
    $password= md5($_POST['password']);
    $namalengkap=$_POST['namalengkap'];
    $notlp=$_POST['notlp'];
    $alamat=$_POST['alamat'];
    $level=$_POST['level'];

    $sql = mysqli_query($connect, "update datauser set email='$email', password='$password', namalengkap='$namalengkap', notlp='$notlp',alamat='$alamat',level='$level' 
            where userid='$userid' ");
          
    if($sql){
        echo "<div class='alert alert-success'>
          Berhasil update user
          </div>
          <meta http-equiv='refresh' content='1; URL=cruduser.php'>";
      }else{
        echo "<div class='alert alert-warning'>
          Gagal update user
          </div>
          <meta http-equiv='refresh' content='1; URL=cruduser.php'>";
      }
    };
?>
<link rel="stylesheet" href="dist/css/bootstrap.min.css">