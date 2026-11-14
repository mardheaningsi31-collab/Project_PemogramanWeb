<?php
include 'koneksi.php';

/* UPDATE PROFIL */

if(isset($_POST['update'])){

    $id = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    mysqli_query($conn,"
        UPDATE user SET
        nama='$nama',
        email='$email',
        password='$password'
        WHERE id_user='$id'
    ");

    header("Location: profil.php");
    exit;
}

/* AMBIL ADMIN PERTAMA */

$query = mysqli_query($conn,
"SELECT * FROM user WHERE role='admin' LIMIT 1");

$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Admin - EduPractice</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#F2F5F9;
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */

.sidebar{
    width:260px;
    background:white;
    border-right:1px solid #DDE4EE;
    padding:25px;
}

.logo{
    text-align:center;
    margin-bottom:35px;
}

.logo h2{
    color:#23406A;
}

.logo p{
    color:#7D879B;
    font-size:13px;
}

.menu a{
    display:block;
    text-decoration:none;
    background:#EEF3FA;
    color:#23406A;
    padding:14px;
    border-radius:12px;
    margin-bottom:10px;
    border:1px solid #DDE4EE;
}

.menu a:hover{
    background:#DDE8F5;
}

.active{
    background:#23406A !important;
    color:white !important;
}

/* CONTENT */

.content{
    flex:1;
    padding:30px;
}

.card{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.card h1{
    color:#23406A;
    margin-bottom:10px;
}

.card p{
    color:#6D788C;
    margin-bottom:20px;
}

.profile-info{
    background:#EEF3FA;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
}

.profile-info p{
    margin:8px 0;
}

/* FORM */

form{
    display:grid;
    gap:12px;
}

input{
    padding:12px;
    border:1px solid #DDE4EE;
    border-radius:10px;
}

button{
    background:#23406A;
    color:white;
    border:none;
    padding:12px;
    border-radius:10px;
    cursor:pointer;
}

button:hover{
    background:#1C3152;
}

</style>

</head>
<body>

<div class="sidebar">

    <div class="logo">
        <h2>EduPractice</h2>
        <p>Portal PLK Sumbar</p>
    </div>

    <div class="menu">
        <a href="dashboard_admin.php">🏠 Dashboard</a>
        <a href="kelola_sekolah.php">🏫 Kelola Sekolah</a>
        <a href="kelola_dokumen.php">📄 Kelola Dokumen</a>
        <a href="kelola_panduan.php">📚 Panduan PLK</a>
        <a href="profil.php" class="active">👤 Profil</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<div class="content">

    <div class="card">

        <h1>Profil Admin</h1>
        <p>Informasi akun administrator EduPractice.</p>

        <div class="profile-info">
            <p><strong>Nama:</strong> <?= $data['nama']; ?></p>
            <p><strong>Email:</strong> <?= $data['email']; ?></p>
            <p><strong>Role:</strong> <?= strtoupper($data['role']); ?></p>
        </div>

        <form method="POST">

            <input
            type="hidden"
            name="id_user"
            value="<?= $data['id_user']; ?>">

            <input
            type="text"
            name="nama"
            value="<?= $data['nama']; ?>"
            placeholder="Nama">

            <input
            type="email"
            name="email"
            value="<?= $data['email']; ?>"
            placeholder="Email">

            <input
            type="text"
            name="password"
            value="<?= $data['password']; ?>"
            placeholder="Password">

            <button
            type="submit"
            name="update">
                Simpan Perubahan
            </button>

        </form>

    </div>

</div>

</body>
</html>