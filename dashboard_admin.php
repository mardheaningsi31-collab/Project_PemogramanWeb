<?php
session_start();
include 'koneksi.php';

$nama = $_SESSION['nama'];

// Total Sekolah
$qSekolah = mysqli_query($conn, "SELECT COUNT(*) as total FROM sekolah");
$totalSekolah = mysqli_fetch_assoc($qSekolah)['total'];

// Total Dokumen
$qDokumen = mysqli_query($conn, "SELECT COUNT(*) as total FROM dokumen");
$totalDokumen = mysqli_fetch_assoc($qDokumen)['total'];

// Total Kuota
$qKuota = mysqli_query($conn, "SELECT SUM(kuota) as total FROM sekolah");
$totalKuota = mysqli_fetch_assoc($qKuota)['total'];

if(!$totalKuota){
    $totalKuota = 0;
}

$dataSekolah = mysqli_query($conn,
"SELECT nama_sekolah, jenjang, kuota FROM sekolah");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin EduPractice</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#F2F4F7;
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */

.sidebar{
    width:270px;
    background:white;
    padding:25px;
    border-right:1px solid #DCE3ED;
}

.logo{
    text-align:center;
    margin-bottom:35px;
}

.logo h2{
    color:#23406A;
    font-size:30px;
}

.logo p{
    color:#7D869B;
    font-size:13px;
    margin-top:5px;
}

.menu a{
    display:block;
    text-decoration:none;
    color:#23406A;
    background:#EEF3FA;
    padding:14px 16px;
    border-radius:12px;
    margin-bottom:12px;
    border:1px solid #DCE3ED;
    transition:.3s;
    font-weight:500;
}

.menu a:hover{
    background:#DCE7F5;
}

.menu .active{
    background:#23406A;
    color:white;
}

/* CONTENT */

.content{
    flex:1;
    padding:30px;
}

/* WELCOME */

.welcome{
    background:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.welcome h1{
    color:#23406A;
    margin-bottom:8px;
}

.welcome p{
    color:#646E80;
}

/* CARD */

.cards{
    display:grid;
    grid-template-columns:
    repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:25px;
}

.card{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.card h3{
    color:#6E788C;
    margin-bottom:10px;
}

.card p{
    color:#23406A;
    font-size:38px;
    font-weight:bold;
}

/* BOX */

.box{
    background:white;
    padding:25px;
    border-radius:20px;
    margin-bottom:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.box h2{
    color:#23406A;
    margin-bottom:15px;
}

/* TABLE */

table{
    width:100%;
    border-collapse:collapse;
}

th{
    background:#23406A;
    color:white;
    padding:14px;
    text-align:left;
}

td{
    padding:14px;
    border-bottom:1px solid #E5EBF3;
}

tr:hover{
    background:#F5F8FC;
}

/* INFO */

.info{
    background:#EEF3FA;
    border-left:5px solid #23406A;
    padding:15px;
    margin-bottom:12px;
    border-radius:10px;
    color:#42506A;
}

</style>
</head>

<body>

<div class="sidebar">

    <div class="logo">
        <h2>EduPractice</h2>
        <p>Portal PLK Sumatera Barat</p>
    </div>

    <div class="menu">
    <a href="dashboard_admin.php" class="active">🏠 Dashboard</a>
    <a href="kelola_sekolah.php">🏫 Kelola Sekolah</a>
    <a href="kelola_dokumen.php">📄 Kelola Dokumen</a>
    <a href="kelola_panduan.php">📚 Panduan PLK</a>
    <a href="profil.php">👤 Profil</a>
    <a href="logout.php">🚪 Logout</a>
</div>

</div>

<div class="content">

    <div class="welcome">
        <h1>Selamat Datang, <?= $nama; ?> 👋</h1>
        <p>
            Kelola data sekolah mitra, dokumen, kuota PLK,
            dan informasi terbaru melalui dashboard EduPractice.
        </p>
    </div>

    <div class="cards">

        <div class="card">
            <h3>🏫 Total Sekolah</h3>
            <p><?= $totalSekolah ?></p>
        </div>

        <div class="card">
            <h3>📄 Total Dokumen</h3>
            <p><?= $totalDokumen ?></p>
        </div>

        <div class="card">
            <h3>🎯 Total Kuota</h3>
            <p><?= $totalKuota ?></p>
        </div>

    </div>

    <div class="box">

        <h2>Daftar Sekolah Mitra</h2>

        <table>

            <tr>
                <th>Nama Sekolah</th>
                <th>Jenjang</th>
                <th>Kuota</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($dataSekolah)){ ?>

            <tr>
                <td><?= $row['nama_sekolah']; ?></td>
                <td><?= $row['jenjang']; ?></td>
                <td><?= $row['kuota']; ?></td>
            </tr>

            <?php } ?>

        </table>

    </div>

    <div class="box">

        <h2>Informasi Terbaru PLK</h2>

        <div class="info">
            📢 Pembukaan PLK Tahun 2027.
        </div>

        <div class="info">
            📢 Panduan PLK terbaru telah tersedia.
        </div>

        <div class="info">
            📢 Data sekolah mitra telah diperbarui.
        </div>

    </div>

</div>

</body>
</html>