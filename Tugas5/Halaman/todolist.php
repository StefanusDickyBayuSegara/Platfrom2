<?php
include 'database.php';

checkSession();
list($nama, $mahasiswa_id) = getNama();
$error = handlePostRequest();
$result = getTasks($mahasiswa_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todolist Tugas Mahasiswa <?php echo $nama; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <header style="display: flex; justify-content: center;">
        <!-- Header with Name, Nim, and Foto -->
        <header class="header mt-5 rounded">
            <div class="info-profil">
                <h1>Stefanus Dicky Bayu Segara</h1>
                <p>NIM: 225314015</p>
            </div>
            
            <div class="foto-profil">
                <img src="image/Foto ku.jpg" alt="foto-profil"  width="300" height="400">
            </div>
        </header>
        
    <div class="container">
        <h1>Selamat Datang Di Web Kami <?php echo $nama; ?>!</h1>
        <h2>Daftar Tugas Mahasiswa:</h2>
        <form action="" method="post">
            <input type="text" name="task" placeholder="Tambahkan tugas baru...">
            <button type="submit" name="add">Tambahkan <i class="fa-regular fa-square-plus"></i></button>
        </form>

        <?php if ($error) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <ul id="todolist">
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <li>
                    <?php echo $row['task']; ?>
                   
                    <?php if ($row['status'] == '0') : ?>
                        <!-- Telah Selesai -->
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="done"><i class="fa-solid fa-check"></i></button>
                        </form>
                    <?php else : ?>
                        <!-- Batalkan -->
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <button type="submit" name="cancel"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    <?php endif; ?>
                    <!-- MengHapuskan -->
                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </li>
            <?php endwhile; ?>
        </ul>
        <a href="../Login/logout.php" class="logout-button"><i class="fa-sharp fa-solid fa-right-from-bracket"></i> Keluar</a>
    </div>
    <script src="todolist.js"></script>
</body>

</html>