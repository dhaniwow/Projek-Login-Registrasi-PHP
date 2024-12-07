<?php
// Fungsi koneksi ke database
function dbConnect() {
    $serverName = ""; // Ganti dengan nama server SQL Server Anda
    $connectionOptions = [
        "Database" => "RESERVASILAPANGAN", // nama database
        "CharacterSet" => "UTF-8",
    ];
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    return $conn;
}

function generateUserID($role, $counter) {
    $prefix = "";
    // Mendapatkan tahun dan bulan saat ini
    $yearMonth = date('ym'); // Format YYMM

    // Mendapatkan prefix berdasarkan role
    switch ($role) {
        case 'Customer':
            $prefix = "CST";
            break;
        case 'Owner':
            $prefix = "OWN";
            break;
        case 'Admin':
            $prefix = "ADM";
            break;
        case 'Staff':
            $prefix = "STF";
            break;
        default:
            return null; // Invalid role
    }

    // Menggabungkan prefix dengan tahun, bulan, dan nomor urut 3 digit
    return $prefix . $yearMonth . str_pad($counter, 3, '0', STR_PAD_LEFT);
    
}

function registerUser($namaLengkap, $email, $noTelepon, $password, $konfirmasiPass, $role) {
    // Validasi input
    if (empty($namaLengkap) || empty($email) || empty($noTelepon) || empty($password) || empty($konfirmasiPass)) {
        return "Semua field harus diisi.";
    }

    if ($password !== $konfirmasiPass) {
        return "Password dan Konfirmasi Password tidak cocok.";
    }

    // Koneksi ke database
    $conn = dbConnect();

    // Cek apakah email sudah ada
    $query = "SELECT * FROM Penggunasistem WHERE EmailUser = ?";
    $params = [$email];
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false || sqlsrv_has_rows($stmt)) {
        return "Email sudah terdaftar.";
    }

    // Enkripsi password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Menghitung nomor urut
    $counterQuery = "SELECT COUNT(*) AS count FROM Penggunasistem WHERE RoleUser = ? AND TglRegistrasi >= ?";
    $currentDate = date('Y-m-01'); // Ambil bulan dan tahun saat ini
    $counterParams = [$role, $currentDate];
    $counterStmt = sqlsrv_query($conn, $counterQuery, $counterParams);
    $row = sqlsrv_fetch_array($counterStmt, SQLSRV_FETCH_ASSOC);
    $counter = $row['count'] + 1; // Menambahkan 1 untuk mendapatkan nomor urut

    // Generate UserID
    $userID = generateUserID($role, $counter);

    // Menyimpan data pengguna baru
    $insertQuery = "INSERT INTO Penggunasistem (UserID, NamaLengkap, EmailUser, Telepon, PasswordUser, RoleUser) VALUES (?, ?, ?, ?, ?, ?)";
    $insertParams = [$userID, $namaLengkap, $email, $noTelepon, $hashedPassword, $role];
    $insertStmt = sqlsrv_query($conn, $insertQuery, $insertParams);

    if ($insertStmt === false) {
        return "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
    }

    return "Registrasi berhasil!";
}

function loginUser($email, $password) {
    // Koneksi ke database
    $conn = dbConnect();

    // Query untuk mendapatkan pengguna berdasarkan email
    $query = "SELECT * FROM Penggunasistem WHERE EmailUser = ?";
    $params = [$email];
    $stmt = sqlsrv_query($conn, $query, $params);

    if ($stmt === false) {
        return "Terjadi kesalahan saat melakukan login.";
    }

    // Ambil data pengguna
    $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    
    // Cek jika pengguna ditemukan
    if ($user === null) {
        return "Email atau password salah.";
    }

    // Verifikasi password
    if (!password_verify($password, $user['PasswordUser'])) {
        return "Email atau password salah.";
    }

    // Jika login berhasil, simpan informasi pengguna dalam session
    session_start();
    $_SESSION['userID'] = $user['UserID'];
    $_SESSION['role'] = $user['RoleUser'];
    $_SESSION['namaLengkap'] = $user['NamaLengkap'];

    // Redirect berdasarkan role
    switch ($user['RoleUser']) {
        case 'Customer':
            header("Location: customerrl.php");
            exit();
        case 'Owner':
            header("Location: ownerrl.php");
            exit();
        case 'Admin':
            header("Location: admin.php");
            exit();
        case 'Staff':
            header("Location: staff.php");
            exit();
        default:
            return "Role tidak dikenali.";
    }
}

?>