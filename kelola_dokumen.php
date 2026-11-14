<?php
include 'koneksi.php';

/* HAPUS */
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,
    "DELETE FROM dokumen WHERE id_dokumen='$id'");

    header("Location: kelola_dokumen.php");
    exit;
}

/* UPDATE */
if(isset($_POST['update'])){

    $id = $_POST['id_dokumen'];
    $nama = $_POST['nama_dokumen'];
    $file = $_POST['file_dokumen'];

    mysqli_query($conn,"
        UPDATE dokumen SET
        nama_dokumen='$nama',
        file_dokumen='$file'
        WHERE id_dokumen='$id'
    ");

    header("Location: kelola_dokumen.php");
    exit;
}

/* TAMBAH */
if(isset($_POST['simpan'])){

    $nama = $_POST['nama_dokumen'];
    $file = $_POST['file_dokumen'];

    mysqli_query($conn,"
        INSERT INTO dokumen
        (nama_dokumen,file_dokumen)
        VALUES
        ('$nama','$file')
    ");

    header("Location: kelola_dokumen.php");
    exit;
}

/* EDIT */
$dataEdit = null;

if(isset($_GET['edit'])){

    $id = $_GET['edit'];

    $queryEdit = mysqli_query($conn,
    "SELECT * FROM dokumen WHERE id_dokumen='$id'");

    $dataEdit = mysqli_fetch_assoc($queryEdit);
}

/* TAMPIL DATA */

$dataDokumen = mysqli_query($conn,
"SELECT * FROM dokumen ORDER BY nama_dokumen");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Dokumen - EduPractice</title>

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
    background:#fff;
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

.header,
.form-box,
.table-box{
    background:white;
    border-radius:18px;
    padding:25px;
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
    border:none;
    background:#23406A;
    color:white;
    padding:12px;
    border-radius:10px;
    cursor:pointer;
}

button:hover{
    background:#1C3152;
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
        <a href="kelola_dokumen.php" class="active">📄 Kelola Dokumen</a>
        <a href="kelola_panduan.php">📚 Panduan PLK</a>
        <a href="profil.php">👤 Profil</a>
        <a href="logout.php">🚪 Logout</a>
    </div>

</div>

<div class="content">

    <div class="header">
        <h1>Kelola Dokumen</h1>
        <p>Tambah, edit, dan hapus dokumen PLK.</p>
    </div>

    <div class="form-box">

        <h2>
            <?= isset($_GET['edit']) ? 'Edit Dokumen' : 'Tambah Dokumen'; ?>
        </h2>

        <form method="POST">

            <input
            type="hidden"
            name="id_dokumen"
            value="<?= $dataEdit['id_dokumen'] ?? ''; ?>">

            <input
            type="text"
            name="nama_dokumen"
            placeholder="Nama Dokumen"
            value="<?= $dataEdit['nama_dokumen'] ?? ''; ?>"
            required>

            <input
            type="text"
            name="file_dokumen"
            placeholder="Nama File / Link Dokumen"
            value="<?= $dataEdit['file_dokumen'] ?? ''; ?>"
            required>

            <?php if(isset($_GET['edit'])){ ?>

                <button type="submit" name="update">
                    Update Dokumen
                </button>

            <?php } else { ?>

                <button type="submit" name="simpan">
                    Tambah Dokumen
                </button>

            <?php } ?>

        </form>

    </div>

    <div class="table-box">

        <h2>Daftar Dokumen</h2>

        <table>

            <tr>
                <th>Nama Dokumen</th>
                <th>File Dokumen</th>
                <th>Aksi</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($dataDokumen)){ ?>

            <tr>

                <td><?= $row['nama_dokumen']; ?></td>

                <td><?= $row['file_dokumen']; ?></td>

                <td>

                    <a
                    href="?edit=<?= $row['id_dokumen']; ?>"
                    class="btn-edit">
                        Edit
                    </a>

                    <a
                    href="?hapus=<?= $row['id_dokumen']; ?>"
                    class="btn-hapus"
                    onclick="return confirm('Yakin ingin menghapus dokumen?')">
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