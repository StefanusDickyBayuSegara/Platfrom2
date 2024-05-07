<?php

session_start();

// menyambungkan ke database 
$db = mysqli_connect("localhost", "root", "", "platfrom2");

function checkSession() {
    if (!isset($_SESSION["username"])) {
        // Jika belum bisa maka di alihkan ke halaman untuk Login
        header("Location: login.php");
        exit;
    }
}

function getNama() {
    global $db;
 
    $nama = $_SESSION["username"];

    //Langkah  Pertama,tentukan dan miliki id mahasiswa dari tabel mahasiswa_usd
    $query = "SELECT id FROM mahasiswa WHERE nama = '$nama'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $mahasiswa_id = $row['id'];

    return array($nama, $mahasiswa_id);
}

function handlePostRequest() {
    global $db;
    // memiliki id mahasiswa
    list($nama, $mahasiswa_id) = getNama();

    // Jika form yg dimiliki ditambahkan maka akan menyimpan tugas baru ke dalam database
    if (isset($_POST["add"])) {
        $task = $_POST["task"];
        if (empty($task)) {
            return 'Tugas anda tidak di izinkan atau diperbolegkan untuk kosong!';
        } else {
            $query = "INSERT INTO todolist (task, mahasiswa_id) VALUES ('$task', '$mahasiswa_id')";
            mysqli_query($db, $query);
        }
    }

    // Jika form yang kita isi telah selesai dan disubmit maka akan  menggubah status tugas yang dimiliki
    if (isset($_POST["done"])) {
        $id = $_POST["id"];
        $query = "UPDATE todolist SET status = '1' WHERE id = '$id'";
        mysqli_query($db, $query);
    }

    // Jika form yang kita isi dibatalkan dan  disubmit maka akan mengguubah status tugas yang di miliki
    if (isset($_POST["cancel"])) {
        $id = $_POST["id"];
        $query = "UPDATE todolist SET status = '0' WHERE id = '$id'";
        mysqli_query($db, $query);
    }

    // Jika form yang kita isi dihapus dan  disubmit maka akan menghapus tugas yang di miliki dari database
    if (isset($_POST["delete"])) {
        $id = $_POST["id"];
        $query = "DELETE FROM todolist WHERE id = '$id'";
        mysqli_query($db, $query);
    }

    return null;
}

function getTasks($mahasiswa_id) {
    global $db;
    // Kemudian ,kita akan menggunakan id mahasiswa yang kita punya untuk mencari dan menemukan  semua tugas yang di miliki
    // dari user  yang sedang terlogin
    $query = "SELECT * FROM todolist WHERE mahasiswa_id = '$mahasiswa_id'";
    $result = mysqli_query($db, $query);

    return $result;
}
?>