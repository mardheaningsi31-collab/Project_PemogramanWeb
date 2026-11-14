<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Registrasi Mahasiswa</title>

<style>
body{
    font-family:Arial;
    background:#eef2f7;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    margin: 0;
}

.container{
    width:450px;
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
    box-sizing: border-box;
}

h2{
    text-align:center;
    color:#1E3A5F;
    margin-top: 0;
}

label{
    display: block;
    margin-bottom: 5px;
    color: #333;
    font-weight: bold;
    font-size: 14px;
}

input{
    width:100%;
    padding:12px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ddd;
    border-radius:10px;
    box-sizing: border-box;
}

input:focus{
    outline: none;
    border-color: #1E3A5F;
}

button{
    width:100%;
    padding:12px;
    background:#1E3A5F;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-size: 15px;
}

button:hover{
    background:#29476d;
}

.back-link {
    text-align: center;
    margin-top: 15px;
}

.back-link a {
    text-decoration: none;
    color: #1E3A5F;
    font-size: 14px;
    font-weight: bold;
}
</style>

</head>

<body>

<div class="container">

    <h2>Registrasi Mahasiswa</h2>

    <!-- Ini penghubung yang mengarahkan data ke proses_register.php -->
    <form action="proses_register.php" method="POST">

        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">
            Daftar Akun
        </button>

    </form>

    <div class="back-link">
        <a href="login_mahasiswa.php">← Kembali ke Login</a>
    </div>

</div>

</body>
</html>