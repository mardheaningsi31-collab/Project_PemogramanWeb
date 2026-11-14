<?php
include 'koneksi.php';

/* HAPUS */
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    mysqli_query($conn,
    "DELETE FROM sekolah WHERE id_sekolah='$id'");

    header("Location: kelola_sekolah.php");
}

/* EDIT */
if(isset($_POST['update'])){

    $id = $_POST['id_sekolah'];
    $nama = $_POST['nama_sekolah'];
    $alamat = $_POST['alamat'];
    $jenjang = $_POST['jenjang'];
    $deskripsi = $_POST['deskripsi'];
    $fasilitas = $_POST['fasilitas'];
    $kuota = $_POST['kuota'];
    $kontak = $_POST['kontak'];

    mysqli_query($conn,"
        UPDATE sekolah SET
        nama_sekolah='$nama',
        alamat='$alamat',
        jenjang='$jenjang',
        deskripsi='$deskripsi',
        fasilitas='$fasilitas',
        kuota='$kuota',
        kontak='$kontak'
        WHERE id_sekolah='$id'
    ");

    header("Location: kelola_sekolah.php");
}

/* TAMBAH */
if(isset($_POST['simpan'])){

    $nama = $_POST['nama_sekolah'];
    $alamat = $_POST['alamat'];
    $jenjang = $_POST['jenjang'];
    $deskripsi = $_POST['deskripsi'];
    $fasilitas = $_POST['fasilitas'];
    $kuota = $_POST['kuota'];
    $kontak = $_POST['kontak'];

    mysqli_query($conn,"
        INSERT INTO sekolah
        (
            nama_sekolah,
            alamat,
            jenjang,
            deskripsi,
            fasilitas,
            kuota,
            kontak
        )
        VALUES
        (
            '$nama',
            '$alamat',
            '$jenjang',
            '$deskripsi',
            '$fasilitas',
            '$kuota',
            '$kontak'
        )
    ");

    header("Location: kelola_sekolah.php");
}

/* DATA EDIT */

$dataEdit = null;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $queryEdit = mysqli_query($conn,
    "SELECT * FROM sekolah WHERE id_sekolah='$id'");

    $dataEdit = mysqli_fetch_assoc($queryEdit);
}

/* DATA SEKOLAH */

$dataSekolah = mysqli_query($conn,
"SELECT * FROM sekolah ORDER BY nama_sekolah");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Sekolah - EduPractice</title>

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
    background:#FFFFFF;
    border-right:1px solid #DDE4EE;
    padding:25px;
}

.logo{
    text-align:center;
    margin-bottom:35px;
}

.logo h2{
    color:#23406A;
    margin-bottom:4px;
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
    transition:0.3s;
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

/* HEADER */

.header{
    background:white;
    padding:25px;
    border-radius:18px;
    margin-bottom:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.header h1{
    color:#23406A;
}

.header p{
    color:#6D788C;
    margin-top:5px;
}

/* FORM */

.form-box{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
    margin-bottom:25px;
}

.form-box h2{
    color:#23406A;
    margin-bottom:15px;
}

form{
    display:grid;
    gap:12px;
}

input,
textarea{
    padding:12px;
    border:1px solid #DDE4EE;
    border-radius:10px;
}

textarea{
    resize:none;
    height:90px;
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
    background:#1A3154;
}

/* TABLE */

.table-box{
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.table-box h2{
    color:#23406A;
    margin-bottom:15px;
}

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
    border-bottom:1px solid #E4EAF2;
}

tr:hover{
    background:#F7F9FC;
}

.btn-edit{
    background:#DDE8F5;
    color:#23406A;
    padding:8px 12px;
    text-decoration:none;
    border-radius:8px;
    margin-right:6px;
}

.btn-hapus{
    background:#566175;
    color:white;
    padding:8px 12px;
    text-decoration:none;
    border-radius:8px;
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
        <a href="kelola_sekolah.php" class="active">🏫 Kelola Sekolah</a>
        <a href="kelola_dokumen.php">📄 Kelola Dokumen</a>
        <a href="kelola_panduan.php">📚 Panduan PLK</a>
        <a href="profil.php">👤 Profil</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<div class="content">

    <div class="header">
        <h1>Kelola Sekolah</h1>
        <p>Tambah, edit, dan hapus data sekolah mitra PLK.</p>
    </div>

    <div class="form-box">

        <h2>
            <?= isset($_GET['edit']) ? 'Edit Sekolah' : 'Tambah Sekolah'; ?>
        </h2>

        <form method="POST">

            <input type="hidden"
            name="id_sekolah"
            value="<?= $dataEdit['id_sekolah'] ?? ''; ?>">

            <input type="text"
            name="nama_sekolah"
            placeholder="Nama Sekolah"
            value="<?= $dataEdit['nama_sekolah'] ?? ''; ?>"
            required>

            <input type="text"
            name="alamat"
            placeholder="Alamat"
            value="<?= $dataEdit['alamat'] ?? ''; ?>"
            required>

            <input type="text"
            name="jenjang"
            placeholder="Jenjang"
            value="<?= $dataEdit['jenjang'] ?? ''; ?>"
            required>

            <textarea
            name="deskripsi"
            placeholder="Deskripsi"><?= $dataEdit['deskripsi'] ?? ''; ?></textarea>

            <textarea
            name="fasilitas"
            placeholder="Fasilitas"><?= $dataEdit['fasilitas'] ?? ''; ?></textarea>

            <input type="number"
            name="kuota"
            placeholder="Kuota"
            value="<?= $dataEdit['kuota'] ?? ''; ?>"
            required>

            <input type="text"
            name="kontak"
            placeholder="Kontak"
            value="<?= $dataEdit['kontak'] ?? ''; ?>"
            required>

            <?php if(isset($_GET['edit'])){ ?>

                <button type="submit" name="update">
                    Update Sekolah
                </button>

            <?php } else { ?>

                <button type="submit" name="simpan">
                    Tambah Sekolah
                </button>

            <?php } ?>

        </form>

    </div>

    <div class="table-box">

        <h2>Daftar Sekolah Mitra</h2>

        <table>

            <tr>
                <th>Nama Sekolah</th>
                <th>Jenjang</th>
                <th>Kuota</th>
                <th>Kontak</th>
                <th>Aksi</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($dataSekolah)){ ?>

            <tr>

                <td><?= $row['nama_sekolah']; ?></td>
                <td><?= $row['jenjang']; ?></td>
                <td><?= $row['kuota']; ?></td>
                <td><?= $row['kontak']; ?></td>

                <td>

                    <a href="?edit=<?= $row['id_sekolah']; ?>"
                       class="btn-edit">
                       Edit
                    </a>

                    <a href="?hapus=<?= $row['id_sekolah']; ?>"
                       class="btn-hapus"
                       onclick="return confirm('Yakin ingin menghapus sekolah ini?')">
                       Hapus
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>