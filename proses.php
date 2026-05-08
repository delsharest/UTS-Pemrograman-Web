<?php
include 'koneksi.php';

// PROSES SIMPAN & UPDATE
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    
    $foto_nama = $_FILES['foto']['name'];
    $foto_temp = $_FILES['foto']['tmp_name'];

    if ($foto_nama != "") {
        $ext = pathinfo($foto_nama, PATHINFO_EXTENSION);
        $baru = uniqid() . "." . $ext;
        move_uploaded_file($foto_temp, "uploads/" . $baru);
    } else {
        // Jika edit tapi tidak upload foto baru, pakai foto lama
        if ($id) {
            $old = mysqli_query($conn, "SELECT foto FROM mahasiswa WHERE id=$id");
            $baru = mysqli_fetch_assoc($old)['foto'];
        }
    }

    if ($id) {
        $q = "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan', foto='$baru' WHERE id=$id";
    } else {
        $q = "INSERT INTO mahasiswa VALUES (NULL, '$nim', '$nama', '$jurusan', '$baru')";
    }

    if (mysqli_query($conn, $q)) {
        echo "<script>alert('Berhasil!'); window.location='index.php';</script>";
    }
}

// PROSES HAPUS
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Hapus file di folder uploads dulu
    $res = mysqli_query($conn, "SELECT foto FROM mahasiswa WHERE id=$id");
    $data = mysqli_fetch_assoc($res);
    unlink("uploads/" . $data['foto']);
    
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    header("Location: index.php");
}
?>