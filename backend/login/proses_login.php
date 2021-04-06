<?php
    session_start();

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    include '../../database/koneksi.php';

    $sqlLogin  = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
    $login     = mysqli_query($host, $sqlLogin);
    $cek       = mysqli_num_rows($login); 
    
    // cek apakah username dan password di temukan pada database
    if($cek > 0){
    
      $data = mysqli_fetch_assoc($login);
    
      // Cek data dengan level admin
      if($data['level']=="admin"){
    
        $_SESSION['username'] = $username;
        $_SESSION['level']    = "admin";
        $_SESSION['nama']     = $data['nama'];
        $_SESSION['id_user']  = $data['id_user'];

          echo "
            <script>
              window.location.href='../../beranda.php?page=beranda';
            </script>
          ";
      } else {
        header("location:../../login.php?pesan=Password_Salah");
      }
    }else{

      header("location:../../login.php?pesan=gagal");
      // echo "data tidak terdapat pada database";
    }
?>