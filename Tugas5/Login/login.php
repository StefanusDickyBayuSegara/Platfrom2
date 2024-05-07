<?php

session_start();

// menyambungkan ke database 
$db = mysqli_connect("localhost", "root", "", "platfrom2");

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST['password'];

    //mencari mahasiswa dengan nama dan NIM yang di tentukan
    $query = "SELECT * FROM mahasiswa WHERE nama = '$username'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // MemVerifikasi password yang di miliki
        if ($password == $user['nim']) {
            // Jika mahasiswa ditemukan maka akan menyimpan username ke dalam session
            $_SESSION["username"] = $username;
           
            header("Location: ../Halaman/todolist.php");
            exit;
        } else {
            $error = "Password yang anda masukan tidak bener!";
        }
    } else {
        $error = "Username yang anda di cari tidak ada/ didapatkan!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login LMS Mahasiswa </title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <form action="" method="post">
        <h1>Login LMS Mahasiswa</h1>

        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <label for="username">Masukan Username : </label>
        <input type="text" name="username" id="username">
        <label for="password">Masukan Password : </label>
        <input type="password" name="password" id="password">
        <button type="submit" name="submit">Login</button>

        <!-- ke halaman MuatUlang password -->
        <p><a href="../MuatUlang/muatulang.php">Klik Lupa/Perbarui password ?</a></p>

    </form>
</body>
<script src="login.js"></script>

</html>