<?php
// Nanti kalau file koneksi.php dari temanmu sudah digabung, hapus tanda double slash (//) di bawah ini:
// include 'koneksi.php';

// Menangkap data yang diketik mahasiswa dari form registrasi
$nama     = $_POST['nama'];
$email    = $_POST['email'];
$password = $_POST['password'];
$role     = 'mahasiswa';

// Nanti kalau database & tabel sudah siap, baris query insert ini yang akan memasukkan data ke MySQL:
// $query = mysqli_query($conn, "INSERT INTO user (nama, email, password, role) VALUES ('$nama', '$email', '$password', '$role')");

// Untuk sementara supaya tidak error "Not Found" saat dites:
echo "
<script>
alert('Registrasi Berhasil! Silakan Login.');
window.location='login_mahasiswa.php';
</script>
";
?>