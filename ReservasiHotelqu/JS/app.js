const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

// berubah dari registrasi menjadi penyewa dan registrasi sebagai Penyedia
function showForm(formId) {
  // Sembunyikan semua form
  var forms = document.querySelectorAll(".form-container");
  forms.forEach(function (form) {
    form.classList.remove("active");
  });
  // Tampilkan form yang dipilih
  document.getElementById(formId).classList.add("active");
}



// manmpilkan dan menyembunyikan password
// Ambil semua elemen dengan kelas "togglePassword"
const togglePasswordIcons = document.querySelectorAll(".togglePassword");

togglePasswordIcons.forEach((icon) => {
  icon.addEventListener("click", function () {
    // Ambil elemen input password yang sesuai
    const passwordInput = this.previousElementSibling; // Mengambil input sebelumnya (input password)

    // Cek tipe dari input password
    if (passwordInput.type === "password") {
      // Jika tipe adalah "password", ubah menjadi "text" agar password terlihat
      passwordInput.type = "text";

      // Ganti ikon dari "mata tertutup" (fa-eye-slash) menjadi "mata terbuka" (fa-eye)
      this.classList.remove("fa-eye-slash");
      this.classList.add("fa-eye");
    } else {
      // Jika tipe adalah "text", ubah kembali menjadi "password" agar password tersembunyi
      passwordInput.type = "password";

      // Ganti ikon dari "mata terbuka" (fa-eye) menjadi "mata tertutup" (fa-eye-slash)
      this.classList.remove("fa-eye");
      this.classList.add("fa-eye-slash");
    }
  });
});

// password eye kode ini berlaku jika input type password hanya 1 dalam 1 file
// document.getElementById("togglePassword").addEventListener("click", function () {
//   // Ambil elemen input dan ikon
//   const passwordInput = document.getElementById("password");
//   const toggleIcon = this;

//   // Ubah tipe input antara "password" dan "text"
//   if (passwordInput.type === "password") {
//     passwordInput.type = "text"; // Ubah tipe input menjadi teks
//     toggleIcon.classList.remove("fa-eye-slash"); // Hapus ikon mata tertutup
//     toggleIcon.classList.add("fa-eye"); // Tambahkan ikon mata terbuka
//   } else {
//     passwordInput.type = "password"; // Ubah tipe input menjadi password
//     toggleIcon.classList.remove("fa-eye"); // Hapus ikon mata terbuka
//     toggleIcon.classList.add("fa-eye-slash"); // Tambahkan ikon mata tertutup
//   }
// });

// jika input type password lebih dari satu maka kode seperti di bawah ini yaitu menggunakan Delegasi dan Kelas

// Tambahkan event listener pada ikon toggle password
// document.getElementById("togglePassword").addEventListener("click", function () {

//   // Ambil elemen input password menggunakan ID "password"
//   const passwordInput = document.getElementById("password");

//   // Ambil elemen ikon toggle yang sedang diklik (this mengacu ke elemen yang memicu event ini)
//   const toggleIcon = this;

//   // Cek tipe dari input password
//   if (passwordInput.type === "password") {
//     // Jika tipe adalah "password", ubah menjadi "text" agar password terlihat
//     passwordInput.type = "text";

//     // Ganti ikon dari "mata tertutup" (fa-eye-slash) menjadi "mata terbuka" (fa-eye)
//     toggleIcon.classList.remove("fa-eye-slash"); // Hapus kelas "fa-eye-slash"
//     toggleIcon.classList.add("fa-eye");         // Tambahkan kelas "fa-eye"
//   } else {
//     // Jika tipe adalah "text", ubah kembali menjadi "password" agar password tersembunyi
//     passwordInput.type = "password";

//     // Ganti ikon dari "mata terbuka" (fa-eye) menjadi "mata tertutup" (fa-eye-slash)
//     toggleIcon.classList.remove("fa-eye");      // Hapus kelas "fa-eye"
//     toggleIcon.classList.add("fa-eye-slash");   // Tambahkan kelas "fa-eye-slash"
//   }
// });
