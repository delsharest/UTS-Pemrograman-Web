<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        img { width: 50px; height: 50px; object-fit: cover; }
    </style>
</head>
<body>
    <h2>Data Mahasiswa</h2>
    <a href="form.php">[+] Tambah Mahasiswa</a>
    
    <table>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>NIM</th>
            <th>Nama</th>
            <th>Jurusan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM mahasiswa");
        $no = 1;
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                <td>{$no}</td>
                <td><img src='uploads/{$row['foto']}'></td>
                <td>{$row['nim']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['jurusan']}</td>
                <td>
                    <a href='form.php?id={$row['id']}'>Edit</a> | 
                    <a href='proses.php?hapus={$row['id']}' onclick='return confirm(\"Yakin hapus data?\")'>Hapus</a>
                </td>
            </tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>

<style>
    body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
    h2 { color: #333; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; }
    th { background-color: #007bff; color: white; }
    tr:nth-child(even) { background-color: #f2f2f2; }
    img { border-radius: 4px; border: 1px solid #ddd; }
    .btn-tambah { display: inline-block; padding: 10px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
    .btn-edit { color: #ffc107; text-decoration: none; font-weight: bold; }
    .btn-hapus { color: #dc3545; text-decoration: none; font-weight: bold; }
</style>