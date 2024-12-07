<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $result = loginUser($_POST['emailLogin'], $_POST['passwordLogin']);
    if (isset($result)) {
        echo $result; // Tampilkan pesan kesalahan jika ada
    }
}

// Memproses form registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['RegisterCustomer'])) {
        $result = registerUser($_POST['namaLengkap'], $_POST['emailRegister'], $_POST['noTelepon'], $_POST['passwordRegister'], $_POST['KonfirmasiPass'], $_POST['role']);
        echo $result;
    } elseif (isset($_POST['RegisterOwner'])) {
        $result = registerUser($_POST['namaLengkap'], $_POST['emailRegister'], $_POST['noTelepon'], $_POST['passwordRegister'], $_POST['KonfirmasiPass'], $_POST['role']);
        echo $result;
     }
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
      integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="CSS/style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" action="" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" name="emailLogin"/>
            </div>
            <!-- jika input password hanya satu kode ini sangat cocok -->
            <!-- <div class="input-field">
              <i class="fas fa-lock"></i>
              <input id="password" type="password" placeholder="Password" />
              <div class="eye">
                <i id="togglePassword" class="fa-solid fa-eye-slash"></i>
              </div>
            </div> -->
            <!-- tapi jika lebih dari satu yang paling cocok adalah kode berikut -->
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input class="password" type="password" placeholder="Password" name="passwordLogin"/>
              <i class="togglePassword fa-solid fa-eye-slash"></i>
            </div>
            <button type="submit" class="btn solid" name ="login">Login</button>
            <!-- <input type="submit" value="Login" class="btn solid" /> -->
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

<!-- >>>>>>>>> Form registrasi <<<<<<<<<< -->
          <form method="POST" action="" class="sign-up-form form-container active" id="RegCst">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input name="namaLengkap" type="text" placeholder="Nama Lengkap" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input name="emailRegister" type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input name="noTelepon" type="number" placeholder="No.Tlp" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="passwordRegister" class="password" type="password" placeholder="Password" />
              <i class="togglePassword fa-solid fa-eye-slash"></i>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="KonfirmasiPass" type="password" placeholder="Konfirmasi password" />
            </div>
            <input type="hidden" name="role" value="Customer" />
            <button name="RegisterCustomer" type="submit" class="btn">Register User</button>
            <p>Ingin daftar sebagai <span class="ling" onclick="showForm('RegPtn')">Penyedia Lapangan</span></p>
            <!-- <input type="submit" class="btn" value="Sign up" /> -->
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
<!--  >>>>>>>>> Form Daftar sebagai penyedia lapangan <<<<<<<<<< -->
           <form method="POST" action="" class="sign-up-form form-container" id="RegPtn">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input name="namaLengkap" type="text" placeholder="Nama Lengkap" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input name="emailRegister" type="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input name="noTelepon" type="number" placeholder="No.Tlp" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="passwordRegister" class="password" type="password" placeholder="Password" />
              <i class="togglePassword fa-solid fa-eye-slash"></i>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input name="KonfirmasiPass" type="password" placeholder="Konfirmasi password" />
            </div>
            <input type="hidden" name="role" value="Owner" />
            <button name="RegisterOwner" type="submit" class="btn">Register Owner</button>
            <!-- <input type="submit" class="btn" value="Sign up" /> -->
             <p>Ingin daftar sebagai <span class="ling" onclick="showForm('RegCst')">Penyewa Lapangan</span></p>
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, ex ratione. Aliquid!</p>
            <button class="btn transparent" id="sign-up-btn">Sign up</button>
          </div>
          <img src="images/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.</p>
            <button class="btn transparent" id="sign-in-btn">Sign in</button>
          </div>
          <img src="images/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="JS/app.js"></script>
  </body>
</html>