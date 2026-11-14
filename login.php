<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>EduPractice</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#eef2f7;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    width:420px;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

h1{
    text-align:center;
    color:#1E3A5F;
    margin-bottom:10px;
}

.subtitle{
    text-align:center;
    color:#666;
    margin-bottom:25px;
}

label{
    display:block;
    margin-bottom:5px;
    color:#333;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:10px;
}

input:focus{
    outline:none;
    border-color:#1E3A5F;
}

button{
    width:100%;
    padding:12px;
    background:#1E3A5F;
    color:white;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-size:15px;
}

button:hover{
    background:#27476d;
}

.admin-btn{
    background:#4b5563;
}

.admin-btn:hover{
    background:#374151;
}

.bawah{
    display:flex;
    justify-content:center;
    margin-top:18px;
}

.bawah a{
    text-decoration:none;
    color:#1E3A5F;
    font-size:14px;
    font-weight:bold;
}

</style>

</head>

<body>

<div class="card">

<h1>EduPractice</h1>

<p class="subtitle">
Portal Pengalaman Lapangan Kependidikan
</p>

<form method="POST">

<label>Username</label>
<input type="text" name="username" required>

<label>Password</label>
<input type="password" name="password" required>

<button formaction="proses_login.php" type="submit">
Masuk Sebagai Mahasiswa
</button>

<br><br>

<button class="admin-btn"
formaction="proses_login_admin.php"
type="submit">
Masuk Sebagai Admin
</button>

</form>

<div class="bawah">

<a href="register_login.php">
Daftar Mahasiswa
</a>

</div>

</div>

</body>
</html>