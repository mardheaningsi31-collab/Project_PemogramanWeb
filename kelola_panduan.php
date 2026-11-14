<?php
include 'koneksi.php';

/* HAPUS */
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,
    "DELETE FROM panduan WHERE id_panduan='$id'");

    header("Location: kelola_panduan.php");
    exit;
}

/* UPDATE */
if(isset($_POST['update'])){

    $id = $_POST['id_panduan'];
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    mysqli_query($conn,"
        UPDATE panduan
        SET
        judul='$judul',
        isi='$isi'
        WHERE id_panduan='$id'
    ");

    header("Location: kelola_panduan.php");
    exit;
}

/* TAMBAH */
if(isset($_POST['simpan'])){

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];

    mysqli_query($conn,"
        INSERT INTO panduan(judul,isi)
        VALUES('$judul','$isi')
    ");

    header("Location: kelola_panduan.php");
    exit;
}

/* EDIT */

$dataEdit = null;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $queryEdit = mysqli_query($conn,
    "SELECT * FROM panduan WHERE id_panduan='$id'");

    $dataEdit = mysqli_fetch_assoc($queryEdit);
}

/* DATA */

$dataPanduan = mysqli_query($conn,
"SELECT * FROM panduan ORDER BY id_panduan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Panduan - EduPractice</title>

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

.header,
.form-box,
.table-box{
    background:white;
    padding:25px;
    border-radius:18px;
    margin-bottom:25px;
    box-shadow:0 3px 10px rgba(0,0,0,0.05);
}

.header h1,
.form-box h2,
.table-box h2{
    color:#23406A;
}

.header p{
    color:#6D788C;
    margin-top:5px;
}

/* FORM */

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
    min-height:150px;
    resize:vertical;
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
    border-bottom:1px solid #E4EAF2;
    vertical-align:top;
}

tr:hover{
    background:#F7F9FC;
}

.btn-edit{
    background:#DDE8F5;
    color:#23406A;
    text-decoration:none;
    padding:8px 12px;
    border-radius:8px;
    margin-right:5px;
}

.btn-hapus{
    background:#566175;
    color:white;
    text-decoration:none;
    padding:8px 12px;
    border-radius:8px;
}

.isi{
    max-width:500px;
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
        <a href="kelola_panduan.php" class="active">📚 Panduan PLK</a>
        <a href="profil.php">👤 Profil</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<div class="content">

    <div class="header">
        <h1>Kelola Panduan PLK</h1>
        <p>Tambah, edit, dan hapus panduan PLK untuk mahasiswa.</p>
    </div>

    <div class="form-box">

        <h2>
            <?= isset($_GET['edit']) ? 'Edit Panduan' : 'Tambah Panduan'; ?>
        </h2>

        <form method="POST">

            <input
            type="hidden"
            name="id_panduan"
            value="<?= $dataEdit['id_panduan'] ?? ''; ?>">

            <input
            type="text"
            name="judul"
            placeholder="Judul Panduan"
            value="<?= $dataEdit['judul'] ?? ''; ?>"
            required>

            <textarea
            name="isi"
            placeholder="Isi panduan..."
            required><?= $dataEdit['isi'] ?? ''; ?></textarea>

            <?php if(isset($_GET['edit'])){ ?>

                <button type="submit" name="update">
                    Update Panduan
                </button>

            <?php } else { ?>

                <button type="submit" name="simpan">
                    Tambah Panduan
                </button>

            <?php } ?>

        </form>

    </div>

    <div class="table-box">

        <h2>Daftar Panduan PLK</h2>

        <table>

            <tr>
                <th>Judul</th>
                <th>Isi</th>
                <th>Aksi</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($dataPanduan)){ ?>

            <tr>

                <td><?= $row['judul']; ?></td>

                <td class="isi">
                    <?= $row['isi']; ?>
                </td>

                <td>

                    <a
                    href="?edit=<?= $row['id_panduan']; ?>"
                    class="btn-edit">
                        Edit
                    </a>

                    <a
                    href="?hapus=<?= $row['id_panduan']; ?>"
                    class="btn-hapus"
                    onclick="return confirm('Yakin ingin menghapus panduan ini?')">
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