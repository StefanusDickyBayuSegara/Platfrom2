<?php

session_start();

// menyambungkan ke database 
$db = mysqli_connect("localhost", "root", "", "platfrom2");

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $MuatUlang_password = $_POST['MuatUlang_password'];
    $new_password = $_POST['new_password'];

    // Kode untuk Query dalam hal mencari mahasiswa yang sesuai dgn  nama yang di miliki
    $query = "SELECT * FROM mahasiswa WHERE nama = '$username' AND nim = '$MuatUlang_password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        // Jika mahasiswa yang dimasukan dan ditemukan serta password lama di masukan benar maka akan dilakukan update password
        $query = "UPDATE mahasiswa SET nim = '$new_password' WHERE nama = '$username'";
        $result = mysqli_query($db, $query);
        if ($result) {
            //kemudian akan di  Alihkan ke halaman untuk login
            header("Location: ../Login/login.php");
            exit;
        } else {
            $error = "Gagal untuk memuat ulang/perbarui password!";
        }
    } else {
        $error = "Username tidak ditemukan atau password lama salah!";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MuatUlang Password Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <form method="post">
        <h1>MuatUlang Password</h1>

        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if (isset($success)) : ?>
            <p><?php echo $success; ?></p>
        <?php endif; ?>

        <label for="username">Masukan Username : </label>
        <input type="text" name="username" id="username">
        <label for="MuatUlang_password">Masukan Password lama: </label>
        <input type="password" name="MuatUlang_password" id="MuatUlang_password">
        <label for="new_password">Masukan Password Baru: </label>
        <input type="password" name="new_password" id="new_password">
        <button type="submit" name="submit">----Perbarui Password Selesai----</button>

        <!-- Tambahkan ini untuk membuat link dengan ikon -->
        <a href="../Login/login.php" style="display: block; margin-top: 5px; margin-left: 175px;">
        <i class="bi bi-reply-all-fill">Kembali ke login</i></a>
    </form>


</body>
<script src="muatulang.js"></script>

</html>