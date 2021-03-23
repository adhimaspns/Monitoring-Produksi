<?php
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    include '../../database/koneksi.php';

    // $login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
    $sqlLogin  = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
    $login     = mysqli_query($host, $sqlLogin);
    $cek = mysqli_num_rows($login); 
    
    // cek apakah username dan password di temukan pada database
    if($cek > 0){
    
      $data = mysqli_fetch_assoc($login);
    
      // cek jika user login sebagai admin
      if($data['level']=="admin"){
    
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "admin";
        // alihkan ke halaman dashboard admin
        // header("location:halaman_admin.php");
    
      // cek jika user login sebagai pegawai
      }
    }else{
      // header("location:index.php?pesan=gagal");
      echo "data tidak terdapat pada database";
    }
?>